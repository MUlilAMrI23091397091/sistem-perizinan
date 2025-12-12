<?php

namespace App\Http\Controllers;

use App\Models\TtdSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TtdSettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        // Cek authorization - hanya admin dan penerbitan_berkas yang bisa akses
        if (!in_array($user->role, ['admin', 'penerbitan_berkas'])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        
        $ttdSettings = TtdSetting::getSettings();
        
        return view('ttd-settings.index', compact('ttdSettings'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        // Cek authorization - hanya admin dan penerbitan_berkas yang bisa update
        if (!in_array($user->role, ['admin', 'penerbitan_berkas'])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }
        
        $request->validate([
            'mengetahui_title' => 'required|string|max:255',
            'mengetahui_jabatan' => 'required|string|max:255',
            'mengetahui_unit' => 'required|string|max:255',
            'mengetahui_nama' => 'required|string|max:255',
            'mengetahui_pangkat' => 'required|string|max:255',
            'mengetahui_nip' => 'required|string|max:255',
            'mengetahui_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mengetahui_photo_base64' => 'nullable|string',
            'menyetujui_lokasi' => 'required|string|max:255',
            'menyetujui_tanggal' => 'required|date',
            'menyetujui_jabatan' => 'required|string|max:255',
            'menyetujui_nama' => 'required|string|max:255',
            'menyetujui_pangkat' => 'required|string|max:255',
            'menyetujui_nip' => 'required|string|max:255',
            'menyetujui_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menyetujui_photo_base64' => 'nullable|string',
        ]);

        $ttdSettings = TtdSetting::getSettings();
        
        $data = $request->except(['mengetahui_photo', 'menyetujui_photo', 'mengetahui_photo_base64', 'menyetujui_photo_base64']);
        
        // Sanitize input teks untuk mencegah XSS
        $textFields = ['mengetahui_title', 'mengetahui_jabatan', 'mengetahui_unit', 'mengetahui_nama', 
                      'mengetahui_pangkat', 'mengetahui_nip', 'menyetujui_lokasi', 'menyetujui_jabatan', 
                      'menyetujui_nama', 'menyetujui_pangkat', 'menyetujui_nip'];
        foreach ($textFields as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $data[$field] = strip_tags($data[$field]);
            }
        }
        
        // Handle upload foto mengetahui (file upload)
        if ($request->hasFile('mengetahui_photo')) {
            // Hapus foto lama jika ada
            if ($ttdSettings->mengetahui_photo && Storage::disk('public')->exists('ttd_photos/' . $ttdSettings->mengetahui_photo)) {
                Storage::disk('public')->delete('ttd_photos/' . $ttdSettings->mengetahui_photo);
            }
            
            $file = $request->file('mengetahui_photo');
            $filename = 'mengetahui_ttd_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Debug: cek apakah file berhasil disimpan
            $path = $file->storeAs('ttd_photos', $filename, 'public');
            if ($path) {
                $data['mengetahui_photo'] = $filename;
                Log::info('TTD Mengetahui uploaded successfully: ' . $filename);
            } else {
                Log::error('TTD Mengetahui upload failed');
            }
        }
        // Handle base64 signature untuk mengetahui
        elseif ($request->has('mengetahui_photo_base64') && !empty($request->mengetahui_photo_base64)) {
            // Hapus foto lama jika ada
            if ($ttdSettings->mengetahui_photo && Storage::disk('public')->exists('ttd_photos/' . $ttdSettings->mengetahui_photo)) {
                Storage::disk('public')->delete('ttd_photos/' . $ttdSettings->mengetahui_photo);
            }
            
            try {
                $base64Image = $request->mengetahui_photo_base64;
                // Extract base64 data
                if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                    $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                    $type = strtolower($type[1]); // jpg, png, gif, etc.
                    
                    if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                        throw new \Exception('Invalid image type');
                    }
                    
                    $imageData = base64_decode($base64Image);
                    if ($imageData === false) {
                        throw new \Exception('Failed to decode base64 image');
                    }
                    
                    $filename = 'mengetahui_ttd_' . time() . '.png';
                    $path = Storage::disk('public')->put('ttd_photos/' . $filename, $imageData);
                    
                    if ($path) {
                        $data['mengetahui_photo'] = $filename;
                        Log::info('TTD Mengetahui (signature pad) saved successfully: ' . $filename);
                    } else {
                        Log::error('TTD Mengetahui (signature pad) save failed');
                    }
                }
            } catch (\Exception $e) {
                Log::error('Error saving TTD Mengetahui signature: ' . $e->getMessage());
            }
        }
        
        // Handle upload foto menyetujui (file upload)
        if ($request->hasFile('menyetujui_photo')) {
            // Hapus foto lama jika ada
            if ($ttdSettings->menyetujui_photo && Storage::disk('public')->exists('ttd_photos/' . $ttdSettings->menyetujui_photo)) {
                Storage::disk('public')->delete('ttd_photos/' . $ttdSettings->menyetujui_photo);
            }
            
            $file = $request->file('menyetujui_photo');
            $filename = 'menyetujui_ttd_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Debug: cek apakah file berhasil disimpan
            $path = $file->storeAs('ttd_photos', $filename, 'public');
            if ($path) {
                $data['menyetujui_photo'] = $filename;
                Log::info('TTD Menyetujui uploaded successfully: ' . $filename);
            } else {
                Log::error('TTD Menyetujui upload failed');
            }
        }
        // Handle base64 signature untuk menyetujui
        elseif ($request->has('menyetujui_photo_base64') && !empty($request->menyetujui_photo_base64)) {
            // Hapus foto lama jika ada
            if ($ttdSettings->menyetujui_photo && Storage::disk('public')->exists('ttd_photos/' . $ttdSettings->menyetujui_photo)) {
                Storage::disk('public')->delete('ttd_photos/' . $ttdSettings->menyetujui_photo);
            }
            
            try {
                $base64Image = $request->menyetujui_photo_base64;
                // Extract base64 data
                if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                    $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                    $type = strtolower($type[1]); // jpg, png, gif, etc.
                    
                    if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                        throw new \Exception('Invalid image type');
                    }
                    
                    $imageData = base64_decode($base64Image);
                    if ($imageData === false) {
                        throw new \Exception('Failed to decode base64 image');
                    }
                    
                    $filename = 'menyetujui_ttd_' . time() . '.png';
                    $path = Storage::disk('public')->put('ttd_photos/' . $filename, $imageData);
                    
                    if ($path) {
                        $data['menyetujui_photo'] = $filename;
                        Log::info('TTD Menyetujui (signature pad) saved successfully: ' . $filename);
                    } else {
                        Log::error('TTD Menyetujui (signature pad) save failed');
                    }
                }
            } catch (\Exception $e) {
                Log::error('Error saving TTD Menyetujui signature: ' . $e->getMessage());
            }
        }
        
        // Handle hapus foto mengetahui
        if ($request->has('delete_mengetahui_photo') && $request->delete_mengetahui_photo == '1') {
            if ($ttdSettings->mengetahui_photo && Storage::disk('public')->exists('ttd_photos/' . $ttdSettings->mengetahui_photo)) {
                Storage::disk('public')->delete('ttd_photos/' . $ttdSettings->mengetahui_photo);
            }
            $data['mengetahui_photo'] = null;
        }
        
        // Handle hapus foto menyetujui
        if ($request->has('delete_menyetujui_photo') && $request->delete_menyetujui_photo == '1') {
            if ($ttdSettings->menyetujui_photo && Storage::disk('public')->exists('ttd_photos/' . $ttdSettings->menyetujui_photo)) {
                Storage::disk('public')->delete('ttd_photos/' . $ttdSettings->menyetujui_photo);
            }
            $data['menyetujui_photo'] = null;
        }
        
        $ttdSettings->update($data);

        return redirect()->back()->with('success', 'Pengaturan TTD berhasil diperbarui.');
    }
}