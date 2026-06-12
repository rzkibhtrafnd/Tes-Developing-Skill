# Tes Developing Skill

## Fitur Utama
* **Secure Authentication**: Sistem login dan registrasi terpusat menggunakan Laravel Breeze dengan pengamanan rute (*middleware protection*) terenkripsi.
* **Layered Architecture (Service Pattern)**: Pemisahan logika bisnis yang bersih antara Controller dan Service Layer untuk memastikan kode mudah dirawat (*maintainable*).
* **Interactive Dashboard Analytics**: Visualisasi grafik distribusi omset per area menggunakan **Chart.js** yang dikompilasi secara lokal via Vite CLI, serta papan peringkat (*leaderboard*) performa sales berbasis query analitis dinamis.
* **Flexible Transaction Inputs**: Mendukung dua metode input data transaksi: pengisian form manual yang aman dengan proteksi Form Request, serta impor data massal via file Excel.
* **Advanced Data Export**: Fitur download laporan ringkasan transaksi instan ke dalam format **Excel** dan dokumen **PDF** berukuran kertas A4 Portrait yang siap cetak.

---

## Persyaratan Sistem

- **PHP** (v8.2 ke atas)
- **Composer**
- **MySQL** atau **MariaDB**
- **Node.js & NPM** (untuk kompilasi aset Vite)

---

## Tutorial Instalasi

### 1. Clone the Repository
```bash
git clone [https://github.com/rzkibhtrafnd/cashlyExpressJS.git](https://github.com/rzkibhtrafnd/cashlyExpressJS.git)
cd cashlyExpressJS
```

### 2. Install Dependencies
Instal semua package PHP (Laravel) dan library Javascript (Tailwind & Chart.js)
```bash
# Instal dependensi backend PHP
composer install

# Instal dependensi frontend Node.js
npm install
```

### 3. Konfigurasi Environment
Buka file .env tersebut dan sesuaikan konfigurasi koneksi database MySQL Anda:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=
```
Generate application key baru untuk keamanan enkripsi aplikasi:
```bash
php artisan key:generate
```

### 4. Setup Database & Seeding Data
Jalankan migrasi untuk menyusun skema tabel dengan Foreign Key Constraint yang benar, sekaligus mengisinya dengan data awal bawaan studi kasus melalui seeder resmi:
```bash
php artisan migrate:fresh --seed
```

### Jalankan Aplikasi
Nyalakan server lokal Laravel dan compiler aset Vite secara bersamaan melalui dua jendela terminal terpisah:
```bash
# Terminal 1: Jalankan Server Backend Laravel
php artisan serve

# Terminal 2: Jalankan Compiler Aset Frontend (Vite)
npm run dev
```
---
