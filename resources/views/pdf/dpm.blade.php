<!DOCTYPE html>
<html>
<head>
    <title>Data Permohonan DPM</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Permohonan - Tampilan DPM</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Usaha</th>
                <th>Alamat</th>
                <th>Modal Usaha</th>
                <th>Jenis Proyek</th>
                <th>Verifikasi DPMPTSP</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permohonans as $p)
            <tr>
                <td>{{ $p->nama_usaha }}</td>
                <td>{{ $p->alamat_perusahaan }}</td>
                <td>{{ $p->modal_usaha }}</td>
                <td>{{ $p->jenis_proyek }}</td>
                <td>{{ $p->verifikasi_dpmptsp ?? '-' }}</td>
                <td>{{ $p->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>