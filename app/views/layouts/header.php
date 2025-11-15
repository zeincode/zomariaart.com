<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo SITE_NAME; ?> - Original artwork by artist Zo. Browse our gallery, shop for art, and join our art classes.">
    <meta name="keywords" content="art gallery, artwork, paintings, art classes, artist Zo">
    <title><?php echo $data['title'] ?? SITE_NAME; ?></title>
    
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
                        <h1><?php echo SITE_NAME; ?></h1>
                    </a>
                    <p class="header-tagline">
                        <?php echo $data['header_tagline'] ?? 'Echoes of Light — Current Exhibition'; ?>
                    </p>
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
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=cart">Cart</a></li>
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
