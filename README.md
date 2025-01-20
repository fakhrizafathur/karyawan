# Dokumentasi API untuk Sistem Manajemen Karyawan

Repositori ini berisi implementasi lengkap sistem manajemen karyawan dengan backend menggunakan Laravel dan frontend menggunakan Vue.js. Fitur yang disediakan mencakup autentikasi dengan JWT, operasi CRUD untuk karyawan dan pekerjaan, serta fitur statistik.

## Fitur

- **Autentikasi**: Sistem login aman menggunakan JWT.
- **Manajemen Karyawan**: Tambah, baca, ubah, dan hapus data karyawan.
- **Manajemen Pekerjaan**: Kelola data pekerjaan dan divisi.
- **Dashboard Statistik**:
  - Total karyawan.
  - Jumlah karyawan aktif dan nonaktif.
  - Filter karyawan berdasarkan divisi.
- **Frontend**: Vue.js untuk tampilan yang responsif dan dinamis.

---

## Persyaratan

- PHP >= 8.0
- Composer
- Node.js >= 16
- NPM/Yarn
- MySQL

---

## Panduan Instalasi

### 1. Clone Repositori
```bash
git clone https://github.com/url-repo-anda.git
cd folder-repo-anda
```

### 2. Konfigurasi Backend
1. Masuk ke direktori backend.
   ```bash
   cd backend
   ```

2. Install dependency.
   ```bash
   composer install
   ```

3. Konfigurasi file `.env`.
   ```bash
   cp .env.example .env
   ```
   Ubah pengaturan berikut di file `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=user_database
   DB_PASSWORD=password_database
   ```

4. Generate application key.
   ```bash
   php artisan key:generate
   ```

5. Jalankan migrasi dan seeder.
   ```bash
   php artisan migrate --seed
   ```

6. Jalankan server.
   ```bash
   php artisan serve
   ```

### 3. Konfigurasi Frontend
1. Masuk ke direktori frontend.
   ```bash
   cd frontend
   ```

2. Install dependency.
   ```bash
   npm install
   ```

3. Jalankan aplikasi.
   ```bash
   npm run dev
   ```

---

## Endpoint API

### Autentikasi
- **Login**: `POST /api/login`
  - Body Request:
    ```json
    {
      "email": "email@example.com",
      "password": "password123"
    }
    ```

### Karyawan
- **Get Semua Karyawan**: `GET /api/karyawan`
- **Tambah Karyawan**: `POST /api/karyawan`
  - Body Request:
    ```json
    {
      "nama": "John Doe",
      "status": "aktif",
      "pekerjaan_id": 1
    }
    ```
- **Ubah Karyawan**: `PUT /api/karyawan/{id}`
- **Hapus Karyawan**: `DELETE /api/karyawan/{id}`

### Pekerjaan
- **Get Semua Pekerjaan**: `GET /api/pekerjaan`
- **Tambah Pekerjaan**: `POST /api/pekerjaan`
  - Body Request:
    ```json
    {
      "pekerjaan": "Software Engineer",
      "divisi": "IT"
    }
    ```
- **Ubah Pekerjaan**: `PUT /api/pekerjaan/{id}`
- **Hapus Pekerjaan**: `DELETE /api/pekerjaan/{id}`

### Statistik
- **Get Statistik**: `GET /api/statistics`
  - Query Parameter:
    - `divisi`: Filter berdasarkan divisi (opsional).

---

## Lisensi

Proyek ini dilisensikan di bawah MIT License. Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

---
