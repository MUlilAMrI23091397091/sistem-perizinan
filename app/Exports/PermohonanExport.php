<?php

namespace App\Exports;

use App\Models\Permohonan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PermohonanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Permohonan::with('user')->orderBy('created_at', 'desc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'SEKTOR',
            'WAKTU',
            'NO. PERMOHONAN (PD TEKNIS)',
            'NO. PROYEK (PD TEKNIS)',
            'TANGGAL PERMOHONAN (PD TEKNIS)',
            'NIB (PD TEKNIS)',
            'KBLI (PD TEKNIS)',
            'KEGIATAN (PD TEKNIS)',
            'JENIS USAHA (PD TEKNIS)',
            'NAMA PERUSAHAAN (PD TEKNIS)',
            'NAMA USAHA (DPM)',
            'ALAMAT PERUSAHAAN (DPM)',
            'MODAL USAHA (DPM)',
            'JENIS PROYEK (DPM)',
            'NAMA PERIZINAN (DPM)',
            'SKALA USAHA (DPM)',
            'RISIKO (DPM)',
            'JANGKA WAKTU (HARI KERJA) (DPM)',
            'NO TELPHONE (DPM)',
            'VERIFIKASI OLEH PD TEKNIS',
            'VERIFIKASI ANALISA (DPMPTSP)',
            'TANGGAL PENGEMBALIAN',
            'KETERANGAN PENGEMBALIAN',
            'TANGGAL MENGHUBUNGI',
            'KETERANGAN MENGHUBUNGI',
            'TANGGAL DISETUJUI',
            'KETERANGAN DISETUJUI',
            'TANGGAL TERBIT',
            'KETERANGAN TERBIT',
            'PEMROSES DAN TGL E-SURAT DAN TGL PERTEK',
            'VERIFIKATOR',
            'STATUS'
        ];
    }

    /**
     * @param mixed $permohonan
     * @return array
     */
    public function map($permohonan): array
    {
        return [
            // SEKSI (sektor)
            $permohonan->sektor ?? '',
            // WAKTU (tahun)
            $permohonan->created_at ? \Carbon\Carbon::parse($permohonan->created_at)->format('Y') : '',
            // NO. PERMOHONAN (PD TEKNIS)
            $permohonan->no_permohonan ?? '',
            // NO. PROYEK (PD TEKNIS)
            $permohonan->no_proyek ?? '',
            // TANGGAL PERMOHONAN (PD TEKNIS)
            $permohonan->tanggal_permohonan ? \Carbon\Carbon::parse($permohonan->tanggal_permohonan)->format('d/m/Y') : '',
            // NIB (PD TEKNIS)
            $permohonan->nib ?? '',
            // KBLI (PD TEKNIS)
            $permohonan->kbli ?? '',
            // KEGIATAN (PD TEKNIS)
            $permohonan->inputan_teks ?? '',
            // JENIS USAHA (PD TEKNIS)
            $permohonan->jenis_pelaku_usaha ?? '',
            // NAMA PERUSAHAAN (PD TEKNIS)
            $permohonan->nama_perusahaan ?? '',
            // NAMA USAHA (DPM)
            $permohonan->nama_usaha ?? '',
            // ALAMAT PERUSAHAAN (DPM)
            $permohonan->alamat_perusahaan ?? '',
            // MODAL USAHA (DPM)
            $permohonan->modal_usaha ? number_format($permohonan->modal_usaha, 0, ',', '.') : '',
            // JENIS PROYEK (DPM)
            $permohonan->jenis_proyek ?? '',
            // NAMA PERIZINAN (DPM)
            $permohonan->nama_perizinan ?? '',
            // SKALA USAHA (DPM)
            $permohonan->skala_usaha ?? '',
            // RISIKO (DPM)
            $permohonan->risiko ?? '',
            // JANGKA WAKTU (HARI KERJA) (DPM)
            $permohonan->jangka_waktu ?? '',
            // NO TELPHONE (DPM)
            $permohonan->no_telephone ?? '',
            // VERIFIKASI OLEH PD TEKNIS
            $permohonan->verifikasi_pd_teknis ?? '',
            // VERIFIKASI OLEH DPMPTSP
            $permohonan->verifikasi_dpmptsp ?? '',
            // PENGEMBALIAN (TANGGAL)
            $permohonan->pengembalian ? \Carbon\Carbon::parse($permohonan->pengembalian)->format('d/m/Y') : '',
            // KETERANGAN (pengembalian)
            $permohonan->keterangan_pengembalian ?? '',
            // MENGHADAP NO (TANGGAL)
            $permohonan->menghubungi ? \Carbon\Carbon::parse($permohonan->menghubungi)->format('d/m/Y') : '',
            // KETERANGAN (menghubungi)
            $permohonan->keterangan_menghubungi ?? '',
            // APPROVED (TANGGAL)
            $permohonan->perbaikan ? \Carbon\Carbon::parse($permohonan->perbaikan)->format('d/m/Y') : '',
            // KETERANGAN (perbaikan)
            $permohonan->keterangan_perbaikan ?? '',
            // TERBIT (TANGGAL)
            $permohonan->terbit ? \Carbon\Carbon::parse($permohonan->terbit)->format('d/m/Y') : '',
            // KETERANGAN (terbit)
            $permohonan->keterangan_terbit ?? '',
            // PEMROSES DAN TGL E-SURAT DAN TGL PERTEK
            $permohonan->created_at ? \Carbon\Carbon::parse($permohonan->created_at)->format('d/m/Y') : '',
            // VERIFIKATOR
            $permohonan->verifikator ?? '',
            // STATUS
            $permohonan->status ?? ''
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text with font size 12
            1    => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E3F2FD']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ]
            ],
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 25,  // SEKTOR
            'B' => 15,  // WAKTU
            'C' => 40,  // NO. PERMOHONAN
            'D' => 35,  // NO. PROYEK
            'E' => 25,  // TANGGAL PERMOHONAN
            'F' => 25,  // NIB
            'G' => 18,  // KBLI
            'H' => 35,  // KEGIATAN
            'I' => 25,  // JENIS USAHA
            'J' => 40,  // NAMA PERUSAHAAN
            'K' => 40,  // NAMA USAHA
            'L' => 50,  // ALAMAT PERUSAHAAN
            'M' => 25,  // MODAL USAHA
            'N' => 25,  // JENIS PROYEK
            'O' => 35,  // NAMA PERIZINAN
            'P' => 25,  // SKALA USAHA
            'Q' => 18,  // RISIKO
            'R' => 30,  // JANGKA WAKTU
            'S' => 25,  // NO TELPHONE
            'T' => 35,  // VERIFIKASI PD TEKNIS
            'U' => 35,  // VERIFIKASI ANALISA
            'V' => 25,  // TANGGAL PENGEMBALIAN
            'W' => 35,  // KETERANGAN PENGEMBALIAN
            'X' => 25,  // TANGGAL MENGHUBUNGI
            'Y' => 35,  // KETERANGAN MENGHUBUNGI
            'Z' => 25,  // TANGGAL DISETUJUI
            'AA' => 35, // KETERANGAN DISETUJUI
            'AB' => 25, // TANGGAL TERBIT
            'AC' => 35, // KETERANGAN TERBIT
            'AD' => 45, // PEMROSES
            'AE' => 25, // VERIFIKATOR
            'AF' => 25, // STATUS
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Set all cells to wrap text and center alignment
                $sheet->getStyle('A:AF')->getAlignment()->setWrapText(true);
                $sheet->getStyle('A:AF')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A:AF')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                
                // Set font size 10 for data rows (excluding header)
                $highestRow = $sheet->getHighestRow();
                if ($highestRow > 1) {
                    $sheet->getStyle('A2:AF' . $highestRow)->getFont()->setSize(10);
                }
                
                // Set row height for header (wider)
                $sheet->getRowDimension(1)->setRowHeight(40);
                
                // Set borders for all data
                $sheet->getStyle('A1:AF' . $highestRow)->getBorders()->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                
                // Auto-fit columns
                foreach (range('A', 'AF') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(false);
                }
            },
        ];
    }
}
