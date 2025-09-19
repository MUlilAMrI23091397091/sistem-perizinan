{{-- FILE: resources/views/pdf/semua.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Data Semua Permohonan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #dddddd; text-align: left; padding: 6px; font-size: 10px; word-wrap: break-word; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Lengkap Permohonan</h2>
    <table>
        <thead>
            <tr>
                <th>Sektor</th>
                <th>No. Permohonan</th>
                <th>No. Proyek</th>
                <th>NIB</th>
                <th>Nama Usaha</th>
                <th>Verifikasi PD Teknis</th>
                <th>Verifikasi DPMPTSP</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permohonans as $p)
            <tr>
                <td>{{ $p->sektor }}</td>
                <td>{{ $p->no_permohonan }}</td>
                <td>{{ $p->no_proyek }}</td>
                <td>{{ $p->nib }}</td>
                <td>{{ $p->nama_usaha }}</td>
                <td>{{ $p->verifikasi_pd_teknis ?? '-' }}</td>
                <td>{{ $p->verifikasi_dpmptsp ?? '-' }}</td>
                <td>{{ $p->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
