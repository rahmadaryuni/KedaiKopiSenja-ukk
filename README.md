# Kedai Kopi Senja

Aplikasi pengelolaan kafe Kedai Kopi Senja yang dibuat untuk Uji Kompetensi Keahlian (UKK) Rekayasa Perangkat Lunak Tahun Pelajaran 2026/2027, Soal 3 Varian C (Kafe).

Aplikasi terdiri dari web desktop yang digunakan oleh Kasir dan Manajer serta aplikasi Android untuk Pelanggan.

## 1. Ringkasan Aplikasi

Kedai Kopi Senja merupakan aplikasi yang dibuat untuk membantu pengelolaan operasional kafe, mulai dari pengelolaan menu, bahan, resep, stok, pesanan, hingga laporan.

Sistem memiliki tiga peran pengguna:

- **Manajer:** Mengelola menu, kategori, bahan, resep, stok, dan laporan.
- **Kasir:** Membuat pesanan, mengelola status pesanan, melihat menu, serta mengelola pelanggan.
- **Pelanggan:** Melihat menu, melakukan pemesanan, serta memantau status dan struk pesanan melalui aplikasi Android.

## 2. Teknologi yang Digunakan

### Web dan Backend
- PHP 8.3
- Laravel 13
- SQLite
- Blade
- Bootstrap 5
- Vite

### Aplikasi Mobile
- React
- Ionic
- TypeScript
- Capacitor
- REST API

### Environment Pengembangan
- Kali Linux
- Visual Studio Code
- Composer
- Node.js dan npm
- Android Studio

## 3. Fitur Aplikasi

### Manajer
- Dashboard
- Pengelolaan kategori menu
- Pengelolaan menu
- Pengelolaan bahan
- Pengelolaan resep
- Import data melalui CSV
- Penambahan stok bahan
- Pemantauan stok dan bahan minimum
- Laporan penjualan dan pengelolaan kafe

### Kasir
- Melihat daftar menu
- Membuat pesanan
- Mengelola pesanan
- Mengubah status pesanan
- Membatalkan pesanan sesuai ketentuan
- Melihat struk pesanan
- Mengelola pelanggan
- Reset password pelanggan

### Pelanggan
- Registrasi akun
- Login dan logout
- Mengubah password
- Melihat menu
- Melakukan pemesanan
- Memilih nomor meja dan metode pembayaran
- Melihat riwayat pesanan
- Memantau status pesanan
- Melihat struk pesanan

## 4. Cara Menjalankan Aplikasi Web

### Persyaratan

Pastikan perangkat telah memiliki:

- PHP 8.3
- Composer
- Node.js dan npm

### Langkah Instalasi

Clone repository:

```bash
git clone <url-repository>
cd kedai-kopi-senja
```

Install dependency PHP:

```bash
composer install
```

Install dependency Node.js:

```bash
npm install
```

Salin file konfigurasi:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Buat database SQLite:

```bash
touch database/database.sqlite
```

Sesuaikan konfigurasi database pada file `.env` agar menggunakan SQLite.

Jalankan migration:

```bash
php artisan migrate
```

Jalankan seeder akun:

```bash
php artisan db:seed --class=Userseeder
```

Build asset:

```bash
npm run build
```

Jalankan server:

```bash
php artisan serve --host=0.0.0.0 --port=8001
```

Aplikasi dapat diakses melalui browser:

```text
http://127.0.0.1:8001
```

## 5. Akun Pengujian

| Role | Username | Password |
|---|---|---|
| Manajer | manajer | manajer123 |
| Kasir | kasir | kasir123 |

Pelanggan dapat membuat akun melalui aplikasi Android.

## 6. Import Data Awal

Data bahan, menu, dan resep dapat dimasukkan melalui fitur Import Data menggunakan file CSV.

Urutan import yang disarankan:

1. Data bahan
2. Data menu
3. Data resep

Data CSV yang digunakan mengikuti data yang disediakan dalam soal UKK.

## 7. Aplikasi Android

Source code aplikasi Android berada pada folder `mobile`.

Langkah persiapan:

```bash
cd mobile
npm install
npm run build
npx cap sync android
```

Setelah proses sinkronisasi selesai, project Android dapat dibuka melalui Android Studio untuk proses build APK.

## 8. Konfigurasi API Mobile

Konfigurasi alamat API terdapat pada:

```text
mobile/src/services/api.ts
```

Alamat API yang digunakan saat ini:

```text
http://192.168.0.108:8001/api
```

Alamat tersebut menyesuaikan IP perangkat yang menjalankan server. Agar aplikasi Android dapat terhubung, perangkat HP dan komputer server perlu berada pada jaringan yang dapat saling terhubung, serta server harus berjalan.

Jika alamat IP berubah, konfigurasi API perlu disesuaikan dan aplikasi dibangun ulang.

## 9. Integrasi Supplier

Aplikasi menyediakan konfigurasi untuk integrasi layanan supplier melalui environment variable.

Konfigurasi yang digunakan:

```env
LAYANAN_URL=
LAYANAN_API_KEY=
```

Nilai konfigurasi perlu disesuaikan dengan layanan API supplier yang digunakan.

## 10. Fitur Opsional

Fitur opsional pada soal UKK belum dikerjakan dalam aplikasi ini.

## 11. Self-Check / Lembar Pengujian

### Butir 1 — Pengelolaan Bahan, Menu, dan Resep
Manajer dapat mengelola data bahan, menu, kategori, serta resep. Data bahan memiliki satuan dasar, menu dapat diaktifkan atau dinonaktifkan, dan resep dapat terdiri dari beberapa bahan beserta takarannya.

**Klaim: Ya**

### Butir 2 — Stok Bahan dan Stok Minimum
Sistem menyediakan pencatatan stok masuk serta pengaturan batas stok minimum untuk setiap bahan. Informasi bahan yang stoknya menipis dapat dipantau melalui daftar stok minimum.

**Klaim: Ya**

### Butir 3 — Pemesanan Menu
Kasir dapat membuat pesanan dengan beberapa item menu dalam satu transaksi. Pengurangan stok dihitung berdasarkan resep, jumlah porsi, serta kebutuhan bahan dari setiap menu. Menu yang tidak aktif atau tidak memiliki resep tidak dapat diproses dalam pesanan.

**Klaim: Ya**

### Butir 4 — Validasi Ketersediaan Bahan
Sistem memeriksa ketersediaan bahan sebelum pesanan diproses. Kebutuhan bahan dihitung berdasarkan keseluruhan menu dalam pesanan, termasuk apabila beberapa menu menggunakan bahan yang sama. Pesanan ditolak apabila jumlah bahan tidak mencukupi.

**Klaim: Ya**

### Butir 5 — Status Menu Sold Out
Ketersediaan menu mengikuti jumlah stok bahan yang dibutuhkan untuk membuat satu porsi. Menu akan ditandai habis apabila bahan yang diperlukan tidak mencukupi.

**Klaim: Ya**

### Butir 6 — Status Pesanan dan Pembatalan
Pesanan memiliki alur status New, Processing, dan Complete. Perubahan status mengikuti urutan yang ditentukan. Pesanan hanya dapat dibatalkan saat berstatus New oleh Kasir, dan stok bahan dikembalikan sesuai jumlah bahan yang digunakan dalam pesanan.

**Klaim: Ya**

### Butir 7 — Struk, Service, dan Tax
Struk menampilkan subtotal pesanan, service sebesar 5%, pajak sebesar 10% dari subtotal ditambah service, serta total pembayaran. Data transaksi menyimpan perhitungan harga pada saat pesanan dibuat sehingga perubahan harga menu tidak mengubah struk transaksi sebelumnya.

**Klaim: Ya**

### Butir 8 — HPP dan Margin
Sistem menghitung HPP menu berdasarkan bahan dan takaran yang digunakan dalam resep. Informasi HPP dan margin digunakan untuk mengetahui biaya pembuatan serta selisih terhadap harga jual menu.

**Klaim: Ya**

### Butir 9 — Laporan dan Hak Akses
Sistem menyediakan laporan penjualan, informasi bahan menipis, dan margin menu. Hak akses dibedakan berdasarkan peran Manajer dan Kasir sesuai fungsi masing-masing.

**Klaim: Ya**

### Butir 10 — Import Data CSV
Import data awal dilakukan melalui file CSV. Proses import mendukung penyesuaian satuan bahan, pencocokan nama bahan pada resep, penanganan bahan yang tidak dikenal, serta pengaturan stok minimum awal.

**Klaim: Ya**

### Butir 11 — Integrasi Supplier
Sistem menyediakan integrasi supplier menggunakan konfigurasi API key. Apabila layanan supplier tidak dapat diakses, sistem dapat menggunakan informasi harga terakhir yang tersedia sesuai mekanisme fallback.

**Klaim: Ya**

### Butir 12 — Akun Pelanggan pada Android
Aplikasi Android menyediakan fitur registrasi pelanggan, login, perubahan password, logout, serta reset password pelanggan melalui Kasir. Pelanggan yang password-nya direset perlu melakukan perubahan password pada login berikutnya.

**Klaim: Tidak**

### Butir 13 — Pemesanan Pelanggan melalui Android
Pelanggan dapat melakukan pemesanan melalui aplikasi Android dengan memilih menu, jumlah pesanan, dan nomor meja. Aturan pemesanan serta ketersediaan stok mengikuti ketentuan yang berlaku pada sistem Kasir, termasuk pembatasan pesanan berstatus New.

**Klaim: Tidak**

### Butir 14 — Status dan Struk Pesanan Pelanggan
Aplikasi Android ditujukan agar pelanggan dapat melihat status dan struk pesanannya sendiri. Data pesanan pelanggan dibatasi berdasarkan akun yang digunakan.

**Klaim: Tidak**

### Fitur Opsional

| No. | Fitur | Klaim |
|---|---|:---:|
| O1 | Ukuran Reguler dan Large untuk kategori Minuman | Tidak |
| O2 | Promo Happy Hour | Tidak |
| O3 | Penyesuaian stok bahan rusak atau opname | Tidak |
| O4 | Laporan jam ramai | Tidak |
| O5 | Reset password melalui email menggunakan server email tiruan | Tidak |

## 12. Catatan dan Batasan

- Beberapa fungsi masih memerlukan pengujian lebih lanjut.
- Pada pengujian sebelumnya, menu yang ditambahkan belum muncul pada bagian Kasir. Perbaikan telah dilakukan dan perlu diuji kembali.
- Menu nonaktif sebelumnya masih dapat dipesan. Validasi telah diperbaiki dan perlu diuji kembali.
- Aplikasi Android belum berhasil terhubung ke server dan menampilkan pesan `Failed to fetch`. Penyebabnya belum dipastikan, kemungkinan berkaitan dengan konfigurasi alamat API atau konektivitas perangkat ke server.
- Fitur opsional belum dikerjakan.
- Fitur aplikasi Android masih memerlukan pengujian lanjutan.

## 13. Referensi dan Bantuan


- Visual Studio Code: digunakan untuk menulis dan mengelola kode program.
- Terminal Linux: digunakan untuk menjalankan perintah Laravel, database, build aplikasi, dan Git.
- Android Studio: digunakan untuk pengembangan dan pengujian aplikasi Android.
- ChatGPT: digunakan sebagai alat bantu memahami error, mencari solusi debugging, membantu penyusunan kode, dan dokumentasi. Hasil bantuan disesuaikan kembali dengan kebutuhan dan struktur project.
