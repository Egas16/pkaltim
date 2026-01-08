<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Destinasi - Wisata Kaltim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php
    require_once '../config.php';
    
    $id = $_GET['id'] ?? 0;
    
    // Fetch destination detail
    $stmt = $conn->prepare("SELECT d.*, c.name as category_name 
                           FROM destinations d 
                           LEFT JOIN categories c ON d.category_id = c.id 
                           WHERE d.id = ? AND d.status = 'active'");
    $stmt->execute([$id]);
    $dest = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$dest) {
        header('Location: destinations.php');
        exit;
    }
    ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <i class="fas fa-mountain"></i> Wisata Kaltim
            </a>
            <div class="ms-auto">
                <a href="destinations.php" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <!-- Detail Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow mb-4">
                        <img src="<?= $dest['image'] ? '../assets/img/' . htmlspecialchars($dest['image']) : 'https://via.placeholder.com/800x400?text=' . urlencode($dest['name']) ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($dest['name']) ?>">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <span class="badge bg-primary mb-2"><?= htmlspecialchars($dest['category_name']) ?></span>
                                    <h1 class="h2 fw-bold"><?= htmlspecialchars($dest['name']) ?></h1>
                                </div>
                                <div class="text-end">
                                    <div class="text-warning mb-1">
                                        <?php 
                                        $rating = floor($dest['rating']);
                                        for($i = 0; $i < 5; $i++): 
                                        ?>
                                            <i class="fas fa-star<?= $i >= $rating ? ' text-muted' : '' ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <small class="text-muted"><?= $dest['rating'] ?> / 5.0</small>
                                </div>
                            </div>
                            
                            <p class="text-muted mb-3">
                                <i class="fas fa-map-marker-alt text-danger"></i> 
                                <?= htmlspecialchars($dest['location']) ?>
                            </p>
                            
                            <hr>
                            
                            <h5 class="fw-bold mb-3">Deskripsi</h5>
                            <p class="text-justify"><?= nl2br(htmlspecialchars($dest['description'])) ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Informasi</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-tag text-primary"></i>
                                    <strong>Kategori:</strong><br>
                                    <span class="ms-4"><?= htmlspecialchars($dest['category_name']) ?></span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-map-marker-alt text-danger"></i>
                                    <strong>Lokasi:</strong><br>
                                    <span class="ms-4"><?= htmlspecialchars($dest['location']) ?></span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-star text-warning"></i>
                                    <strong>Rating:</strong><br>
                                    <span class="ms-4"><?= $dest['rating'] ?> / 5.0</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
