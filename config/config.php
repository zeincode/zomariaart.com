<?php
/**
 * Application Configuration
 */

// Site settings
define('SITE_NAME', "Zo's Art Gallery");
define('SITE_URL', 'http://zomariaart.local');
define('SITE_EMAIL', 'contact@zomariaart.com');

// Path settings
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('ASSETS_PATH', ROOT_PATH . '/assets');

// URL settings
define('BASE_URL', '/');
define('ASSETS_URL', BASE_URL . 'assets/');
define('CSS_URL', ASSETS_URL . 'css/');
define('JS_URL', ASSETS_URL . 'js/');
define('IMAGES_URL', ASSETS_URL . 'images/');

// Security settings
define('SESSION_LIFETIME', 3600); // 1 hour
define('ENABLE_HTTPS', false); // Disabled for local development

// Payment settings (to be configured)
define('STRIPE_PUBLIC_KEY', 'pk_test_your_stripe_key_here');
define('STRIPE_SECRET_KEY', 'sk_test_your_stripe_key_here');
define('PAYPAL_CLIENT_ID', 'your_paypal_client_id_here');
define('PAYPAL_SECRET', 'your_paypal_secret_here');

// Email settings (to be configured)
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'noreply@zomariaart.com');
define('SMTP_PASS', 'your_email_password');

// Image settings
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
define('THUMBNAIL_WIDTH', 400);
define('THUMBNAIL_HEIGHT', 400);

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Autoload function
spl_autoload_register(function ($class) {
    $paths = [
        APP_PATH . '/models/' . $class . '.php',
        APP_PATH . '/controllers/' . $class . '.php',
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Helper functions
require_once ROOT_PATH . '/config/helpers.php';
