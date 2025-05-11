# TP9 Aplikasi Manajemen Data Mahasiswa

## Saya Hasbi Haqqul Fikri dengan NIM 2309245 mengerjakan soal TP 8 dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Desain Program

Aplikasi manajemen data mahasiswa ini dibangun menggunakan arsitektur **Model-View-Presenter (MVP)**, yang merupakan pola desain untuk memisahkan komponen aplikasi menjadi tiga bagian utama:

1. **Model**: Bertanggung jawab untuk penanganan data dan interaksi dengan database.
2. **View**: Bertanggung jawab untuk menampilkan antarmuka pengguna dan menerima input.
3. **Presenter**: Bertindak sebagai perantara antara Model dan View, mengatur logika bisnis aplikasi.

### Struktur Folder

```
mvp_php/
│
├── model/
│   ├── DB.class.php                 # Kelas untuk koneksi database
│   ├── Mahasiswa.class.php          # Kelas entitas mahasiswa
│   ├── TabelMahasiswa.class.php     # Kelas operasi database mahasiswa
│   └── Template.class.php           # Kelas untuk pengolahan template HTML
│
├── view/
│   ├── KontrakView.php              # Interface untuk View
│   └── TampilMahasiswa.php          # Implementasi tampilan mahasiswa
│
├── presenter/
│   ├── KontrakPresenter.php         # Interface untuk Presenter
│   └── ProsesMahasiswa.php          # Implementasi logika presenter
│
├── templates/
│   └── skin.html                    # Template HTML utama
│
├── index.php                        # File utama sebagai kontroler
└── mvp_php.sql                      # File SQL untuk pembuatan database
```

## Penjelasan Alur Program

### 1. Inisialisasi Program

Alur program dimulai dari file `index.php` yang berfungsi sebagai kontroler utama:

```php
include("view/TampilMahasiswa.php");
$tp = new TampilMahasiswa();

// Menangani aksi CRUD berdasarkan parameter URL
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add': // Tampilkan form tambah
    case 'add_process': // Proses penambahan data
    case 'edit': // Tampilkan form edit
    case 'edit_process': // Proses perubahan data
    case 'delete': // Proses penghapusan data
    default: // Tampilkan semua data
}
```

### 2. Alur CRUD (Create, Read, Update, Delete)

#### a. Menampilkan Data (Read)
1. User mengakses halaman utama (`index.php` tanpa parameter)
2. `index.php` memanggil method `tampil()` pada objek `TampilMahasiswa`
3. `TampilMahasiswa` meminta data ke `ProsesMahasiswa` melalui `prosesDataMahasiswa()`
4. `ProsesMahasiswa` mengambil data dari database melalui `TabelMahasiswa`
5. Data ditampilkan dalam bentuk tabel menggunakan template `skin.html`

#### b. Tambah Data (Create)
1. User mengklik tombol "Tambah Data"
2. `index.php` memanggil method `tampilForm()` pada objek `TampilMahasiswa`
3. Form kosong ditampilkan untuk diisi
4. User mengisi form dan mengirim data
5. `index.php` memanggil method `tambahData()` pada objek `TampilMahasiswa`
6. Data dikirim ke `ProsesMahasiswa` melalui `prosesTambahData()`
7. Data disimpan ke database melalui `TabelMahasiswa`
8. User dialihkan kembali ke halaman utama

#### c. Edit Data (Update)
1. User mengklik tombol "Edit" pada baris data yang ingin diubah
2. `index.php` memanggil method `tampilForm($id)` pada objek `TampilMahasiswa`
3. Data yang ada diambil dari database dan ditampilkan dalam form
4. User mengubah data dan mengirim form
5. `index.php` memanggil method `ubahData($id)` pada objek `TampilMahasiswa`
6. Data dikirim ke `ProsesMahasiswa` melalui `prosesUbahData()`
7. Data diperbarui di database melalui `TabelMahasiswa`
8. User dialihkan kembali ke halaman utama

#### d. Hapus Data (Delete)
1. User mengklik tombol "Delete" pada baris data yang ingin dihapus
2. Konfirmasi penghapusan diminta melalui JavaScript
3. Jika dikonfirmasi, `index.php` memanggil method `hapusData($id)` pada objek `TampilMahasiswa`
4. Permintaan diteruskan ke `ProsesMahasiswa` melalui `prosesHapusData()`
5. Data dihapus dari database melalui `TabelMahasiswa`
6. User dialihkan kembali ke halaman utama

## Detail Implementasi

### 1. Model

#### a. Kelas DB (DB.class.php)
- Menangani koneksi database
- Menyediakan method untuk eksekusi query

#### b. Kelas Mahasiswa (Mahasiswa.class.php)
- Menyimpan atribut mahasiswa: id, nim, nama, tempat lahir, tanggal lahir, gender, email, telepon
- Menyediakan getter dan setter untuk setiap atribut

#### c. Kelas TabelMahasiswa (TabelMahasiswa.class.php)
- Extends dari kelas DB
- Menyediakan operasi CRUD untuk data mahasiswa:
  - `getMahasiswa()`: Mengambil semua data mahasiswa
  - `getMahasiswaById($id)`: Mengambil data mahasiswa berdasarkan ID
  - `addMahasiswa(...)`: Menambah data mahasiswa baru
  - `updateMahasiswa(...)`: Memperbarui data mahasiswa yang ada
  - `deleteMahasiswa($id)`: Menghapus data mahasiswa berdasarkan ID

### 2. View

#### a. Interface KontrakView (KontrakView.php)
- Mendefinisikan kontrak untuk kelas View
- Method: `tampil()`, `tampilForm()`, `tambahData()`, `ubahData()`, `hapusData()`

#### b. Kelas TampilMahasiswa (TampilMahasiswa.php)
- Implementasi dari KontrakView
- Berinteraksi dengan Presenter untuk mendapatkan dan mengirim data
- Menampilkan data dalam bentuk tabel
- Menyediakan form untuk tambah dan edit data

### 3. Presenter

#### a. Interface KontrakPresenter (KontrakPresenter.php)
- Mendefinisikan kontrak untuk kelas Presenter
- Method untuk mengambil data dan operasi CRUD

#### b. Kelas ProsesMahasiswa (ProsesMahasiswa.php)
- Implementasi dari KontrakPresenter
- Menghubungkan View dengan Model
- Mengolah data dan logika bisnis

## Teknologi yang Digunakan

- PHP 7.x
- MySQL Database
- HTML & CSS
- Bootstrap 4 (UI Framework)
- JavaScript (validasi form)

## Cara Penggunaan

1. Pastikan XAMPP/WAMP sudah terinstal dan berjalan
2. Import database dari file `mvp_php.sql`
3. Akses aplikasi melalui browser: http://localhost/DPBO/TP9/mvp_php/

---

Aplikasi ini dikembangkan sebagai tugas praktikum mata kuliah Desain Pemrograman Berorientasi Objek (DPBO).