<?php

require_once 'vendor/autoload.php';

use App\Models\Permohonan;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TEST DASHBOARD TANPA STATUS MENUNGGU ===\n\n";

// Simulasi filter dashboard untuk DPMPTSP
$permohonans = Permohonan::with('user')
    ->whereHas('user', function($query) {
        $query->where('role', '!=', 'penerbitan_berkas');
    })->get();

echo "=== DATA SETELAH FILTER ROLE (DPMPTSP) ===\n";
echo "Total: " . $permohonans->count() . "\n\n";

// Hitung statistik dengan 4 kategori status (tanpa Menunggu)
$stats = [
    'totalPermohonan' => $permohonans->count(),
    'diterima' => $permohonans->where('status', 'Diterima')->count(),
    'dikembalikan' => $permohonans->where('status', 'Dikembalikan')->count(),
    'ditolak' => $permohonans->where('status', 'Ditolak')->count(),
    'terlambat' => $permohonans->where('status', 'Terlambat')->count(),
];

// Ambil data terlambat untuk tampilan khusus
$terlambatData = $permohonans->where('status', 'Terlambat');

echo "=== DASHBOARD STATISTICS YANG AKAN DITAMPILKAN ===\n";
echo "Total Permohonan: " . $stats['totalPermohonan'] . "\n";
echo "Diterima: " . $stats['diterima'] . "\n";
echo "Dikembalikan: " . $stats['dikembalikan'] . "\n";
echo "Ditolak: " . $stats['ditolak'] . "\n";
echo "Terlambat: " . $stats['terlambat'] . "\n\n";

echo "=== VERIFIKASI TIDAK ADA STATUS MENUNGGU ===\n";
$menungguCount = $permohonans->where('status', 'Menunggu')->count();
echo "Status Menunggu: " . $menungguCount . " (harus 0)\n";

if ($menungguCount == 0) {
    echo "✅ BERHASIL: Tidak ada data dengan status 'Menunggu'\n";
} else {
    echo "❌ GAGAL: Masih ada data dengan status 'Menunggu'\n";
}

echo "\n=== DETAIL DATA TERLAMBAT ===\n";
foreach($terlambatData as $data) {
    $deadlineStr = $data->deadline ? $data->deadline->format('d/m/Y') : 'No deadline';
    $daysLate = $data->deadline ? now()->diffInDays($data->deadline, false) : 0;
    echo "• {$data->no_permohonan} - {$data->nama_usaha} - Deadline: {$deadlineStr} - Terlambat: " . abs($daysLate) . " hari\n";
}

echo "\n=== BREAKDOWN STATUS UNTUK DASHBOARD (4 STATUS SAJA) ===\n";
echo "1. Diterima: " . $stats['diterima'] . " (data yang sudah diterima)\n";
echo "2. Dikembalikan: " . $stats['dikembalikan'] . " (data yang dikembalikan)\n";
echo "3. Ditolak: " . $stats['ditolak'] . " (data yang ditolak)\n";
echo "4. Terlambat: " . $stats['terlambat'] . " (data yang terlambat deadline)\n";

echo "\n=== TOTAL VERIFIKASI ===\n";
$totalCalculated = $stats['diterima'] + $stats['dikembalikan'] + $stats['ditolak'] + $stats['terlambat'];
echo "Total dari 4 status: " . $totalCalculated . "\n";
echo "Total sebenarnya: " . $stats['totalPermohonan'] . "\n";

if ($totalCalculated == $stats['totalPermohonan']) {
    echo "✅ BERHASIL: Semua data memiliki status yang jelas (4 status)\n";
} else {
    echo "❌ GAGAL: Ada data yang tidak memiliki status yang jelas\n";
}
