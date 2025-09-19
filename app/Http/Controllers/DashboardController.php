<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $dateFrom = $request->query('date_from');
        $dateTo = $request->query('date_to');
        
        // Query dasar
        $permohonans = Permohonan::with('user');
        
        // Terapkan filter tanggal
        if ($selectedDateFilter == 'custom') {
            if ($dateFrom) {
                $permohonans->whereDate('created_at', '>=', $dateFrom);
            }
            if ($dateTo) {
                $permohonans->whereDate('created_at', '<=', $dateTo);
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

        return view('statistik', compact('stats', 'selectedDateFilter', 'dateFrom', 'dateTo'));
    }
}