# 📘 Sistem Informasi Perhitungan Pajak Pegawai Kabupaten Pringsewu  – Modul Pengguna (Pegawai Biasa)

## 👤 Modul Pengguna (Pegawai Biasa) – Login Berdasarkan Status Database Admin

### ✅ Alur Autentikasi Pengguna

1. **Daftar Akun (Registrasi)**:
   - Hanya bisa mendaftar **jika NIP sudah terdaftar di database admin (pegawai).**
   - Saat mendaftar, pengguna akan diminta:
     - NIP
     - Nama lengkap
     - Email (opsional)
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

\`\`\`mermaid
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
\`\`\`

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




