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
- Generate Berita Acara Pemeriksaan (BAP) dalam format PDF
- Form BAP dengan validasi client-side dan server-side
- Tabel persyaratan dinamis dengan checkbox interaktif

### Konfigurasi Sistem
- Pengaturan tanda tangan digital untuk dokumen resmi
- Manajemen master data jenis usaha
- Konfigurasi parameter sistem
- Pengaturan role dan permission
- Pengaturan koordinator untuk dokumen BAP (nama dan NIP)
- Edit koordinator khusus untuk administrator

### User Interface
- Desain modern menggunakan Tailwind CSS framework
- Responsive layout untuk berbagai ukuran layar
- Interaktif dengan Alpine.js untuk interaksi real-time
- Grafik visualisasi dengan Chart.js
- Konsistensi warna dan tipografi
- Digital signature pad untuk tanda tangan elektronik
- Notifikasi real-time untuk berkas dikembalikan
- Modal notifikasi dengan expand/collapse untuk detail
- Form validation dengan feedback visual menggunakan SweetAlert2

### Berita Acara Pemeriksaan (BAP)
- Form BAP dengan validasi lengkap (client-side dan server-side)
- Tabel persyaratan dinamis yang dapat ditambah/dikurangi
- Status persyaratan: Sesuai, Tidak Sesuai, Belum Ada
- Sub-item persyaratan untuk detail lebih lanjut
- Digital signature pad untuk tanda tangan pemeriksa dan koordinator
- Generate PDF BAP dengan format profesional
- Edit nama dan NIP koordinator (khusus admin)
- Format PDF dengan tabel hitam-putih dan checkmark icon yang kompatibel
- Layout "Mengetahui" dengan format 3 baris yang rapi

### Notifikasi Sistem
- Notifikasi real-time untuk berkas yang dikembalikan
- Badge counter untuk jumlah notifikasi
- Modal notifikasi dengan detail lengkap
- Update status notifikasi: Dikembalikan, Dihubungi, Selesai
- Tracking informasi menghubungi pemohon
- Keterangan menghubungi dengan template cepat
- API endpoint untuk fetch dan update notifikasi
- Filter notifikasi berdasarkan role pengguna

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
- SignaturePad.js untuk digital signature
- SweetAlert2 untuk alert dan konfirmasi
- AJAX untuk interaksi tanpa reload halaman

### Dependencies
- mews/captcha: Implementasi CAPTCHA security
- maatwebsite/excel: Ekspor ke format Excel
- barryvdh/laravel-dompdf: Generasi dokumen PDF
- doctrine/dbal: Database abstraction layer untuk migration dengan modifikasi kolom
- signature_pad: Digital signature pad untuk tanda tangan elektronik
- sweetalert2: Alert dan notification yang user-friendly

## Instalasi

### Prasyarat
- PHP versi 8.2 atau lebih tinggi
- Composer untuk dependency management
- Node.js dan NPM untuk asset compilation
- MySQL versi 5.7 atau lebih tinggi
- Web server (Apache/Nginx)

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/MUlilAMrI23091397091/sistem-perizinan.git
   cd sistem-perizinan
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**
   - Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=username
   DB_PASSWORD=password
   ```

5. **Jalankan Migration**
   ```bash
   php artisan migrate
   ```

6. **Seed database (opsional)**
   ```bash
   php artisan db:seed
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

### Catatan Penting tentang Migration

#### Dependencies yang Diperlukan
- **doctrine/dbal** (v3.8+): Package ini **WAJIB** terinstall untuk migration yang menggunakan method `->change()` untuk memodifikasi kolom. Package ini sudah termasuk dalam `composer.json` dan akan terinstall otomatis saat menjalankan `composer install`.

#### Urutan Migration
Semua migration telah diurutkan dengan benar berdasarkan timestamp untuk memastikan foreign key constraints berjalan dengan baik:
- `users` table dibuat terlebih dahulu
- `permohonans` table dengan foreign key ke `users`
- `log_permohonans` table dengan foreign key ke `permohonans` dan `users`
- `jenis_usahas` table dibuat sebelum relasi ke `permohonans`
- `penerbitan_berkas` table dengan foreign key ke `users` dan `permohonans`

#### Troubleshooting Migration

**Jika migration gagal dengan error "Class 'Doctrine\DBAL\Driver\PDO\MySQL\Driver' not found":**
```bash
composer require doctrine/dbal
php artisan migrate
```

**Jika migration gagal karena index sudah ada:**
- Pastikan database dalam kondisi fresh atau rollback migration terlebih dahulu:
```bash
php artisan migrate:rollback
php artisan migrate
```

**Jika migration gagal karena foreign key constraint:**
- Pastikan semua tabel parent sudah dibuat sebelum tabel child
- Urutan migration sudah diatur otomatis berdasarkan timestamp

**Untuk fresh migration (hapus semua dan buat ulang):**
```bash
php artisan migrate:fresh
php artisan db:seed
```

#### Migration yang Telah Dioptimasi
- ✅ Semua migration menggunakan nama index yang benar untuk kompatibilitas cross-database
- ✅ Migration kosong telah dihapus untuk menghindari error
- ✅ Semua migration memiliki method `down()` yang benar untuk rollback
- ✅ Foreign key constraints diurutkan dengan benar (parent table dibuat sebelum child table)
- ✅ Semua migration yang menggunakan `->change()` memerlukan `doctrine/dbal` (sudah terinstall)
- ✅ Index naming convention konsisten: `{table}_{column}_index` atau `{table}_{column1}_{column2}_index`
- ✅ Semua migration telah diuji dan berjalan dengan baik

#### Verifikasi Migration
Untuk memastikan semua migration aman saat pindah device:
1. Pastikan `doctrine/dbal` sudah terinstall: `composer show doctrine/dbal`
2. Pastikan urutan migration benar: `php artisan migrate:status`
3. Test rollback migration: `php artisan migrate:rollback --step=1` (jika perlu)
4. Test fresh migration: `php artisan migrate:fresh` (di development environment)

## Keamanan

### Implementasi Keamanan
- ✅ Authentication & Authorization dengan role-based access control
- ✅ CSRF Protection untuk semua POST requests
- ✅ Input Validation dengan Laravel Form Request
- ✅ SQL Injection Protection menggunakan Eloquent ORM
- ✅ XSS Protection dengan Blade auto-escape
- ✅ Session Security dengan regeneration dan secure cookies
- ✅ CAPTCHA untuk form login

### Rekomendasi untuk Production
- Implement rate limiting untuk API endpoints
- Gunakan HTTPS untuk semua komunikasi
- Enable request logging untuk audit trail
- Pertimbangkan API token authentication untuk mobile apps
- Implementasi monitoring dan alerting untuk suspicious activities

---

Dikembangkan menggunakan Laravel Framework
