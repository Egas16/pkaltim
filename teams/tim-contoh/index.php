<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Kaltim - Jelajahi Keindahan Kalimantan Timur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
                        <a class="nav-link" href="public/destinations.php">Destinasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-sign-in-alt"></i> Admin Login
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
            <div class="row align-items-center" style="min-height: 70vh;">
                <div class="col-lg-6 text-white position-relative" style="z-index: 2;">
                    <h1 class="display-3 fw-bold mb-4">
                        Jelajahi Keindahan<br>Kalimantan Timur
                    </h1>
                    <p class="lead mb-4">
                        Temukan destinasi wisata menakjubkan di Bumi Etam. Dari pantai eksotis Derawan hingga hutan tropis yang memukau.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="public/destinations.php" class="btn btn-warning btn-lg">
                            <i class="fas fa-compass"></i> Mulai Jelajah
                        </a>
                        <a href="#featured" class="btn btn-outline-light btn-lg">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <?php
                require_once 'config.php';
                
                // Count total destinations
                $stmt = $conn->query("SELECT COUNT(*) as total FROM destinations WHERE status = 'active'");
                $count = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-map-marked-alt fa-3x text-primary mb-3"></i>
                            <h2 class="fw-bold"><?= $count['total'] ?>+</h2>
                            <p class="text-muted mb-0">Destinasi Wisata</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-star fa-3x text-warning mb-3"></i>
                            <h2 class="fw-bold">4.8</h2>
                            <p class="text-muted mb-0">Rating Rata-rata</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x text-success mb-3"></i>
                            <h2 class="fw-bold">1000+</h2>
                            <p class="text-muted mb-0">Pengunjung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section id="featured" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Destinasi Populer</h2>
                <p class="text-muted">Rekomendasi destinasi terbaik di Kalimantan Timur</p>
            </div>
            
            <div class="row g-4">
                <?php
                // Fetch featured destinations
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
                    <div class="card destination-card h-100 border-0 shadow">
                        <div class="position-relative" style="height: 250px; overflow: hidden;">
                            <img src="<?= $dest['image'] ? 'assets/img/' . htmlspecialchars($dest['image']) : 'https://via.placeholder.com/400x300?text=' . urlencode($dest['name']) ?>" 
                                 class="card-img-top" 
                                 style="height: 100%; width: 100%; object-fit: cover;"
                                 alt="<?= htmlspecialchars($dest['name']) ?>">
                            <span class="badge bg-primary position-absolute top-0 start-0 m-3">
                                <?= htmlspecialchars($dest['category_name']) ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($dest['name']) ?></h5>
                            <p class="card-text text-muted small mb-2">
                                <i class="fas fa-map-marker-alt text-danger"></i> 
                                <?= htmlspecialchars($dest['location']) ?>
                            </p>
                            <p class="card-text">
                                <?= substr(htmlspecialchars($dest['description']), 0, 100) ?>...
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="text-warning">
                                        <?php 
                                        $rating = floor($dest['rating']);
                                        for($i = 0; $i < 5; $i++): 
                                        ?>
                                            <i class="fas fa-star<?= $i >= $rating ? ' text-muted' : '' ?>"></i>
                                        <?php endfor; ?>
                                    </span>
                                    <small class="text-muted ms-1">(<?= $dest['rating'] ?>)</small>
                                </div>
                                <a href="public/detail.php?id=<?= $dest['id'] ?>" class="btn btn-sm btn-primary">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-5">
                <a href="public/destinations.php" class="btn btn-primary btn-lg">
                    Lihat Semua Destinasi <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-5 fw-bold mb-4">Tentang Kalimantan Timur</h2>
                    <p class="lead mb-3">
                        Kalimantan Timur adalah provinsi di Indonesia yang kaya akan keindahan alam, 
                        budaya yang beragam, dan kuliner yang menggugah selera.
                    </p>
                    <p>
                        Dari pantai eksotis Derawan, danau kakaban dengan ubur-ubur unik, hutan tropis yang lebat, 
                        hingga sungai Mahakam yang legendaris - Kaltim menawarkan pengalaman wisata yang tak terlupakan.
                    </p>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800" 
                         class="img-fluid rounded shadow" 
                         alt="Kalimantan Timur">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-mountain"></i> Wisata Kaltim</h5>
                    <p class="text-muted">
                        Platform informasi pariwisata Kalimantan Timur.<br>
                        Contoh Mini Project - SMK Negeri 7 Samarinda
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-muted text-decoration-none">Beranda</a></li>
                        <li><a href="public/destinations.php" class="text-muted text-decoration-none">Destinasi</a></li>
                        <li><a href="login.php" class="text-muted text-decoration-none">Admin</a></li>
                    </ul>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="text-center text-muted">
                <small>&copy; 2026 Tim Contoh - SMK Negeri 7 Samarinda XII PPLG 1</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
