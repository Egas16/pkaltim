<?php
require_once '../config.php';

// Check if logged in
if(!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

$id = $_GET['id'] ?? 0;
$success = '';
$error = '';

// Fetch destination
$stmt = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$stmt->execute([$id]);
$dest = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$dest) {
    header('Location: dashboard.php');
    exit;
}

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $category_id = $_POST['category_id'] ?? '';
    $description = $_POST['description'] ?? '';
    $location = $_POST['location'] ?? '';
    $rating = $_POST['rating'] ?? 0;
    $status = $_POST['status'] ?? 'active';
    
    try {
        $stmt = $conn->prepare("UPDATE destinations 
                               SET category_id = ?, name = ?, description = ?, location = ?, rating = ?, status = ? 
                               WHERE id = ?");
        $stmt->execute([$category_id, $name, $description, $location, $rating, $status, $id]);
        
        $success = 'Destinasi berhasil diupdate!';
        
        // Refresh data
        $stmt = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
        $stmt->execute([$id]);
        $dest = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $error = 'Error: ' . $e->getMessage();
    }
}

// Get categories
$categories = $conn->query("SELECT * FROM categories ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destinasi - Admin</title>
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
            <a href="../logout.php" class="btn btn-sm btn-outline-light">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0"><i class="fas fa-edit"></i> Edit Destinasi</h5>
                    </div>
                    <div class="card-body">
                        <?php if($success): ?>
                        <div class="alert alert-success alert-dismissible">
                            <i class="fas fa-check-circle"></i> <?= $success ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>
                        
                        <?php if($error): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> <?= $error ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama Destinasi *</label>
                                <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($dest['name']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori *</label>
                                <select class="form-select" name="category_id" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $dest['category_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['name']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi *</label>
                                <textarea class="form-control" name="description" rows="5" required><?= htmlspecialchars($dest['description']) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lokasi *</label>
                                <input type="text" class="form-control" name="location" value="<?= htmlspecialchars($dest['location']) ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Rating (0-5) *</label>
                                    <input type="number" class="form-control" name="rating" min="0" max="5" step="0.1" value="<?= $dest['rating'] ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status *</label>
                                    <select class="form-select" name="status" required>
                                        <option value="active" <?= $dest['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= $dest['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <a href="dashboard.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Update Destinasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
