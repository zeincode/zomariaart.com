<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo SITE_NAME; ?> - Original artwork by artist Zo. Browse our gallery, shop for art, and join our art classes.">
    <meta name="keywords" content="art gallery, artwork, paintings, art classes, artist Zo">
    <title><?php echo $data['title'] ?? SITE_NAME; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo IMAGES_URL; ?>watermark/logo.png">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/style.css">
    
    <!-- Prevent right-click -->
    <script>
        document.addEventListener('contextmenu', function(e) {
            if (e.target.tagName === 'IMG') {
                e.preventDefault();
                return false;
            }
        });
    </script>
</head>
<body>
    <header class="site-header">
        <nav class="navbar">
            <div class="container">
                <div class="header-branding">
                    <a href="<?php echo BASE_URL; ?>index.php?page=home" class="logo">
                        <img src="<?php echo IMAGES_URL; ?>placeholder/Zo_s_Logo.png" alt="<?php echo SITE_NAME; ?>" class="logo-image">
                    </a>
                </div>

                <button class="mobile-menu-toggle" aria-label="Toggle Menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <ul class="nav-menu">
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=home">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=gallery">Gallery</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=teaching">Classes</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=about">About</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=contact">Contact</a></li>
                    <?php if (isLoggedIn()): ?>
                        <?php if (isAdmin()): ?>
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=admin">Admin</a></li>
                        <?php else: ?>
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=client">My Account</a></li>
                        <?php endif; ?>
                        <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo BASE_URL; ?>index.php?page=login">Login</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=cart" class="cart-icon" aria-label="Shopping Cart">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </a></li>
                </ul>
            </div>
        </nav>
    </header>
    
    <main class="main-content">
        <?php if ($message = getFlashMessage('success')): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if ($message = getFlashMessage('error')): ?>
            <div class="alert alert-error"><?php echo $message; ?></div>
        <?php endif; ?>
