<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\TtdSetting;
use App\Exports\PenerbitanBerkasExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        
        // Ambil data permohonan
        $permohonans = Permohonan::with('user')->get();
        
        // Hitung statistik
        $stats = [
            'totalPermohonan' => $permohonans->count(),
            'dikembalikan' => $permohonans->where('status', 'Dikembalikan')->count(),
            'diterima' => $permohonans->where('status', 'Diterima')->count(),
            'ditolak' => $permohonans->where('status', 'Ditolak')->count(),
        ];

        // Return view berdasarkan role
        switch ($user->role) {
            case 'admin':
                return view('dashboard.admin', compact('permohonans', 'stats'));
            case 'dpmptsp':
                return view('dashboard.dpmptsp', compact('permohonans', 'stats'));
            case 'pd_teknis':
                return view('dashboard.pd_teknis', compact('permohonans', 'stats'));
            case 'penerbitan_berkas':
                return view('dashboard.penerbitan_berkas', compact('permohonans', 'stats'));
            default:
                $request->session()->regenerateToken();
                return redirect('/login')->with('error', 'Peran tidak valid, hubungi admin.');
        }
    }

    public function statistik(Request $request)
    {
        $user = Auth::user();
        
        // Ambil parameter dari request
        $selectedDateFilter = $request->query('date_filter');
        $customDate = $request->query('custom_date');
        
        // Query dasar
        $permohonans = Permohonan::with('user');
        
        // Terapkan filter tanggal
        if ($selectedDateFilter) {
            $now = \Carbon\Carbon::now();
            
            switch ($selectedDateFilter) {
                case 'today':
                    $permohonans->whereDate('created_at', $now->toDateString());
                    break;
                case 'yesterday':
                    $permohonans->whereDate('created_at', $now->subDay()->toDateString());
                    break;
                case 'this_week':
                    $permohonans->whereBetween('created_at', [
                        $now->startOfWeek()->toDateTimeString(),
                        $now->endOfWeek()->toDateTimeString()
                    ]);
                    break;
                case 'last_week':
                    $permohonans->whereBetween('created_at', [
                        $now->subWeek()->startOfWeek()->toDateTimeString(),
                        $now->subWeek()->endOfWeek()->toDateTimeString()
                    ]);
                    break;
                case 'this_month':
                    $permohonans->whereMonth('created_at', $now->month)
                               ->whereYear('created_at', $now->year);
                    break;
                case 'last_month':
                    $lastMonth = $now->subMonth();
                    $permohonans->whereMonth('created_at', $lastMonth->month)
                               ->whereYear('created_at', $lastMonth->year);
                    break;
                case 'custom':
                    if ($customDate) {
                        $permohonans->whereDate('created_at', $customDate);
                    }
                    break;
            }
        }
        
        // Ambil data permohonan
        $permohonans = $permohonans->get();
        
        // Hitung statistik untuk chart
        $stats = [
            'totalPermohonan' => $permohonans->count(),
            'dikembalikan' => $permohonans->where('status', 'Dikembalikan')->count(),
            'diterima' => $permohonans->where('status', 'Diterima')->count(),
            'ditolak' => $permohonans->where('status', 'Ditolak')->count(),
        ];

        return view('statistik', compact('stats', 'selectedDateFilter', 'customDate'));
    }

    public function penerbitanBerkas()
    {
        $user = Auth::user();
        
        // Ambil data permohonan
        $permohonans = Permohonan::with('user')->get();
        
        // Hitung statistik
        $stats = [
            'totalPermohonan' => $permohonans->count(),
            'dikembalikan' => $permohonans->where('status', 'Dikembalikan')->count(),
            'diterima' => $permohonans->where('status', 'Diterima')->count(),
            'ditolak' => $permohonans->where('status', 'Ditolak')->count(),
        ];

        // Ambil data TTD settings
        $ttdSettings = TtdSetting::getSettings();
        
        // Proses title menyetujui untuk mengganti placeholder tanggal
        $menyetujuiTitle = str_replace('{{ date("d F Y") }}', date('d F Y'), $ttdSettings->menyetujui_title);

        return view('dashboard.penerbitan_berkas', compact('permohonans', 'stats', 'ttdSettings', 'menyetujuiTitle'));
    }

    public function exportPenerbitanBerkasExcel()
    {
        return Excel::download(new PenerbitanBerkasExport, 'data_penerbitan_berkas_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    public function storePenerbitanBerkas(Request $request)
    {
        $user = Auth::user();
        
        $rules = [
            'no_permohonan' => 'nullable|string|unique:permohonans,no_permohonan',
            'no_proyek' => 'nullable|string',
            'tanggal_permohonan' => 'nullable|date',
            'nib' => 'nullable|string|max:20',
            'kbli' => 'nullable|string',
            'nama_usaha' => 'nullable|string',
            'inputan_teks' => 'nullable|string',
            'jenis_pelaku_usaha' => 'required|string|in:Orang Perseorangan,Badan Usaha',
            'jenis_badan_usaha' => 'nullable|string',
            'pemilik' => 'nullable|string',
            'modal_usaha' => 'nullable|numeric',
            'alamat_perusahaan' => 'nullable|string',
            'jenis_proyek' => 'nullable|string|in:Utama,Pendukung,Pendukung UMKU,Kantor Cabang',
            'nama_perizinan' => 'nullable|string',
            'skala_usaha' => 'nullable|string',
            'risiko' => 'nullable|string',
            'verifikator' => 'nullable|string',
            'status' => 'required|in:Dikembalikan,Diterima,Ditolak,Menunggu',
        ];

        // Jika jenis pelaku usaha adalah Badan Usaha, jenis_badan_usaha wajib diisi
        if ($request->jenis_pelaku_usaha === 'Badan Usaha') {
            $rules['jenis_badan_usaha'] = 'required|string';
        }

        $validated = $request->validate($rules);
        
        // Tambahkan user_id ke data yang akan disimpan
        $validated['user_id'] = $user->id;
        
        // Jika jenis_pelaku_usaha adalah 'Orang Perseorangan', set jenis_badan_usaha ke null
        if ($validated['jenis_pelaku_usaha'] === 'Orang Perseorangan') {
            $validated['jenis_badan_usaha'] = null;
        }

        $permohonan = Permohonan::create($validated);

        return redirect()->route('penerbitan-berkas')->with('success', 'Data permohonan berhasil ditambahkan!');
    }
}