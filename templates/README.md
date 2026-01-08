# 🎨 Template Mini Web Pariwisata Kaltim

Template dasar untuk memulai development Mini Web Project. Tim bisa copy template ini dan custom sesuai subtema masing-masing.

## 📁 File Structure

```
project/
├── index.php              # Landing page
├── login.php              # Admin login
├── logout.php             # Logout handler
├── dashboard.php          # Admin dashboard
├── config.php             # Database configuration
│
├── pages/
│   ├── create.php         # Create new record
│   ├── read.php           # View all records
│   ├── update.php         # Edit record
│   └── delete.php         # Delete record
│
├── assets/
│   ├── css/
│   │   └── style.css      # Custom CSS
│   ├── js/
│   │   └── script.js      # Custom JavaScript
│   └── img/
│       └── uploads/       # User uploads
│
├── database/
│   └── pkaltim.sql        # Database dump
│
└── README.md              # Project documentation
```

## 🚀 Quick Start

### 1. Setup XAMPP
```bash
# Download XAMPP dari https://www.apachefriends.org/
# Install dan start Apache + MySQL
```

### 2. Copy Template
```bash
# Copy folder template ke htdocs
cp -r templates/ C:/xampp/htdocs/pkaltim-tim-[X]/
```

### 3. Create Database
```sql
-- Buka phpMyAdmin: http://localhost/phpmyadmin
-- Create database baru
CREATE DATABASE pkaltim_tim1;

-- Import file database/pkaltim.sql
```

### 4. Configure
Edit `config.php`:
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pkaltim_tim1";  // Ganti sesuai tim
```

### 5. Test Local
```
http://localhost/pkaltim-tim-[X]/
```

## 📝 Customization Guide

### Theme Colors
Edit `assets/css/style.css`:
```css
:root {
  --primary-color: #007bff;    /* Blue */
  --secondary-color: #6c757d;  /* Gray */
  --success-color: #28a745;    /* Green */
  --danger-color: #dc3545;     /* Red */
}
```

### Database Tables
Minimal 3 tabel:
- `users` - Admin accounts
- `destinations` - Main content (wisata/kuliner/event)
- `categories` - Kategori/tags

### Bootstrap Components
Gunakan Bootstrap 5 untuk:
- Navbar responsive
- Cards untuk display data
- Forms dengan validation
- Modals untuk confirm delete
- Alerts untuk notifications

## 🗄️ Database Schema

Lihat [db-sample.sql](db-sample.sql) untuk struktur lengkap.

## 🔒 Security

- Use PDO prepared statements (no SQL injection)
- Hash passwords with `password_hash()` dan `password_verify()`
- Validate & sanitize all inputs
- Use `htmlspecialchars()` untuk output
- Session management untuk login

## 📦 Ready to Deploy?

1. Test semua fitur di local
2. Export database: phpMyAdmin → Export → Go
3. Upload files via FTP ke 000webhost
4. Import database di hosting
5. Edit config.php sesuai hosting credentials

## 💡 Need Help?

Contact PIC:
- Ghani (Tim 5-8)
- Widhi (Tim 1-4)
- Navies (Tim 9-12)
