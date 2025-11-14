# TODO: Implementasi Fungsi Toko untuk Member

## 1. Update MemberController::tokoView()
- Ambil toko milik user yang sedang login (jika ada).
- Hitung stats: total produk, dilihat (belum ada field), pesanan (belum ada), rating (belum ada).
- Pass data toko dan stats ke view.

## 2. Tambah method storeToko() di MemberController
- Handle POST request untuk buat toko baru.
- Validasi input: nama_toko, deskripsi, kontak_toko, alamat (required), gambar (optional).
- Cek apakah user sudah punya toko; jika ya, redirect dengan error.
- Simpan toko ke DB, handle upload gambar (simpan di storage/app/public/toko).
- Redirect ke /member/toko dengan success message.

## 3. Tambah method updateToko() di MemberController
- Handle PATCH request untuk edit toko.
- Validasi input serupa storeToko().
- Update data toko, handle upload gambar baru jika ada.
- Redirect ke /member/toko dengan success message.

## 4. Tambah routes di web.php
- POST /member/toko untuk storeToko().
- PATCH /member/toko untuk updateToko().

## 5. Update view resources/views/member/toko/index.blade.php
- Jika user punya toko: Tampilkan info toko, stats riil, tombol edit.
- Jika tidak punya toko: Tampilkan form buat toko (modal atau inline).
- Tambah form edit toko (modal).
- Handle file upload untuk gambar.

## 6. Setup storage link untuk gambar toko
- Jalankan php artisan storage:link jika belum.

## 7. Testing
- Test buat toko baru.
- Test edit toko.
- Test validasi satu toko per user.
- Test upload gambar.
