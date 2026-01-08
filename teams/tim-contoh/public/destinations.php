<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Destinasi - Wisata Kaltim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php
    require_once '../config.php';
    
    // Get search query
    $search = $_GET['search'] ?? '';
    $category = $_GET['category'] ?? '';
    
    // Build query
    $sql = "SELECT d.*, c.name as category_name 
            FROM destinations d 
            LEFT JOIN categories c ON d.category_id = c.id 
            WHERE d.status = 'active'";
    
    $params = [];
    
    if($search) {
        $sql .= " AND (d.name LIKE ? OR d.description LIKE ? OR d.location LIKE ?)";
        $searchParam = "%$search%";
        $params[] = $searchParam;
        $params[] = $searchParam;
        $params[] = $searchParam;
    }
    
    if($category) {
        $sql .= " AND d.category_id = ?";
        $params[] = $category;
    }
    
    $sql .= " ORDER BY d.rating DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get categories for filter
    $categories = $conn->query("SELECT * FROM categories ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <i class="fas fa-mountain"></i> Wisata Kaltim
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="destinations.php">Destinasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login.php">
                            <i class="fas fa-sign-in-alt"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="bg-primary text-white py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Semua Destinasi</h1>
            <p class="lead">Jelajahi semua destinasi wisata di Kalimantan Timur</p>
        </div>
    </section>

    <!-- Search & Filter -->
    <section class="py-4 bg-light">
        <div class="container">
            <form method="GET" class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="Cari destinasi..." value="<?= htmlspecialchars($search) ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="category">
                        <option value="">Semua Kategori</option>
                        <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= $category == $cat['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Destinations Grid -->
    <section class="py-5">
        <div class="container">
            <?php if(count($destinations) > 0): ?>
            <div class="row g-4">
                <?php foreach($destinations as $dest): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card destination-card h-100 border-0 shadow">
                        <div class="position-relative" style="height: 250px; overflow: hidden;">
                            <img src="<?= $dest['image'] ? '../assets/img/' . htmlspecialchars($dest['image']) : 'https://via.placeholder.com/400x300?text=' . urlencode($dest['name']) ?>" 
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
                                <a href="detail.php?id=<?= $dest['id'] ?>" class="btn btn-sm btn-primary">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> Tidak ada destinasi yang ditemukan.
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2026 Wisata Kaltim - SMK Negeri 7 Samarinda</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
