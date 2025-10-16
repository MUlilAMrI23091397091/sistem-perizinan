<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Permohonan - Landscape</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            margin: 0;
            padding: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 8px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }
        .header p {
            margin: 3px 0 0 0;
            font-size: 10px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 3px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f5f5f5;
            font-weight: normal;
            font-size: 7px;
            padding: 6px 3px;
        }
        td {
            font-size: 7px;
        }
        .status-diterima {
            background-color: #d4edda;
            color: #155724;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 6px;
        }
        .status-dikembalikan {
            background-color: #fff3cd;
            color: #856404;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 6px;
        }
        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 6px;
        }
        .status-menunggu {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 6px;
        }
        .status-terlambat {
            background-color: #f8d7da;
            color: #721c24;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 6px;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
        /* Column widths for landscape optimization */
        .col-no { width: 3%; }
        .col-nomor { width: 8%; }
        .col-tanggal { width: 6%; }
        .col-nama { width: 12%; }
        .col-alamat { width: 15%; }
        .col-jenis { width: 8%; }
        .col-skala { width: 6%; }
        .col-sektor { width: 6%; }
        .col-status { width: 6%; }
        .col-keterangan { width: 8%; }
        .col-keterangan-pengembalian { width: 8%; }
        .col-keterangan-menghubungi { width: 8%; }
        .col-keterangan-disetujui { width: 8%; }
        .col-keterangan-terbit { width: 8%; }
    </style>
</head>
<body>
    <div class="header">
        <h1>DATA PERMOHONAN IZIN USAHA</h1>
        <p>Tanggal Export: {{ date('d F Y, H:i') }}</p>
    </div>

    @if($permohonans->count() > 0)
        <table>
            <thead>
                <tr>
                    <th class="col-no">No</th>
                    <th class="col-nomor">No. Permohonan</th>
                    <th class="col-tanggal">Tanggal</th>
                    <th class="col-nama">Nama Usaha</th>
                    <th class="col-alamat">Alamat</th>
                    <th class="col-jenis">Jenis Usaha</th>
                    <th class="col-skala">Skala</th>
                    <th class="col-sektor">Sektor</th>
                    <th class="col-status">Status</th>
                    <th class="col-keterangan">Keterangan</th>
                    <th class="col-keterangan-pengembalian">Keterangan Pengembalian</th>
                    <th class="col-keterangan-menghubungi">Keterangan Menghubungi</th>
                    <th class="col-keterangan-disetujui">Keterangan Disetujui</th>
                    <th class="col-keterangan-terbit">Keterangan Terbit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permohonans as $index => $permohonan)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $permohonan->nomor_permohonan ?? '-' }}</td>
                        <td>{{ $permohonan->tanggal_permohonan ? \Carbon\Carbon::parse($permohonan->tanggal_permohonan)->format('d/m/Y') : '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($permohonan->nama_usaha ?? '', 20) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($permohonan->alamat_usaha ?? '', 25) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($permohonan->jenis_usaha ?? '', 15) }}</td>
                        <td class="text-center">{{ $permohonan->skala_usaha ?? '-' }}</td>
                        <td class="text-center">{{ $permohonan->sektor ?? '-' }}</td>
                        <td class="text-center">
                            @php
                                $status = $permohonan->status ?? 'Menunggu';
                                $statusClass = match($status) {
                                    'Diterima' => 'status-diterima',
                                    'Dikembalikan' => 'status-dikembalikan',
                                    'Ditolak' => 'status-ditolak',
                                    'Menunggu' => 'status-menunggu',
                                    'Terlambat' => 'status-terlambat',
                                    default => 'status-menunggu'
                                };
                            @endphp
                            <span class="{{ $statusClass }}">{{ $status }}</span>
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($permohonan->keterangan ?? '', 15) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($permohonan->keterangan_pengembalian ?? '', 15) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($permohonan->keterangan_menghubungi ?? '', 15) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($permohonan->keterangan_disetujui ?? '', 15) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($permohonan->keterangan_terbit ?? '', 15) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p>Tidak ada data permohonan yang ditemukan.</p>
        </div>
    @endif
</body>
</html>
