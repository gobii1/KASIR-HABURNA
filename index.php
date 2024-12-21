<?php
include 'config.php';
session_start();

// Check user authentication and role
if (!isset($_SESSION['userid'])) {
    $_SESSION['error'] = 'Anda harus login dahulu';
    header('Location: login.php');
    exit;
}

if ($_SESSION['role_id'] == 2) {
    header('Location: kasir.php');
    exit;
}

$current_page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Query untuk menghitung data
    $totalBarangQuery = $dbconnect->query("SELECT COUNT(*) AS total FROM barang");
    $totalBarang = $totalBarangQuery->fetch_assoc()['total'];

    $totalUserQuery = $dbconnect->query("SELECT COUNT(*) AS total FROM user");
    $totalUser = $totalUserQuery->fetch_assoc()['total'];

    $totalRoleQuery = $dbconnect->query("SELECT COUNT(*) AS total FROM role");

    $totalRole = $totalRoleQuery->fetch_assoc()['total'];

    $totalDiskonQuery = $dbconnect->query("SELECT COUNT(*) AS total FROM disbarang");
    $totalDiskon = $totalDiskonQuery->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px;
            display: block;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            background: #fff;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

    </style>
</head>
<body>

<div class="sidebar">
    <h2 class="text-center py-3">KasirPHP</h2>
    <a href="index.php?page=home" class="<?= $current_page == 'home' ? 'active' : '' ?>">Dashboard</a>
    <a href="index.php?page=barang" class="<?= $current_page == 'barang' ? 'active' : '' ?>">Barang</a>
    <a href="index.php?page=role" class="<?= $current_page == 'role' ? 'active' : '' ?>">Role</a>
    <a href="index.php?page=user" class="<?= $current_page == 'user' ? 'active' : '' ?>">User</a>
    <a href="index.php?page=dis_barang" class="<?= $current_page == 'dis_barang' ? 'active' : '' ?>">Diskon Barang</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
        </div>
    </nav>

    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <?php if ($current_page != 'home') : ?>
                <li class="breadcrumb-item active"><?= ucfirst($current_page) ?></li>
            <?php endif; ?>
        </ol>

        <h1 class="mb-4">Dashboard</h1>

        <!-- Statistics Section -->
        <div class="container">
    <div class="row">
        <!-- Total Barang -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Barang</h5>
                    <p class="card-text"><?= $totalBarang ?></p>
                </div>
            </div>
        </div>

        <!-- Total User -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total User</h5>
                    <p class="card-text"><?= $totalUser ?></p>
                </div>
            </div>
        </div>

        <!-- Total Role -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Role</h5>
                    <p class="card-text"><?= $totalRole ?></p>
                </div>
            </div>
        </div>

        <!-- Diskon Aktif -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Diskon Aktif</h5>
                    <p class="card-text"><?= $totalDiskon ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Dynamic Page Content -->
        <?php
        if (isset($_GET['page']) && file_exists('page/' . $_GET['page'] . '.php')) {
            include 'page/' . $_GET['page'] . '.php';
        } else {
            include 'page/home.php';
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
