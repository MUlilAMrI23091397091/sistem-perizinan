<?php
// FILE: app/Exports/PermohonanDpmExport.php

namespace App\Exports;

use App\Models\Permohonan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PermohonanDpmExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    protected $permohonans;

    public function __construct(Collection $permohonans)
    {
        $this->permohonans = $permohonans;
    }

    public function collection()
    {
        return $this->permohonans->map(function ($p) {
            return [
                'Nama Usaha' => $p->nama_usaha,
                'Alamat' => $p->alamat_perusahaan,
                'Modal Usaha' => $p->modal_usaha,
                'Jenis Proyek' => $p->jenis_proyek,
                'Verifikasi DPMPTSP' => $p->verifikasi_dpmptsp,
                'Status' => $p->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Usaha',
            'Alamat',
            'Modal Usaha',
            'Jenis Proyek',
            'Verifikasi DPMPTSP',
            'Status',
        ];
    }

    public function columnWidths(): array
    {
        // Menentukan lebar setiap kolom secara manual agar rapi
        return [
            'A' => 30,
            'B' => 45,
            'C' => 20,
            'D' => 20,
            'E' => 30,
            'F' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A1:F' . ($this->permohonans->count() + 1))->applyFromArray($styleArray);
    }
}