<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Admin Dashboard'; ?> - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/admin.css">
</head>
<body class="admin-body">
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <h2>Admin Panel</h2>
                <p>Welcome, <?php echo e($_SESSION['username'] ?? 'Admin'); ?></p>
            </div>
            
            <nav class="admin-nav">
                <a href="<?php echo BASE_URL; ?>index.php?page=admin" class="admin-nav-link">
                    Dashboard
                </a>
                <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=products" class="admin-nav-link">
                    Products
                </a>
                <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=orders" class="admin-nav-link">
                    Orders
                </a>
                <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=payments" class="admin-nav-link">
                    Payments
                </a>
                <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=classes" class="admin-nav-link">
                    Classes
                </a>
                <a href="<?php echo BASE_URL; ?>index.php?page=home" class="admin-nav-link">
                    View Site
                </a>
                <a href="<?php echo BASE_URL; ?>index.php?page=logout" class="admin-nav-link">
                    Logout
                </a>
            </nav>
        </aside>
        
        <main class="admin-main">
            <div class="admin-content">
                <?php if ($message = getFlashMessage('success')): ?>
                    <div class="alert alert-success"><?php echo $message; ?></div>
                <?php endif; ?>
                
                <?php if ($message = getFlashMessage('error')): ?>
                    <div class="alert alert-error"><?php echo $message; ?></div>
                <?php endif; ?>
