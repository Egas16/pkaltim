<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pariwisata Kalimantan Timur</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-mountain"></i> Wisata Kaltim
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/read.php">Destinasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6 text-white hero-content">
                    <h1 class="display-3 fw-bold mb-4">
                        Jelajahi Keindahan<br>Kalimantan Timur
                    </h1>
                    <p class="lead mb-4">
                        Temukan destinasi wisata menakjubkan, kuliner khas, dan pengalaman tak terlupakan di Bumi Etam.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="pages/read.php" class="btn btn-warning btn-lg">
                            <i class="fas fa-compass"></i> Mulai Jelajah
                        </a>
                        <a href="#about" class="btn btn-outline-light btn-lg">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Kategori Wisata</h2>
                <p class="text-muted">Pilih destinasi sesuai minat Anda</p>
            </div>
            
            <div class="row g-4">
                <?php
                require_once 'config.php';
                
                // Fetch categories
                $stmt = $conn->query("SELECT * FROM categories ORDER BY name");
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($categories as $category):
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card category-card h-100 text-center">
                        <div class="card-body">
                            <div class="category-icon mb-3">
                                <i class="fas <?= htmlspecialchars($category['icon']) ?> fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title"><?= htmlspecialchars($category['name']) ?></h5>
                            <p class="card-text text-muted">
                                <?= htmlspecialchars($category['description']) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Destinasi Populer</h2>
                <p class="text-muted">Rekomendasi destinasi terbaik di Kalimantan Timur</p>
            </div>
            
            <div class="row g-4">
                <?php
                // Fetch top destinations
                $stmt = $conn->query("SELECT d.*, c.name as category_name 
                                      FROM destinations d 
                                      LEFT JOIN categories c ON d.category_id = c.id 
                                      WHERE d.status = 'active' 
                                      ORDER BY d.rating DESC 
                                      LIMIT 6");
                $destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach($destinations as $dest):
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card destination-card h-100">
                        <div class="card-img-wrapper">
                            <img src="assets/img/<?= htmlspecialchars($dest['image']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($dest['name']) ?>"
                                 onerror="this.src='https://via.placeholder.com/400x300?text=<?= urlencode($dest['name']) ?>'">
                            <span class="badge bg-primary position-absolute top-0 start-0 m-3">
                                <?= htmlspecialchars($dest['category_name']) ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($dest['name']) ?></h5>
                            <p class="card-text text-muted small">
                                <i class="fas fa-map-marker-alt"></i> 
                                <?= htmlspecialchars($dest['location']) ?>
                            </p>
                            <p class="card-text">
                                <?= substr(htmlspecialchars($dest['description']), 0, 100) ?>...
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-warning">
                                        <?php for($i = 0; $i < 5; $i++): ?>
                                            <i class="fas fa-star<?= $i >= $dest['rating'] ? '-half-alt' : '' ?>"></i>
                                        <?php endfor; ?>
                                    </span>
                                    <small class="text-muted">(<?= $dest['rating'] ?>)</small>
                                </div>
                                <strong class="text-primary">
                                    Rp <?= number_format($dest['price'], 0, ',', '.') ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-5">
                <a href="pages/read.php" class="btn btn-primary btn-lg">
                    Lihat Semua Destinasi <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-5 fw-bold mb-4">Tentang Kalimantan Timur</h2>
                    <p class="lead mb-3">
                        Kalimantan Timur adalah provinsi di Indonesia yang kaya akan keindahan alam, 
                        budaya yang beragam, dan kuliner yang menggugah selera.
                    </p>
                    <p>
                        Dari pantai eksotis Derawan, hutan tropis yang lebat, hingga sungai Mahakam 
                        yang legendaris - Kaltim menawarkan pengalaman wisata yang tak terlupakan.
                    </p>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="stat-box text-center p-3">
                                <h3 class="text-primary fw-bold">10+</h3>
                                <p class="mb-0">Destinasi</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box text-center p-3">
                                <h3 class="text-primary fw-bold">4.5</h3>
                                <p class="mb-0">Rating</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/600x400?text=Kalimantan+Timur" 
                         class="img-fluid rounded shadow" 
                         alt="Kalimantan Timur">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-mountain"></i> Wisata Kaltim</h5>
                    <p class="text-muted">
                        Platform informasi pariwisata Kalimantan Timur
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>Kontak</h5>
                    <p class="text-muted">
                        <i class="fas fa-envelope"></i> info@wisatakaltim.com<br>
                        <i class="fas fa-phone"></i> +62 812-3456-7890
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="text-center text-muted">
                <small>&copy; 2026 Mini Project - SMK Negeri 7 Samarinda. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>
</html>
