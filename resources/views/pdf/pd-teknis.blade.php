<!DOCTYPE html>
<html>
<head>
    <title>Data Permohonan PD Teknis</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Permohonan - Tampilan PD Teknis</h2>
    <table>
        <thead>
            <tr>
                <th>No. Permohonan</th>
                <th>No. Proyek</th>
                <th>Tgl. Permohonan</th>
                <th>NIB</th>
                <th>Verifikasi PD Teknis</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permohonans as $p)
            <tr>
                <td>{{ $p->no_permohonan }}</td>
                <td>{{ $p->no_proyek }}</td>
                <td>{{ $p->tanggal_permohonan }}</td>
                <td>{{ $p->nib }}</td>
                <td>{{ $p->verifikasi_pd_teknis ?? '-' }}</td>
                <td>{{ $p->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>