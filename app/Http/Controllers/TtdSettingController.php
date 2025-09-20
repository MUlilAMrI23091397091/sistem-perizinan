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
        return view('ttd-settings.index', compact('ttdSettings'));
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