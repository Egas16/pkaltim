# 🎨 Tim Contoh - Website Pariwisata Kaltim

**Contoh Implementasi Mini Web Project**

## 📝 Tentang Project Ini

Ini adalah contoh implementasi mini web pariwisata Kaltim yang bisa dijadikan referensi. Project ini menggunakan:
- PHP Native (tanpa framework)
- MySQL database
- Bootstrap 5 untuk UI
- CRUD lengkap untuk destinasi wisata

## 🎯 Fitur yang Diimplementasikan

### Public Pages
- ✅ Homepage dengan hero section
- ✅ List destinasi wisata
- ✅ Detail destinasi
- ✅ Pencarian & filter

### Admin Panel
- ✅ Login admin
- ✅ Dashboard
- ✅ CRUD destinasi (Create, Read, Update, Delete)
- ✅ Logout

### Database
- ✅ Tabel users (admin)
- ✅ Tabel categories
- ✅ Tabel destinations
- ✅ Relasi antar tabel

## 📦 Cara Install

### 1. Setup Database
```sql
-- Buka phpMyAdmin: http://localhost/phpmyadmin
-- Buat database baru
CREATE DATABASE pkaltim_contoh;

-- Import file SQL
-- Import: database/pkaltim_contoh.sql
```

### 2. Copy ke XAMPP
```bash
# Copy folder ini ke htdocs
cp -r tim-contoh /xampp/htdocs/

# Atau di Windows
xcopy tim-contoh C:\xampp\htdocs\ /E /I
```

### 3. Konfigurasi Database
Edit file `config.php`:
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pkaltim_contoh";
```

### 4. Jalankan
```
http://localhost/tim-contoh/
```

## 🔐 Login Admin
```
Username: admin
Password: admin123
```

## 📁 Struktur Folder

```
tim-contoh/
├── index.php              # Homepage
├── config.php             # Database config
├── login.php              # Admin login
├── logout.php             # Logout
│
├── public/                # Public pages
│   ├── destinations.php   # List semua destinasi
│   └── detail.php         # Detail destinasi
│
├── admin/                 # Admin panel
│   ├── dashboard.php      # Dashboard
│   ├── create.php         # Tambah destinasi
│   ├── edit.php           # Edit destinasi
│   └── delete.php         # Hapus destinasi
│
├── assets/
│   ├── css/
│   │   └── style.css      # Custom CSS
│   └── img/               # Images folder
│
└── database/
    └── pkaltim_contoh.sql # Database dump
```

## 🎨 Kustomisasi untuk Tim Kalian

1. **Ganti Data Destinasi**
   - Edit data di database sesuai subtema tim kalian
   - Contoh: Kuliner → ganti jadi nama makanan Kaltim

2. **Ubah Warna & Desain**
   - Edit `assets/css/style.css`
   - Sesuaikan warna dengan tema tim

3. **Tambah Fitur Bonus**
   - Google Maps API
   - Rating system
   - Image upload
   - Search & filter

4. **Rename Project**
   - Ganti "tim-contoh" jadi "tim-[nomor]-[subtema]"
   - Update config database

## 💡 Tips Pengembangan

### Security
- ✅ Gunakan PDO prepared statements
- ✅ Hash password dengan `password_hash()`
- ✅ Validasi input dengan `htmlspecialchars()`
- ✅ Session untuk autentikasi

### Code Quality
- ✅ Pisahkan logic dan view
- ✅ Gunakan function untuk code yang berulang
- ✅ Tambahkan komentar di bagian penting
- ✅ Indent yang rapi dan konsisten

### UI/UX
- ✅ Responsive di mobile & desktop
- ✅ Gunakan Bootstrap components
- ✅ Feedback untuk setiap action (alert/toast)
- ✅ Loading state untuk proses lama

## 🐛 Troubleshooting

### Error: Connection failed
```php
// Cek config.php, pastikan:
$servername = "localhost";  // ✅
$username = "root";         // ✅
$password = "";             // ✅ (kosong di XAMPP default)
$dbname = "pkaltim_contoh"; // ✅ sesuai nama database
```

### Error: Undefined index
```php
// Selalu cek apakah variable ada
if(isset($_POST['name'])) {
    $name = $_POST['name'];
}
```

### Page blank/error 500
```php
// Aktifkan error reporting di config.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

## 📚 Resource Belajar

- [PHP Manual](https://www.php.net/manual/en/)
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.3/)
- [W3Schools PHP](https://www.w3schools.com/php/)
- [PDO Tutorial](https://www.php.net/manual/en/book.pdo.php)

## ✅ Checklist Development

- [ ] Database design selesai
- [ ] Config database works
- [ ] Homepage bisa diakses
- [ ] List destinasi tampil
- [ ] Login admin berhasil
- [ ] CRUD create works
- [ ] CRUD read works
- [ ] CRUD update works
- [ ] CRUD delete works
- [ ] Responsive di mobile
- [ ] No critical errors
- [ ] Code di-comment
- [ ] README lengkap

## 📞 Butuh Bantuan?

Hubungi PIC sesuai kelompok kalian:
- **Navies** - Tim 1, 3, 6, 9
- **Ghani** - Tim 4, 5, 8, 10
- **Widhi** - Tim 2, 7, 11, 12

---

<div align="center">

**Happy Coding! 🚀**

Silakan modifikasi sesuai kebutuhan tim kalian.  
Yang penting: CRUD works + Responsive + Data Kaltim!

</div>
