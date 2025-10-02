<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penerbitan Berkas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .header h1 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }
        
        .header h2 {
            font-size: 14px;
            font-weight: bold;
            margin: 5px 0;
        }
        
        .header p {
            font-size: 10px;
            margin: 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
            vertical-align: top;
        }
        
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 9px;
        }
        
        td {
            font-size: 8px;
        }

        /* TTD table aligned to header columns */
        table.ttd-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table.ttd-table td {
            border: 0;
            padding: 0;
            vertical-align: top;
        }
        .ttd-cell {
            text-align: center;
            padding-top: 8px;
        }
        
        .ttd-section {
            margin-top: 60px;
            page-break-inside: avoid;
            position: relative;
        }
        
        .ttd-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .ttd-header h3 {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
        }
        
        .separator-line {
            border-top: 1px solid #000;
            margin: 30px 0;
            width: 100%;
        }
        
        .ttd-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 30px;
        }
        
        .ttd-left, .ttd-right {
            width: 45%;
            min-height: 80px;
        }
        
        .ttd-left {
            text-align: left;
        }
        
        .ttd-right {
            text-align: right;
        }
        
        .ttd-name {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 11px;
            line-height: 1.3;
        }
        
        .ttd-title {
            font-size: 10px;
            margin-bottom: 3px;
            line-height: 1.3;
        }
        
        .ttd-nip {
            font-size: 9px;
            margin-bottom: 0;
            line-height: 1.3;
        }
        
        .ttd-date {
            font-size: 10px;
            margin-bottom: 10px;
            line-height: 1.3;
        }
        
        .ttd-position {
            font-size: 10px;
            margin-bottom: 5px;
            line-height: 1.3;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        .footer {
            margin-top: 40px;
            font-size: 8px;
            text-align: center;
            color: #666;
        }
        
        /* Additional styling for better TTD layout */
        .ttd-content {
            position: relative;
        }
        
        .ttd-left, .ttd-right {
            position: relative;
            padding: 10px 0;
        }
        
        .ttd-left .ttd-name,
        .ttd-right .ttd-name {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PERIZINAN BERUSAHA DISETUJUI</h1>
        <h2>DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</h2>
        <h2>KOTA SURABAYA TAHUN {{ date('Y') }}</h2>
        <p>Data Penerbitan Berkas - {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 3%;">NO</th>
                <th style="width: 10%;">NO. PERMOHONAN</th>
                <th style="width: 10%;">NO. PROYEK</th>
                <th style="width: 8%;">TANGGAL PERMOHONAN</th>
                <th style="width: 8%;">NIB</th>
                <th style="width: 6%;">KBLI</th>
                <th style="width: 12%;">NAMA USAHA</th>
                <th style="width: 10%;">KEGIATAN</th>
                <th style="width: 8%;">JENIS PERUSAHAAN</th>
                <th style="width: 10%;">PEMILIK</th>
                <th style="width: 8%;">MODAL USAHA</th>
                <th style="width: 15%;">ALAMAT</th>
                <th style="width: 6%;">JENIS PROYEK</th>
                <th style="width: 10%;">NAMA PERIZINAN</th>
                <th style="width: 6%;">SKALA USAHA</th>
                <th style="width: 6%;">RISIKO</th>
                <th style="width: 15%;">PEMROSES DAN TGL. E SURAT DAN TGL PERTEK</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penerbitanBerkas as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->no_permohonan ?? '-' }}</td>
                <td>{{ $item->no_proyek ?? '-' }}</td>
                <td>{{ $item->tanggal_permohonan ? \Carbon\Carbon::parse($item->tanggal_permohonan)->format('d/m/Y') : '-' }}</td>
                <td>{{ $item->nib ?? '-' }}</td>
                <td>{{ $item->kbli ?? '-' }}</td>
                <td>{{ $item->nama_usaha ?? '-' }}</td>
                <td>{{ $item->inputan_teks ?? '-' }}</td>
                <td>{{ $item->jenis_pelaku_usaha ?? '-' }}</td>
                <td>{{ $item->pemilik ?? '-' }}</td>
                <td>{{ $item->modal_usaha ? 'Rp ' . number_format($item->modal_usaha, 0, ',', '.') : '-' }}</td>
                <td>{{ $item->alamat_perusahaan ?? '-' }}</td>
                <td>{{ $item->jenis_proyek ?? '-' }}</td>
                <td>{{ $item->nama_perizinan ?? '-' }}</td>
                <td>{{ $item->skala_usaha ?? '-' }}</td>
                <td>{{ $item->risiko ?? '-' }}</td>
                <td>{{ $item->pemroses_dan_tgl_surat ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TTD grid aligned with header columns -->
    <table class="ttd-table">
        <tr>
            <!-- NO (col 1) -->
            <td style="width:3%"></td>
            <!-- NO. PERMOHONAN (col 2) -->
            <td style="width:10%"></td>
            <!-- NO. PROYEK (col 3) -->
            <td style="width:10%"></td>
            <!-- TANGGAL PERMOHONAN (col 4) - LEFT TTD placed under this column -->
            <td style="width:8%" class="ttd-cell">
                <div class="ttd-header">
                    <h3>Mengetahui</h3>
                    <h3>Koordinator Ketua Tim Kerja</h3>
                    <h3>Pelayanan Terpadu Satu Pintu</h3>
                </div>
                <div class="ttd-name">Yohanes Franklin, S.H.</div>
                <div class="ttd-title">Penata Tk.1</div>
                <div class="ttd-nip">NIP: 198502182010011008</div>
            </td>
            <!-- NIB (5) -->
            <td style="width:8%"></td>
            <!-- KBLI (6) -->
            <td style="width:6%"></td>
            <!-- NAMA USAHA (7) -->
            <td style="width:12%"></td>
            <!-- KEGIATAN (8) -->
            <td style="width:10%"></td>
            <!-- JENIS PERUSAHAAN (9) -->
            <td style="width:8%"></td>
            <!-- PEMILIK (10) -->
            <td style="width:10%"></td>
            <!-- MODAL USAHA (11) -->
            <td style="width:8%"></td>
            <!-- ALAMAT (12) -->
            <td style="width:15%"></td>
            <!-- JENIS PROYEK (13) -->
            <td style="width:6%"></td>
            <!-- NAMA PERIZINAN (14) -->
            <td style="width:10%"></td>
            <!-- SKALA USAHA (15) - RIGHT TTD placed under this column -->
            <td style="width:6%" class="ttd-cell">
                <div class="ttd-name">Surabaya, {{ date('d F Y') }}</div>
                <div class="ttd-position">Ketua Tim Kerja Pelayanan Perizinan Berusaha</div>
                <div class="ttd-name">Ulvia Zulvia, ST</div>
                <div class="ttd-title">Penata Tk. 1</div>
                <div class="ttd-nip">NIP: 197710132006042012</div>
            </td>
            <!-- RISIKO (16) -->
            <td style="width:6%"></td>
            <!-- PEMROSES DAN TGL... (17) -->
            <td style="width:15%"></td>
        </tr>
    </table>

    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis pada {{ date('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
