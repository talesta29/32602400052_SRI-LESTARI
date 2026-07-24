<div align="center">

# 🍜 PRAKTIKUM WEB PROGRAMMING
### Warung Nusantara — Aplikasi Penjualan Makanan Berbasis Web

Dibangun dengan **CodeIgniter 4** · **PHP 8.2+** · **MySQL/MariaDB** · **Bootstrap 5**

</div>

<br>

## 👥 Anggota Kelompok

<div align="center">

**TIM 4**

| No | Nama | NIM |
|:--:|------|:---:|
| 1 | Sri Lestari | 32602400052 |
| 2 | Syahrur Baihaqi | 32602400101 |
| 3 | Syariska Indry Astuti | 32602400064 |
| 4 | Abdil Aziz | 32602400042 |
| 5 | Muhammad Nur Rokhim | 32602400028 |

</div>

<br>

## 📑 Daftar Isi

1. [Tentang Aplikasi](#-tentang-aplikasi)
2. [Fitur Utama](#-fitur-utama)
3. [Hak Akses Tiap Role](#-hak-akses-tiap-role)
4. [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
5. [Struktur Folder Proyek](#-struktur-folder-proyek)
6. [Skema Database](#-skema-database)
7. [Alur Kerja Aplikasi](#-alur-kerja-aplikasi)
8. [Cara Instalasi & Menjalankan](#-cara-instalasi--menjalankan)
9. [Akun Default untuk Uji Coba](#-akun-default-untuk-uji-coba)
10. [Daftar Route / URL Penting](#-daftar-route--url-penting)
11. [Manajemen User (Khusus Admin)](#-manajemen-user-khusus-admin)
12. [Catatan Keamanan](#-catatan-keamanan)
13. [Troubleshooting](#-troubleshooting)

<br>

## 📖 Tentang Aplikasi

**Warung Nusantara** adalah aplikasi web sederhana untuk menampilkan dan mengelola menu
makanan khas Nusantara (Mie Ayam, Bakso, Soto, Sate, Nasi Goreng, dll). Aplikasi ini
dibangun sebagai studi kasus **CRUD (Create, Read, Update, Delete)** menggunakan
**Framework CodeIgniter 4**, sekaligus menerapkan konsep **autentikasi**, **otorisasi
berbasis role**, dan **relasi antar tabel** pada database MySQL.

Aplikasi memiliki **3 peran pengguna (role)** — Admin, Penjual, dan Pembeli — masing-masing
dengan hak akses dan halaman yang berbeda, layaknya aplikasi pemesanan makanan pada
umumnya.

<br>

## ✨ Fitur Utama

| Fitur | Deskripsi |
|---|---|
| 🏪 **Etalase Publik** | Halaman utama (`/`) menampilkan katalog makanan lengkap dengan gambar, harga, kategori, status ketersediaan, fitur **pencarian** dan **filter kategori** — bisa diakses tanpa login. |
| 🔐 **Autentikasi** | Login (`/login`) dan Registrasi (`/register`) dengan password **ter-enkripsi (bcrypt)**, sesi menggunakan session bawaan CodeIgniter. |
| 🧑‍🤝‍🧑 **3 Role Pengguna** | Admin, Penjual, dan Pembeli — setiap role memiliki hak akses berbeda, dijaga oleh filter `auth` & `role` di setiap route. |
| 🍽️ **CRUD Data Makanan** | Penjual & Admin dapat menambah, melihat, mengedit, dan menghapus menu makanan lengkap dengan **upload gambar**. |
| 🛒 **Sistem Pemesanan** | Pembeli dapat memesan langsung dari etalase; status pesanan berjalan dari **Menunggu → Diproses → Selesai/Dibatalkan**. |
| 👤 **Manajemen User** | Admin dapat mengelola seluruh akun pengguna (tambah, edit, ubah role, reset password, hapus) lewat satu dashboard khusus. |
| ✅ **Validasi Form** | Validasi input di sisi server (nama, kategori, harga wajib diisi, format email, dsb). |
| 🎨 **Tampilan Modern** | Antarmuka responsif menggunakan **Bootstrap 5**. |
| 🌱 **Data Contoh** | Sudah dilengkapi seeder berisi data awal: Mie Ayam, Bakso, Soto Ayam, Sate Ayam, Nasi Goreng, Es Teh Manis. |

<br>

## 🧩 Hak Akses Tiap Role

```
┌──────────────────────────────────────────────────────────────────────────┐
│                              ADMIN                                       │
│  • Mengelola SEMUA data makanan dari semua penjual                       │
│  • Melihat & memproses SEMUA pesanan yang masuk                          │
│  • Manajemen User penuh (CRUD seluruh akun & role)                       │
├──────────────────────────────────────────────────────────────────────────┤
│                             PENJUAL                                      │
│  • Mendaftar akun sendiri lewat /register                                │
│  • CRUD menu makanan MILIK SENDIRI di /makanan                           │
│  • Melihat & memproses pesanan masuk untuk produknya di /pesanan-masuk   │
├──────────────────────────────────────────────────────────────────────────┤
│                             PEMBELI                                      │
│  • Mendaftar akun sendiri lewat /register                                │
│  • Memesan makanan langsung dari etalase publik (/)                      │
│  • Melihat riwayat pesanan sendiri di /pesanan-saya                      │
└──────────────────────────────────────────────────────────────────────────┘
```

> 🔒 Setiap route dilindungi oleh filter `auth` (harus login) dan `role` (harus sesuai
> peran) yang didefinisikan di `app/Config/Filters.php` & `app/Filters/`.

<br>

## 🛠️ Teknologi yang Digunakan

| Kategori | Teknologi |
|---|---|
| Bahasa Pemrograman | PHP 8.2+ |
| Framework | CodeIgniter 4 |
| Database | MySQL / MariaDB |
| Frontend | Bootstrap 5, HTML5, CSS3 |
| Autentikasi Password | Bcrypt (password_hash) |
| Dependency Manager | Composer |
| Tools Pendukung | phpMyAdmin / XAMPP / Laragon |

<br>

## 📁 Struktur Folder Proyek

```
warung-app/
├── app/
│   ├── Controllers/
│   │   ├── Home.php                 → Etalase publik
│   │   ├── AuthController.php       → Login, Register, Logout
│   │   ├── MakananController.php    → CRUD makanan (Admin & Penjual)
│   │   ├── PesananController.php    → Pemesanan (Pembeli) & kelola pesanan masuk
│   │   └── UserController.php       → Manajemen User (khusus Admin)
│   │
│   ├── Models/
│   │   ├── MakananModel.php
│   │   ├── UserModel.php
│   │   └── PesananModel.php
│   │
│   ├── Views/
│   │   ├── layout/                  → header.php & footer.php
│   │   ├── home/index.php           → Halaman etalase
│   │   ├── auth/                    → login.php, register.php
│   │   ├── makanan/                 → index, create, edit
│   │   ├── pesanan/                 → masuk.php, saya.php
│   │   └── user/                    → index, create, edit (Manajemen User)
│   │
│   ├── Filters/
│   │   ├── AuthFilter.php           → Cek status login
│   │   └── RoleFilter.php           → Cek hak akses berdasarkan role
│   │
│   ├── Database/
│   │   ├── Migrations/              → Struktur tabel users, makanan, pesanan
│   │   └── Seeds/                   → UserSeeder.php & MakananSeeder.php
│   │
│   └── Config/
│       ├── Routes.php               → Definisi seluruh routing
│       └── Filters.php              → Registrasi filter auth & role
│
├── database/
│   └── warung_nusantara.sql         → Dump SQL siap import ke phpMyAdmin
│
├── public/
│   ├── index.php                    → Front controller
│   └── uploads/makanan/             → Folder penyimpanan gambar makanan
│
├── .env                             → Konfigurasi environment (database, dll)
├── composer.json                    → Daftar dependency PHP
└── README.md                        → Dokumen ini
```

<br>

## 🗄️ Skema Database

Database `warung_nusantara` terdiri dari **3 tabel utama** yang saling berelasi:

```
┌────────────────────┐        ┌────────────────────────┐        ┌────────────────────┐
│       users         │        │         makanan          │        │      pesanan        │
├────────────────────┤        ├────────────────────────┤        ├────────────────────┤
│ id (PK)             │◄──┐    │ id (PK)                  │◄──┐    │ id (PK)              │
│ nama                │   │    │ user_id (FK) → users.id  │   │    │ makanan_id (FK)      │
│ username             │   └────│ nama                     │   └────│ user_id (FK, pembeli)│
│ email                │        │ kategori                 │        │ jumlah                │
│ password (hash)      │        │ harga                     │        │ catatan               │
│ role                  │        │ stok                      │        │ status                │
│ created_at            │        │ deskripsi                 │        │ created_at            │
│ updated_at            │        │ gambar                    │        │ updated_at            │
└────────────────────┘        │ created_at, updated_at    │        └────────────────────┘
                                └────────────────────────┘
```

- **`users`** → menyimpan seluruh akun (Admin, Penjual, Pembeli) beserta role-nya.
- **`makanan`** → menyimpan data menu, terhubung ke pemiliknya (`user_id` milik Penjual/Admin).
- **`pesanan`** → mencatat transaksi pemesanan, menghubungkan pembeli dengan menu yang dipesan.

Struktur lengkap tabel dapat dilihat pada file migration di
`app/Database/Migrations/` atau langsung pada `database/warung_nusantara.sql`.

<br>

## 🔄 Alur Kerja Aplikasi

```
  PENJUAL                         PEMBELI                         ADMIN
    │                                │                              │
    ▼                                ▼                              ▼
 Daftar akun (/register)     Daftar akun (/register)        Login sebagai admin
    │                                │                              │
    ▼                                ▼                              ▼
 Tambah menu makanan          Buka etalase publik (/)        Pantau semua data
 (/makanan/create)                   │                        makanan & pesanan
    │                                ▼                              │
    ▼                          Cari & filter menu                   ▼
 Menu tampil di etalase              │                        Kelola akun user
    │                                ▼                        (/user)
    ▼                          Klik "Pesan" → isi jumlah
 Terima notifikasi pesanan     & catatan
 (/pesanan-masuk)                    │
    │                                ▼
    ▼                          Pesanan berstatus "Menunggu"
 Ubah status: Diproses  ─────────────┤
 → Selesai / Dibatalkan              ▼
                               Cek riwayat di /pesanan-saya
```

<br>

## 🚀 Cara Instalasi & Menjalankan

### Persyaratan Sistem

- **PHP 8.2** atau lebih baru
- **MySQL / MariaDB** (disarankan menggunakan **XAMPP** atau **Laragon**)
- Ekstensi PHP aktif: `mysqli`, `mbstring`, `intl`, `curl`, `xml`
- **phpMyAdmin** (untuk import database)

### Langkah 1 — Import Database

1. Buka **phpMyAdmin**, buat database baru dengan nama `warung_nusantara`
   (boleh nama lain, asal disesuaikan lagi pada Langkah 2).
2. Klik tab **Import**, pilih file **`database/warung_nusantara.sql`** dari folder
   proyek ini, lalu klik **Go / Kirim**.
3. Semua tabel (`users`, `makanan`, `pesanan`) beserta akun default dan data contoh
   menu makanan akan otomatis terbentuk.

### Langkah 2 — Konfigurasi `.env`

Buka file `.env` di root proyek, sesuaikan bagian berikut dengan kredensial MySQL kamu
(nilai default XAMPP biasanya sudah cocok):

```env
database.default.hostname = localhost
database.default.database = warung_nusantara
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### Langkah 3 — Jalankan Aplikasi

**Opsi A — Server bawaan CodeIgniter (disarankan untuk development cepat):**

```bash
php spark serve
```

**Opsi B — XAMPP / Laragon:**
Letakkan folder proyek ini di dalam `htdocs` (XAMPP) atau `www` (Laragon), lalu arahkan
**Document Root** web server ke folder `public/`.

### Langkah 4 — Buka di Browser

| Halaman | URL |
|---|---|
| Etalase publik | `http://localhost:8080/` |
| Login | `http://localhost:8080/login` |
| Registrasi | `http://localhost:8080/register` |
| Manajemen User (admin) | `http://localhost:8080/user` |

> Ganti `localhost:8080` sesuai port/URL server yang kamu gunakan.

<br>

### 🔁 Alternatif: Migration & Seeder CodeIgniter (tanpa import file SQL manual)

Jika lebih suka membuat tabel langsung lewat CodeIgniter:

```bash
# 1. Buat database kosong di phpMyAdmin, sesuaikan .env seperti Langkah 2 di atas

# 2. Jalankan migration untuk membuat semua tabel
php spark migrate

# 3. Isi data awal (akun default & contoh menu)
php spark db:seed UserSeeder
php spark db:seed MakananSeeder
```

> Perintah `migrate` bersifat **idempotent** — aman dijalankan berkali-kali tanpa
> menghapus data yang sudah ada.

<br>

## 🔑 Akun Default untuk Uji Coba

Akun berikut otomatis tersedia setelah import database / menjalankan `UserSeeder`:

| Role | Username | Password | Email |
|---|---|---|---|
| 🛡️ Admin | `admin` | `12345` | `admin@warungnusantara.test` |
| 🧑‍🍳 Penjual | `penjual1` | `penjual123` | — |
| 🛍️ Pembeli | `pembeli1` | `pembeli123` | — |

> Login bisa menggunakan **username atau email**. **Segera ganti password default** ini
> setelah aplikasi di-deploy ke lingkungan production.

<br>

## 🗺️ Daftar Route / URL Penting

| Method | Route | Controller · Method | Akses |
|---|---|---|---|
| GET | `/` | `Home::index` | Publik |
| GET / POST | `/login` | `AuthController::login` / `prosesLogin` | Publik |
| GET / POST | `/register` | `AuthController::register` / `prosesRegister` | Publik |
| GET | `/logout` | `AuthController::logout` | Login |
| GET | `/makanan` | `MakananController::index` | Admin, Penjual |
| GET | `/makanan/create` | `MakananController::create` | Admin, Penjual |
| POST | `/makanan/store` | `MakananController::store` | Admin, Penjual |
| GET | `/makanan/edit/{id}` | `MakananController::edit` | Admin, Penjual |
| POST | `/makanan/update/{id}` | `MakananController::update` | Admin, Penjual |
| GET | `/makanan/delete/{id}` | `MakananController::delete` | Admin, Penjual |
| POST | `/pesan/{id}` | `PesananController::pesan` | Pembeli |
| GET | `/pesanan-saya` | `PesananController::saya` | Pembeli |
| GET | `/pesanan-masuk` | `PesananController::masuk` | Admin, Penjual |
| POST | `/pesanan-masuk/status/{id}` | `PesananController::updateStatus` | Admin, Penjual |
| GET | `/user` | `UserController::index` | Admin |
| GET | `/user/create` | `UserController::create` | Admin |
| POST | `/user/store` | `UserController::store` | Admin |
| GET | `/user/edit/{id}` | `UserController::edit` | Admin |
| POST | `/user/update/{id}` | `UserController::update` | Admin |
| GET | `/user/delete/{id}` | `UserController::delete` | Admin |

Daftar lengkap dapat dilihat pada `app/Config/Routes.php`.

<br>

## 👤 Manajemen User (Khusus Admin)

1. Login sebagai admin (`admin` / `12345`).
2. Klik menu **Manajemen User** di navbar, atau buka langsung `http://localhost:8080/user`.
3. Fitur yang tersedia:
   - 📋 Melihat semua akun (Admin, Penjual, Pembeli) beserta ringkasan jumlah per role
   - 🔍 Mencari / memfilter user berdasarkan nama, username, email, atau role
   - ➕ Menambah user baru dengan role apa saja lewat tombol **Tambah User**
   - ✏️ Mengedit data user, mengubah role, atau mereset password (kosongkan field
     password di form edit jika tidak ingin menggantinya)
   - 🗑️ Menghapus user — dengan **pengaman otomatis**: admin tidak dapat
     menghapus/menurunkan role akun dirinya sendiri jika itu satu-satunya akun admin
     yang tersisa, sehingga sistem tidak akan pernah kehilangan akses admin.

<br>

## 🔒 Catatan Keamanan

- ⚠️ **Segera ganti password default** (`admin`/`12345`, `penjual1`/`penjual123`,
  `pembeli1`/`pembeli123`) setelah deploy, baik lewat halaman Manajemen User (admin)
  maupun langsung di database.
- 🚫 Jangan expose file `database/warung_nusantara.sql` atau `.env` ke publik/production.
- 🔐 Semua password pengguna disimpan dalam bentuk **hash (bcrypt)**, bukan plain text.
- 🛡️ Setiap halaman dibatasi aksesnya sesuai role melalui filter `auth` dan `role`
  di `app/Filters/`.

<br>

## 🧯 Troubleshooting

| Masalah | Kemungkinan Penyebab & Solusi |
|---|---|
| Halaman blank / error koneksi database | Cek kembali kredensial pada `.env`, pastikan service MySQL sudah berjalan. |
| Error `ext-intl`/`ext-mbstring` tidak ditemukan | Aktifkan ekstensi tersebut di `php.ini`, lalu restart web server. |
| Gambar makanan tidak muncul | Pastikan folder `public/uploads/makanan/` memiliki hak akses tulis (writable). |
| `php spark serve` gagal dijalankan | Pastikan PHP CLI ≥ 8.2 sudah terpasang dan ada di `PATH` sistem. |
| Ingin update dependency lewat Composer | Jalankan `composer install`, pastikan ada koneksi internet ke `packagist.org`/GitHub (folder `system/` sudah termasuk dalam repo, jadi langkah ini opsional). |

<br>

## 📌 Fitur Tambahan (Menambah Menu Makanan Baru)

Login sebagai Admin/Penjual, buka `http://localhost:8080/makanan/create`, isi form
(nama, kategori, harga, stok, deskripsi, upload gambar opsional), lalu klik **Simpan**.
Data akan otomatis muncul di etalase publik.

<br>

## 📝 Catatan Lain

- Folder `system/` sudah berisi core CodeIgniter 4 secara lengkap — **tidak wajib**
  menjalankan `composer install` untuk memulai.
- Jika ingin memperbarui dependency lewat Composer, pastikan tersedia koneksi internet
  (memerlukan akses ke `packagist.org` / GitHub).
- Konfigurasi environment tersimpan di file `.env`
  (`CI_ENVIRONMENT`, `app.baseURL`, `database.default.*`, dll).

---

<div align="center">

**Praktikum Web Programming** · Dibuat oleh **Tim 4** untuk keperluan tugas praktikum.

</div>
