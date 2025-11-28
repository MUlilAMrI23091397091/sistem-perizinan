<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Pemeriksaan - {{ $permohonan->no_permohonan }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h1 {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
            text-decoration: underline;
        }
        
        .header h2 {
            font-size: 14pt;
            font-weight: bold;
            margin: 10px 0 5px 0;
        }
        
        .header p {
            font-size: 11pt;
            margin: 2px 0;
        }
        
        .content {
            margin: 20px 0;
        }
        
        .content p {
            text-align: justify;
            margin: 10px 0;
            text-indent: 30px;
        }
        
        .content p.no-indent {
            text-indent: 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        
        table.info-table {
            border: none;
        }
        
        table.info-table td {
            border: none;
            padding: 5px 10px;
            vertical-align: top;
        }
        
        table.info-table td.label {
            width: 200px;
            font-weight: bold;
        }
        
        table.info-table td.value {
            width: auto;
        }
        
        .signature-section {
            margin-top: 50px;
            page-break-inside: avoid;
        }
        
        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .signature-table td {
            padding: 10px;
            text-align: center;
            vertical-align: bottom;
        }
        
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 60px;
            padding-top: 5px;
        }
        
        .footer {
            margin-top: 30px;
            font-size: 10pt;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BERITA ACARA PEMERIKSAAN</h1>
        <h2>PERMOHONAN PERIZINAN USAHA</h2>
        <p>Nomor: {{ $permohonan->no_permohonan ?? 'N/A' }}</p>
    </div>
    
    <div class="content">
        <p class="no-indent">
            Pada hari ini <strong>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</strong>, 
            kami yang bertanda tangan di bawah ini:
        </p>
        
        <table class="info-table">
            <tr>
                <td class="label">Nama</td>
                <td class="value">: {{ auth()->user()->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Jabatan</td>
                <td class="value">: {{ auth()->user()->role === 'admin' ? 'Administrator' : (auth()->user()->role === 'dpmptsp' ? 'DPMPTSP' : (auth()->user()->role === 'pd_teknis' ? 'PD Teknis' : 'Staff')) }}</td>
            </tr>
            <tr>
                <td class="label">Instansi</td>
                <td class="value">: Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</td>
            </tr>
        </table>
        
        <p class="no-indent">
            Telah melakukan pemeriksaan terhadap permohonan perizinan usaha dengan data sebagai berikut:
        </p>
        
        <table class="info-table">
            <tr>
                <td class="label">Nomor Permohonan</td>
                <td class="value">: {{ $permohonan->no_permohonan ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Nama Usaha</td>
                <td class="value">: {{ $permohonan->nama_usaha ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Nama Pemohon</td>
                <td class="value">: {{ $permohonan->user?->name ?? 'Akun telah dihapus' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Usaha</td>
                <td class="value">: {{ $permohonan->alamat_usaha ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Usaha</td>
                <td class="value">: {{ $permohonan->jenis_usaha ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Sektor</td>
                <td class="value">: {{ $permohonan->sektor ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="value">: {{ $permohonan->status ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Permohonan</td>
                <td class="value">: {{ $permohonan->created_at ? $permohonan->created_at->locale('id')->translatedFormat('d F Y') : 'N/A' }}</td>
            </tr>
            @if($permohonan->deadline)
            <tr>
                <td class="label">Batas Waktu</td>
                <td class="value">: {{ $permohonan->deadline->locale('id')->translatedFormat('d F Y') }}</td>
            </tr>
            @endif
        </table>
        
        <p>
            Berdasarkan hasil pemeriksaan yang telah dilakukan, permohonan perizinan usaha tersebut 
            @if($permohonan->status === 'Diterima')
                <strong>DITERIMA</strong> dan dinyatakan memenuhi persyaratan yang ditetapkan.
            @elseif($permohonan->status === 'Dikembalikan')
                <strong>DIKEMBALIKAN</strong> untuk dilakukan perbaikan sesuai dengan ketentuan yang berlaku.
                @if($permohonan->keterangan_pengembalian)
                    <br><br>Keterangan: {{ $permohonan->keterangan_pengembalian }}
                @endif
            @elseif($permohonan->status === 'Ditolak')
                <strong>DITOLAK</strong> karena tidak memenuhi persyaratan yang ditetapkan.
            @else
                <strong>MASIH DALAM PROSES</strong> pemeriksaan dan verifikasi.
            @endif
        </p>
        
        @if($permohonan->verifikasi_pd_teknis)
        <p>
            Verifikasi PD Teknis: <strong>{{ $permohonan->verifikasi_pd_teknis }}</strong>
        </p>
        @endif
        
        <p class="no-indent">
            Demikian berita acara pemeriksaan ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>
    
    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td style="width: 50%;">
                    <div class="signature-line">
                        <p style="margin: 0; font-weight: bold;">Pemeriksa</p>
                        <p style="margin-top: 50px; font-weight: bold;">{{ auth()->user()->name ?? 'N/A' }}</p>
                        <p style="margin: 0;">NIP: {{ auth()->user()->nip ?? '-' }}</p>
                    </div>
                </td>
                <td style="width: 50%;">
                    <div class="signature-line">
                        <p style="margin: 0; font-weight: bold;">Mengetahui,</p>
                        <p style="margin: 0; font-weight: bold;">Kepala DPMPTSP</p>
                        <p style="margin-top: 50px; font-weight: bold;">_________________________</p>
                        <p style="margin: 0;">NIP: _________________________</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis oleh Sistem Perizinan pada {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB</p>
    </div>
</body>
</html>

