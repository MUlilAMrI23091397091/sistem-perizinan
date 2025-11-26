# Dokumentasi Testing API dengan Postman

## Endpoint API yang Tersedia

### 1. GET /api/notifications
**Deskripsi:** Mengambil daftar notifikasi untuk user DPMPTSP dan Admin

**Method:** GET  
**URL:** `http://127.0.0.1:8000/api/notifications`

**Headers:**
```
Accept: application/json
X-Requested-With: XMLHttpRequest
Cookie: [session cookie dari login]
```

**Authorization:**
- Hanya user dengan role `dpmptsp` atau `admin` yang dapat mengakses
- Memerlukan session authentication (login terlebih dahulu)

**Response Success (200):**
```json
{
  "notifications": [
    {
      "id": 1,
      "no_permohonan": "P001/2024",
      "nama_usaha": "PT Contoh",
      "status": "Dikembalikan",
      "tanggal_pengembalian": "15 Januari 2024",
      "keterangan": "Berkas dikembalikan untuk perbaikan",
      "menghubungi": null,
      "keterangan_menghubungi": null,
      "url": "http://127.0.0.1:8000/permohonan/1",
      "created_at": "2 hours ago"
    }
  ],
  "count": 1
}
```

**Response Unauthorized (403):**
- Jika user tidak login atau role bukan dpmptsp/admin, akan return empty array

**Testing Checklist:**
- [ ] Test dengan user dpmptsp (harus berhasil)
- [ ] Test dengan user admin (harus berhasil)
- [ ] Test dengan user pd_teknis (harus return empty)
- [ ] Test tanpa login (harus return empty)
- [ ] Test dengan invalid session (harus return empty)

---

### 2. POST /api/notifications/{id}/update
**Deskripsi:** Update status dan informasi menghubungi dari notifikasi

**Method:** POST  
**URL:** `http://127.0.0.1:8000/api/notifications/{id}/update`

**Headers:**
```
Content-Type: application/json
Accept: application/json
X-Requested-With: XMLHttpRequest
X-CSRF-TOKEN: [token dari meta tag atau session]
Cookie: [session cookie dari login]
```

**Body (JSON):**
```json
{
  "status": "Dihubungi",
  "menghubungi": "2024-01-20",
  "keterangan_menghubungi": "Telah dihubungi via telepon",
  "_token": "[CSRF token]"
}
```

**Validation Rules:**
- `status`: required, harus salah satu: `Menunggu`, `Dikembalikan`, `Diterima`, `Ditolak`
- `menghubungi`: nullable, format date (Y-m-d)
- `keterangan_menghubungi`: nullable, string

**Authorization:**
- Hanya user dengan role `dpmptsp` atau `admin` yang dapat mengakses
- Memerlukan session authentication

**Response Success (200):**
```json
{
  "success": true,
  "message": "Status dan data menghubungi berhasil diperbarui",
  "data": {
    "id": 1,
    "status": "Dihubungi",
    "menghubungi": "2024-01-20",
    "keterangan_menghubungi": "Telah dihubungi via telepon"
  }
}
```

**Response Error (403):**
```json
{
  "error": "Unauthorized"
}
```

**Response Validation Error (422):**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "status": ["The status field is required."]
  }
}
```

**Testing Checklist:**
- [ ] Test dengan user dpmptsp (harus berhasil)
- [ ] Test dengan user admin (harus berhasil)
- [ ] Test dengan user pd_teknis (harus return 403)
- [ ] Test tanpa login (harus return 403)
- [ ] Test dengan invalid CSRF token (harus return 419)
- [ ] Test dengan status invalid (harus return 422)
- [ ] Test dengan ID permohonan yang tidak ada (harus return 404)
- [ ] Test dengan menghubungi format invalid (harus return 422)

---

### 3. POST /bap/ttd/update
**Deskripsi:** Update nama, NIP, dan TTD koordinator untuk BAP (hanya admin yang bisa edit nama dan NIP)

**Method:** POST  
**URL:** `http://127.0.0.1:8000/bap/ttd/update`

**Headers:**
```
Content-Type: application/json
Accept: application/json
X-Requested-With: XMLHttpRequest
X-CSRF-TOKEN: [token dari meta tag atau session]
Cookie: [session cookie dari login]
```

**Body (JSON):**
```json
{
  "nama_mengetahui": "Yohanes Franklin, S.H., M.H.",
  "nip_mengetahui": "198502182010011008",
  "_token": "[CSRF token]"
}
```

**Validation Rules:**
- `nama_mengetahui`: required, string, max:255
- `nip_mengetahui`: required, string, max:255
- `ttd_bap_mengetahui`: nullable, string (base64 signature)
- `ttd_bap_mengetahui_file`: nullable, image (jpeg,png,jpg,gif), max:2048KB

**Authorization:**
- Hanya user dengan role `admin` yang dapat mengedit nama dan NIP
- Semua role dapat mengisi TTD (namun endpoint ini khusus untuk admin edit nama/NIP)

**Response Success (200):**
```json
{
  "success": true,
  "message": "Nama dan NIP koordinator berhasil diperbarui."
}
```

**Response Error (403):**
```json
{
  "message": "Hanya admin yang dapat mengedit nama dan NIP koordinator."
}
```

**Response Validation Error (422):**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "nama_mengetahui": ["The nama mengetahui field is required."]
  }
}
```

**Testing Checklist:**
- [ ] Test dengan user admin (harus berhasil)
- [ ] Test dengan user dpmptsp (harus return 403)
- [ ] Test dengan user pd_teknis (harus return 403)
- [ ] Test tanpa login (harus redirect ke login)
- [ ] Test dengan invalid CSRF token (harus return 419)
- [ ] Test dengan nama kosong (harus return 422)
- [ ] Test dengan NIP kosong (harus return 422)
- [ ] Test dengan nama terlalu panjang >255 (harus return 422)

---

## Keamanan yang Sudah Diimplementasikan

### 1. Authentication & Authorization
- ✅ Semua endpoint memerlukan authentication (middleware `auth`)
- ✅ Role-based access control untuk setiap endpoint
- ✅ Validasi role sebelum memberikan akses

### 2. CSRF Protection
- ✅ Laravel CSRF token required untuk semua POST requests
- ✅ Token validation di setiap form submission

### 3. Input Validation
- ✅ Request validation untuk semua input
- ✅ Type checking dan format validation
- ✅ Max length validation untuk string fields

### 4. SQL Injection Protection
- ✅ Menggunakan Eloquent ORM (parameterized queries)
- ✅ Tidak ada raw SQL queries yang vulnerable

### 5. XSS Protection
- ✅ Blade templating auto-escape
- ✅ JSON response dengan proper encoding

### 6. Session Security
- ✅ Session regeneration setelah login
- ✅ Session invalidation setelah logout
- ✅ Secure session cookies

---

## Cara Testing dengan Postman

### Setup Awal
1. **Login terlebih dahulu** melalui browser atau Postman:
   - POST `http://127.0.0.1:8000/login`
   - Body: `email` dan `password`
   - Simpan session cookie yang diterima

2. **Ambil CSRF Token:**
   - GET `http://127.0.0.1:8000/login` (atau halaman lain)
   - Extract token dari meta tag `<meta name="csrf-token" content="...">`
   - Atau gunakan session untuk auto-include token

### Testing di Postman

1. **Collection Setup:**
   - Buat collection baru: "Sistem Perizinan API"
   - Set collection variables:
     - `base_url`: `http://127.0.0.1:8000`
     - `csrf_token`: (akan diisi setelah login)

2. **Pre-request Script untuk Auto CSRF:**
   ```javascript
   // Ambil CSRF token dari response sebelumnya
   if (pm.response && pm.response.headers.get("X-CSRF-TOKEN")) {
       pm.collectionVariables.set("csrf_token", pm.response.headers.get("X-CSRF-TOKEN"));
   }
   ```

3. **Headers untuk setiap request:**
   - `Accept: application/json`
   - `X-Requested-With: XMLHttpRequest`
   - `X-CSRF-TOKEN: {{csrf_token}}`
   - `Cookie: [session cookie dari login]`

### Test Cases yang Harus Dilakukan

#### Test Case 1: Authorization Testing
- Test setiap endpoint dengan berbagai role
- Pastikan hanya role yang diizinkan yang bisa mengakses

#### Test Case 2: CSRF Protection
- Test POST request tanpa CSRF token (harus fail)
- Test POST request dengan invalid CSRF token (harus fail)

#### Test Case 3: Input Validation
- Test dengan data kosong
- Test dengan data invalid format
- Test dengan data yang melebihi max length

#### Test Case 4: SQL Injection Attempt
- Test dengan input seperti: `'; DROP TABLE users; --`
- Pastikan tidak ada error dan data tetap aman

#### Test Case 5: XSS Attempt
- Test dengan input seperti: `<script>alert('XSS')</script>`
- Pastikan script tidak dieksekusi

---

## Catatan Penting

1. **Session Management:** Pastikan session cookie tetap valid selama testing
2. **CSRF Token:** Token harus diambil ulang jika session expired
3. **Rate Limiting:** Tidak ada rate limiting yang diimplementasikan, pertimbangkan untuk production
4. **CORS:** Jika perlu akses dari domain berbeda, konfigurasi CORS di `config/cors.php`

---

## Rekomendasi Keamanan Tambahan

1. **Rate Limiting:**
   - Implement rate limiting untuk API endpoints
   - Gunakan Laravel's built-in rate limiter

2. **API Token Authentication:**
   - Pertimbangkan menggunakan API tokens untuk mobile apps
   - Gunakan Laravel Sanctum atau Passport

3. **Request Logging:**
   - Log semua API requests untuk audit trail
   - Monitor suspicious activities

4. **Input Sanitization:**
   - Tambahkan sanitization tambahan jika diperlukan
   - Validasi file upload lebih ketat

5. **HTTPS:**
   - Pastikan menggunakan HTTPS di production
   - Enforce HTTPS redirect

