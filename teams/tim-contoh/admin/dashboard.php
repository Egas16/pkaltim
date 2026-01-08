<?php
require_once '../config.php';

// Check if logged in
if(!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Get statistics
$total_dest = $conn->query("SELECT COUNT(*) as total FROM destinations WHERE status='active'")->fetch(PDO::FETCH_ASSOC);
$total_cat = $conn->query("SELECT COUNT(*) as total FROM categories")->fetch(PDO::FETCH_ASSOC);

// Get recent destinations
$stmt = $conn->query("SELECT d.*, c.name as category_name 
                      FROM destinations d 
                      LEFT JOIN categories c ON d.category_id = c.id 
                      ORDER BY d.created_at DESC 
                      LIMIT 5");
$recent = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Wisata Kaltim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">
                <i class="fas fa-mountain"></i> Admin Dashboard
            </a>
            <div class="text-white">
                <i class="fas fa-user-circle"></i> <?= htmlspecialchars($_SESSION['username']) ?>
                <a href="../logout.php" class="btn btn-sm btn-outline-light ms-3">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar border-end">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create.php">
                                <i class="fas fa-plus-circle"></i> Tambah Destinasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php" target="_blank">
                                <i class="fas fa-external-link-alt"></i> Lihat Website
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white-50">Total Destinasi</h6>
                                        <h2 class="mb-0"><?= $total_dest['total'] ?></h2>
                                    </div>
                                    <i class="fas fa-map-marked-alt fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white-50">Total Kategori</h6>
                                        <h2 class="mb-0"><?= $total_cat['total'] ?></h2>
                                    </div>
                                    <i class="fas fa-tags fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white-50">Admin Online</h6>
                                        <h2 class="mb-0">1</h2>
                                    </div>
                                    <i class="fas fa-user-shield fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Destinations -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-list"></i> Destinasi Terbaru</h5>
                        <a href="create.php" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Baru
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Lokasi</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($recent as $row): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= htmlspecialchars($row['name']) ?></td>
                                        <td><span class="badge bg-primary"><?= htmlspecialchars($row['category_name']) ?></span></td>
                                        <td><?= htmlspecialchars(substr($row['location'], 0, 30)) ?>...</td>
                                        <td>
                                            <span class="text-warning">
                                                <i class="fas fa-star"></i> <?= $row['rating'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $row['status'] == 'active' ? 'success' : 'secondary' ?>">
                                                <?= ucfirst($row['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" 
                                               onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
