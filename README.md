# Sistem Perizinan - Web Application

<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<p align="center">
<a heavenly">PHP ^8.2</a>
<a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-11.x-red.svg" alt="Laravel"></a>
<a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License"></a>
</p>

## 📋 Deskripsi

**Sistem Perizinan** adalah aplikasi web berbasis Laravel untuk mengelola proses perizinan bisnis secara digital. Sistem ini dirancang untuk memfasilitasi pengurusan perizinan dengan workflow yang terintegrasi antara berbagai pihak terkait.

## ✨ Fitur Utama

### 🔐 Autentikasi & Keamanan
- **Login dengan CAPTCHA** - Perlindungan tambahan untuk semua pengguna
- **Role-Based Access Control (RBAC)** - 4 level akses dengan permission berbeda
- **Session Management** - Keamanan dan monitoring aktifitas pengguna

### 👥 User Roles
1. **Admin** - Full control atas sistem dan user management
2. **DPMPTSP** - Pengelolaan dan verifikasi permohonan
3. **PD Teknis** - Verifikasi teknis berdasarkan sektor
4. **Penerbitan Berkas** - Pengelolaan dokumen resmi dan persetujuan akhir

### 📝 Manajemen Permohonan
- **CRUD Permohonan** - Buat, edit, lihat, dan hapus permohonan
- **Multi-Status Tracking** - Menunggu, Diterima, Ditolak, Dikembalikan, Terlambat
- **Filter Dinamis** - Status, Sektor, Tanggal, dan Jenis Usaha
- **Overdue Detection** - Otomatis deteksi permohonan yang terlambat

### 📊 Dashboard & Statistik
- **Role-Based Dashboard** - Dashboard khusus untuk setiap role
- **Statistik Real-time** - Grafik dan chart distribusi permohonan
- **Status Visualization** - Visualisasi status dengan bright color gradients
- **Date Range Filter** - Filter statistik berdasarkan periode

### 📄 Export & Laporan
- **Excel Export** - Export data ke format Excel (.xlsx)
- **PDF Export** - Export data ke PDF landscape
- **Custom Date Range** - Filter data berdasarkan periode
- **Penerbitan Berkas PDF** - Generate dokumen resmi dengan TTD digital

### ⚙️ Konfigurasi Sistem
- **Pengaturan TTD** - Konfigurasi tanda tangan digital
- **Jenis Usaha Management** - Pengelolaan kategori usaha
- **User Management** - Pengelolaan user dengan validasi model-level

### 🎨 UI/UX Features
- **Modern Design** - Interface dengan Tailwind CSS
- **Responsive Layout** - Optimal di semua device
- **Real-time Updates** - Status changes terupdate langsung
- **Interactive Charts** - Grafik interaktif dengan Chart.js

## 🛠️ Teknologi

### Backend
- **Framework:** Laravel 11.x
- **Language:** PHP 8.2+
- **Database:** MySQL
- **ORM:** Eloquent ORM
- **Validation:** Form Request & Model Validation

### Frontend
- **CSS Framework:** Tailwind CSS
- **JavaScript:** Alpine.js
- **Charts:** Chart.js
- **Icon:** Heroicons

### Packages
- **mews/captcha** - CAPTCHA implementation
- **maatwebsite/excel** - Excel export functionality
- **barryvdh/laravel-dompdf** - PDF generation

## 📦 Instalasi

### Requirements
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL >= 5.7

### Setup

1. **Clone repository**
```bash
git clone https://github.com/MUlilAMrl23091397091/sistem-perizinan.git
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

4. **Configure database**
Edit `.env` file dengan kredensial database Anda:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
php artisan migrate
php artisan db:seed
```

6. **Link storage**
```bash
php artisan storage:link
```

7. **Build assets**
```bash
npm run build
```

8. **Optimize application**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

9. **Start development server**
```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

## 🔑 Default Credentials

Setelah menjalankan seeder, gunakan kredensial berikut:

### Admin
- Email: `admin@example.com`
- Password: `password`

### DPMPTSP
- Email: `dpmptsp@example.com`
- Password: `password`

DEPERBAIKI kedepannya, sistem ini sudah direncanakan untuk deploy ke server production dengan konfigurasi keamanan yang lebih ketat.

## 🚀 Performance Optimizations

- ✅ Database indexing untuk query optimization
- ✅ Image compression dan optimization
- ✅ Caching strategies (config, routes, views)
- ✅ GZIP compression via .htaccess
- ✅ Browser caching untuk static assets
- ✅ Memory optimization untuk large datasets
- ✅ Pagination untuk data besar

## 📱 Screenshots

*(Tambahkan screenshots dashboard, permohonan, dan fitur lainnya)*

## 🤝 Contributing

Kontribusi dipersilakan! Silakan buat issue atau pull request untuk perbaikan dan fitur baru.

## 📄 License

Proyek ini menggunakan [MIT License](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

Dikembangkan dengan ❤️ menggunakan Laravel

## 📞 Support

Untuk pertanyaan atau dukungan, silakan buat issue di GitHub repository ini.

---

<p align="center">Made with <span style="color: #e25555;">&hearts;</span> using Laravel</p>
