<?php

namespace App\Http\Controllers;

use App\Exports\PermohonanDpmExport;
use App\Exports\PermohonanPdTeknisExport;
use App\Exports\PermohonanSemuaExport; // Tambahkan ini
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function export(Request $request, $type, $format)
    {
        $selectedSektor = $request->query('sektor');
        $query = Permohonan::latest();

        if ($selectedSektor) {
            $query->where('sektor', $selectedSektor);
        }

        $permohonans = $query->get();
        $fileName = $type . '-' . date('Y-m-d') . '.' . $format;

        if ($format == 'xlsx') {
            $exportClass = match ($type) {
                'pd-teknis' => PermohonanPdTeknisExport::class,
                'dpm' => PermohonanDpmExport::class,
                'semua' => PermohonanSemuaExport::class, // Tambahkan ini
                default => null
            };

            if (!$exportClass) {
                return redirect()->back()->with('error', 'Tipe ekspor tidak valid.');
            }

            return Excel::download(new $exportClass($permohonans), $fileName);
        }

        if ($format == 'pdf') {
            // Cek apakah view untuk tipe tersebut ada
            if (!view()->exists('pdf.' . $type)) {
                 return redirect()->back()->with('error', 'Tampilan PDF tidak ditemukan.');
            }
            $pdf = Pdf::loadView('pdf.' . $type, ['permohonans' => $permohonans]);
            return $pdf->download($fileName);
        }

        return redirect()->back();
    }
}
