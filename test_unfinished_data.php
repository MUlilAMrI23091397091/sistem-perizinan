<?php

require_once 'vendor/autoload.php';

use App\Models\Permohonan;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TEST DASHBOARD UNFINISHED DATA ===\n\n";

// Simulasi filter dashboard untuk DPMPTSP
$permohonans = Permohonan::with('user')
    ->whereHas('user', function($query) {
        $query->where('role', '!=', 'penerbitan_berkas');
    })->get();

echo "=== DATA SETELAH FILTER ROLE (DPMPTSP) ===\n";
echo "Total: " . $permohonans->count() . "\n\n";

// Filter data yang belum selesai
$unfinishedData = $permohonans->filter(function($permohonan) {
    return !in_array($permohonan->status, ['Diterima', 'Ditolak']);
});

echo "=== DATA BELUM SELESAI ===\n";
echo "Total: " . $unfinishedData->count() . "\n";
echo "Dikembalikan: " . $unfinishedData->where('status', 'Dikembalikan')->count() . "\n";
echo "Diterima: " . $unfinishedData->where('status', 'Diterima')->count() . "\n";
echo "Ditolak: " . $unfinishedData->where('status', 'Ditolak')->count() . "\n";
echo "Menunggu: " . $unfinishedData->where('status', 'Menunggu')->count() . "\n\n";

echo "=== DETAIL DATA BELUM SELESAI ===\n";
foreach($unfinishedData as $data) {
    $deadlineStr = $data->deadline ? $data->deadline->format('d/m/Y') : 'No deadline';
    echo "• {$data->no_permohonan} - {$data->nama_usaha} - Status: {$data->status} - Deadline: {$deadlineStr}\n";
}

echo "\n=== DASHBOARD STATISTICS YANG AKAN DITAMPILKAN ===\n";
$stats = [
    'totalPermohonan' => $unfinishedData->count(),
    'dikembalikan' => $unfinishedData->where('status', 'Dikembalikan')->count(),
    'diterima' => $unfinishedData->where('status', 'Diterima')->count(),
    'ditolak' => $unfinishedData->where('status', 'Ditolak')->count(),
];

echo "Total Permohonan: " . $stats['totalPermohonan'] . "\n";
echo "Diterima: " . $stats['diterima'] . "\n";
echo "Dikembalikan: " . $stats['dikembalikan'] . "\n";
echo "Ditolak: " . $stats['ditolak'] . "\n";

echo "\n=== BREAKDOWN STATUS UNTUK DASHBOARD ===\n";
echo "1. Diterima: " . $stats['diterima'] . " (data yang sudah diterima)\n";
echo "2. Dikembalikan: " . $stats['dikembalikan'] . " (data yang dikembalikan)\n";
echo "3. Ditolak: " . $stats['ditolak'] . " (data yang ditolak)\n";
echo "4. Dikembalikan: " . $stats['dikembalikan'] . " (data yang dikembalikan - duplikat)\n";
