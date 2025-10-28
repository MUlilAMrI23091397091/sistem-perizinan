# Sistem Perizinan

Web application berbasis Laravel untuk pengelolaan proses perizinan usaha secara digital. Sistem ini menyediakan platform terintegrasi bagi berbagai pemangku kepentingan dalam proses perizinan, mulai dari pengajuan hingga penerbitan dokumen resmi.

## Deskripsi Sistem

Sistem Perizinan adalah aplikasi web yang dirancang untuk mengoptimalkan proses pengurusan perizinan usaha. Sistem ini mendukung workflow multi-level dengan kontrol akses berdasarkan peran pengguna, memungkinkan pengelolaan yang efisien dari tahap pengajuan hingga persetujuan dan penerbitan dokumen.

## Fitur Utama

### Autentikasi dan Keamanan
- Sistem login dengan validasi CAPTCHA untuk meningkatkan keamanan
- Role-based access control dengan 4 level akses berbeda
- Session management dan monitoring aktivitas pengguna
- Validasi data pada level model dan controller

### Manajemen Pengguna
- 4 role dengan permission berbeda: Administrator, DPMPTSP, PD Teknis, Penerbitan Berkas
- User management dengan kontrol penuh untuk administrator
- Validasi kredensial pada level database dan aplikasi
- Pengaturan profil pengguna dengan update keamanan

### Pengelolaan Permohonan
- Full CRUD untuk data permohonan
- Tracking status: Menunggu, Diterima, Ditolak, Dikembalikan, Terlambat
- Filter multi-kriteria: status, sektor, tanggal, jenis usaha
- Deteksi otomatis permohonan yang melewati deadline
- Log aktivitas untuk audit trail

### Dashboard dan Analitik
- Dashboard khusus untuk setiap role pengguna
- Statistik real-time dengan visualisasi grafik
- Chart distribusi status permohonan
- Filter statistik berdasarkan periode waktu
- Monitoring kinerja dan metrik operasional

### Ekspor Data dan Laporan
- Ekspor data ke format Excel dengan formatting lengkap
- Ekspor data ke PDF landscape dengan layout tabel optimal
- Filter custom berdasarkan rentang tanggal
- Generate dokumen penerbitan berkas dengan signature digital
- Template PDF yang dapat dikustomisasi

### Konfigurasi Sistem
- Pengaturan tanda tangan digital untuk dokumen resmi
- Manajemen master data jenis usaha
- Konfigurasi parameter sistem
- Pengaturan role dan permission

### User Interface
- Desain modern menggunakan Tailwind CSS framework
- Responsive layout untuk berbagai ukuran layar
- Interaktif dengan Alpine.js untuk interaksi real-time
- Grafik visualisasi dengan Chart.js
- Konsistensi warna dan tipografi

## Stack Teknologi

### Backend
- Laravel 11.x
- PHP 8.2+
- MySQL Database
- Eloquent ORM untuk database abstraction
- Form Request Validation untuk input validation

### Frontend
- Tailwind CSS untuk styling
- Alpine.js untuk interaktivitas
- Chart.js untuk visualisasi data
- Blade templating engine

### Dependencies
- mews/captcha: Implementasi CAPTCHA security
- maatwebsite/excel: Ekspor ke format Excel
- barryvdh/laravel-dompdf: Generasi dokumen PDF

## Instalasi

### Prasyarat
- PHP versi 8.2 atau lebih tinggi
- Composer untuk dependency management
- Node.js dan NPM untuk asset compilation
- MySQL versi 5.7 atau lebih tinggi
- Web server (Apache/Nginx)

### Langkah Instalasi

1. Clone repository ke direktori lokal
```bash
git clone https://github.com/MUlilAMrl23091397091/sistem-perizinan.git
cd sistem-perizinan
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install
```

4. Konfigurasi environment
```bash
cp .env.example .env
php artisan key:generate
```

5. Konfigurasi database pada file .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

6. Jalankan database migration
```bash
php artisan migrate
php artisan db:seed
```

7. Buat symbolic link untuk storage
```bash
php artisan storage:link
```

8. Compile frontend assets
```bash
npm run build
```

9. Optimasi performa aplikasi
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

10. Jalankan development server
```bash
php artisan serve
```

Aplikasi dapat diakses melalui http://localhost:8000

## Struktur Database

Tabel utama dalam sistem:
- users: Data pengguna dan credential
- permohonans: Data permohonan perizinan
- penerbitan_berkas: Data penerbitan dokumen resmi
- jenis_usaha: Master data kategori usaha
- ttd_settings: Konfigurasi tanda tangan digital
- log_permohonans: Log aktivitas permohonan

## Optimasi Performa

Sistem dilengkapi dengan optimasi performa berikut:
- Database indexing untuk mempercepat query
- Image compression dan optimization
- Caching untuk configuration, routes, dan views
- GZIP compression untuk mengurangi ukuran response
- Browser caching untuk static assets
- Memory optimization untuk dataset besar
- Pagination untuk mengurangi beban memory

## Keamanan

Fitur keamanan yang diimplementasikan:
- Password hashing menggunakan bcrypt
- CSRF protection untuk form submission
- CAPTCHA validation untuk mencegah automated attacks
- SQL injection prevention melalui Eloquent ORM
- XSS protection dengan output escaping
- Role-based authorization untuk kontrol akses
- Session security dengan regenerate token

## Kontribusi

Kontribusi untuk pengembangan sistem ini sangat diterima. Silakan buat issue untuk melaporkan bug atau mengajukan fitur baru, atau submit pull request untuk perbaikan dan enhancement.

## Lisensi

Proyek ini menggunakan MIT License. Lihat file LICENSE untuk detail lengkap.

## Dokumentasi

Untuk dokumentasi lebih lengkap mengenai fitur dan penggunaan sistem, silakan kunjungi Wiki section repository ini.

---

Dikembangkan menggunakan Laravel Framework
