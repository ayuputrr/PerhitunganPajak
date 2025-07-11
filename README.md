# 📘 Sistem Informasi Perhitungan Pajak Pegawai Kabupaten Pringsewu  – Modul Pengguna (Pegawai Biasa)


Aplikasi ini dikembangkan menggunakan framework **CodeIgniter 4**, bertujuan untuk menghitung, mengelola, dan menyimpan pajak penghasilan PPh 21 bagi pegawai.

---

## 🔐 1. Modul Autentikasi (Login)

* **Fungsi**: Melindungi sistem agar hanya admin yang bisa mengelola data pegawai dan pajak.
* **Controller**: `Auth.php`
* **Views**: `login.php`
* **Logika**: Autentikasi dilakukan via session. Jika login berhasil, user diarahkan ke dashboard.

---

## 👤 2. Modul Data Pegawai

* **Fungsi**: Menyimpan data pokok pegawai seperti:
  * Nama
  * NIP
  * Golongan
  * Status PTKP (TK/0, K/1, K/2, dll)
* **Controller**: `Pegawai.php`
* **Model**: `PegawaiModel.php`
* **Views**:
  * `pegawai/index.php`
  * `pegawai/create.php`
  * `pegawai/edit.php`
* **Fitur**:
  * CRUD Data Pegawai
  * Validasi input
  * Pencarian pegawai

---

## 💰 3. Modul Komponen Gaji & Pajak

* **Fungsi**: Menghitung total bruto dan pajak berdasarkan komponen:
  * Gaji Pokok
  * Tunjangan Istri/Anak
  * Tunjangan Jabatan
  * Pembulatan
  * TPP, THR, Gaji 13, Iuran Pensiun
* **Controller**: `Pajak.php`
* **Model**: `PajakModel.php`
* **View**:
  * `pajak/form_hitung.php`
  * `pajak/detail.php`
* **Proses**:
  1. Hitung **Gaji Bruto**
  2. Tentukan **Golongan TER** (A, B, C)
  3. Gunakan **TER %** sesuai golongan dan status
  4. Hitung **Pajak Bulanan** = Gaji Bruto x TER
  5. Hitung **Pajak Tahunan** = Pajak Bulanan x 12

---

## 📄 4. Modul Laporan & Export

* **Fungsi**:
  * Menampilkan rekap pajak per pegawai
  * Export PDF dan Excel
* **View**:
  * `laporan/laporan_pdf.php`
  * `laporan/laporan_excel.php`
* **Helper**:
  * `pdf_helper.php`: Membantu export PDF menggunakan Dompdf
* **Export**:
  * Per pegawai
  * Semua pegawai dalam satu file

---

## 📦 5. Struktur Database

Tabel minimal:

* `pegawai`: Menyimpan data pribadi dan status PTKP
* `pajak`: Menyimpan semua komponen perhitungan pajak
* Relasi: 1 Pegawai → Banyak Perhitungan Pajak

---

## 🧠 6. Logika Perhitungan Pajak (Contoh)

```php
$bruto = $gaji_pokok + $tunj_jabatan + $tunj_lainnya;
$golongan = getGolonganTER($status, $bruto);
$tarif_TER = getTER($golongan, $status);
$pajak_bulanan = $bruto * $tarif_TER / 100;
$pajak_tahunan = $pajak_bulanan * 12;```
---

# 👤 Modul Pengguna (Pegawai Biasa) – Login Berdasarkan Status Database Admin

### ✅ Alur Autentikasi Pengguna

1. **Daftar Akun (Registrasi)**:
   - Hanya bisa mendaftar **jika NIP sudah terdaftar di database admin (pegawai).**
   - Saat mendaftar, pengguna akan diminta:
     - NIP
     - Nama lengkap
     - Password
   - Sistem akan **memvalidasi** apakah NIP tersebut cocok dengan tabel `pegawai`

2. **Login Pengguna**:
   - Menggunakan NIP dan Password yang telah dibuat
   - Jika login berhasil, session pengguna akan disimpan

3. **Keamanan**:
   - Validasi NIP → mencegah akun palsu
   - Pengguna hanya bisa melihat dan mengelola data miliknya sendiri

---

## 🔐 Fitur Login & Registrasi

| Fitur                          | Penjelasan                               |
|-------------------------------|------------------------------------------|
| `login.php`                   | Halaman login pengguna                   |
| `register.php` *(opsional)*   | Formulir daftar akun baru                |
| Validasi NIP Terdaftar        | Mencegah pegawai palsu membuat akun      |
| Session Management            | Menggunakan `session()` dari CodeIgniter |

---

## 🔄 Revisi Alur Interaksi Pengguna (dengan Login)

```
flowchart TD
    A[Pengguna Akses Halaman Login] --> B[Input NIP & Password]
    B --> C{Login Berhasil?}
    C -->|Ya| D[Masuk ke Dashboard Pajak]
    C -->|Tidak| E[Tampilkan Pesan Error]

    D --> F[Filter Tahun & Bulan Pajak]
    F --> G[Tampilkan Data Pajak]
    G --> H{Download?}
    H -->|Ya| I[Unduh PDF + Simpan ke Arsip]
    H -->|Tidak| J[Kembali ke Dashboard]
    D --> K[Lihat Notifikasi Pajak Masuk]
```

---

## 🗃️ Skema Validasi Pendaftaran

Contoh logika validasi saat mendaftar:
\`\`\`php
$pegawai = $this->PegawaiModel->where('nip', \$inputNip)->first();
if (\$pegawai) {
    // lanjut daftar
} else {
    // tampilkan error: "NIP tidak ditemukan"
}
\`\`\`

---

## ✅ Kelebihan Sistem dengan Login Pengguna

| Fitur Keamanan/Fungsi         | Penjelasan                                  |
|------------------------------|---------------------------------------------|
| 🔒 Autentikasi Pengguna       | Melindungi akses laporan pribadi            |
| 🎯 Validasi terhadap database | Mencegah pegawai palsu membuat akun         |
| 🧾 Arsip Personal             | Laporan tersimpan khusus untuk pengguna itu |
| 🔁 Bisa Ganti Password        | Fitur keamanan tambahan                     |

---

## 🔧 Halaman Terkait Modul Login

| Nama File View                | Fungsi                                       |
|------------------------------|----------------------------------------------|
| `login.php`                  | Form login pengguna                          |
| `register.php` *(opsional)* | Form daftar akun baru (validasi NIP)         |
| `edit_password.php`          | Ganti password                               |
| `profil.php`                 | Lihat profil pribadi                         |
| `edit_profil.php`            | Edit informasi pengguna                      |

---

## 📚 Rangkuman Arsitektur Modul Pengguna

- **Tabel `pegawai`**: Referensi utama validasi pendaftaran
- **Tabel `users` / `pengguna`**: Menyimpan akun pengguna yang berhasil registrasi
- **Controller `Pengguna.php`**:
  - Login, logout
  - Dashboard, filter laporan, notifikasi
  - Export PDF bulanan & tahunan
- **Middleware / Filter**: Melindungi semua rute agar hanya pengguna login yang bisa mengaksesnya

---

## 🔜 Langkah Lanjut Pengembangan

- Tampilkan file controller `Pengguna.php` secara lengkap
- Buat form `register.php` dengan validasi NIP otomatis
- Tambahkan fitur ubah email atau reset password
- Tambahkan riwayat aktivitas pengguna
EOF




## Teknologi Yang Digunakan
- PHP
- Code Igneter 4
- Bootstrap 5
- MY SQL




