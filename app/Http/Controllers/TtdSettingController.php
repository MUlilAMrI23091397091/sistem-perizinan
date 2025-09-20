<?php

namespace App\Http\Controllers;

use App\Models\TtdSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TtdSettingController extends Controller
{
    public function index()
    {
        $ttdSettings = TtdSetting::getSettings();
        
        // Proses title menyetujui untuk mengganti placeholder tanggal
        $menyetujuiTitle = str_replace('{{ date("d F Y") }}', date('d F Y'), $ttdSettings->menyetujui_title);
        
        return view('ttd-settings.index', compact('ttdSettings', 'menyetujuiTitle'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'mengetahui_title' => 'required|string|max:255',
            'mengetahui_jabatan' => 'required|string|max:255',
            'mengetahui_unit' => 'required|string|max:255',
            'mengetahui_nama' => 'required|string|max:255',
            'mengetahui_pangkat' => 'required|string|max:255',
            'mengetahui_nip' => 'required|string|max:255',
            'menyetujui_title' => 'required|string|max:255',
            'menyetujui_jabatan' => 'required|string|max:255',
            'menyetujui_nama' => 'required|string|max:255',
            'menyetujui_pangkat' => 'required|string|max:255',
            'menyetujui_nip' => 'required|string|max:255',
        ]);

        $ttdSettings = TtdSetting::getSettings();
        $ttdSettings->update($request->all());

        return redirect()->back()->with('success', 'Pengaturan TTD berhasil diperbarui.');
    }
}