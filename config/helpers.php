<?php
/**
 * Helper Functions
 */

/**
 * Sanitize input data
 */
function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Generate CSRF token
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Redirect to a URL
 */
function redirect($url) {
    header("Location: " . $url);
    exit;
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_role']);
}

/**
 * Check if user is admin
 */
function isAdmin() {
    return isLoggedIn() && $_SESSION['user_role'] === 'admin';
}

/**
 * Require admin access
 */
function requireAdmin() {
    if (!isAdmin()) {
        redirect(BASE_URL . 'index.php?page=login');
    }
}

/**
 * Require user to be logged in
 */
function requireLogin() {
    if (!isLoggedIn()) {
        redirect(BASE_URL . 'index.php?page=login');
    }
}

/**
 * Format price
 */
function formatPrice($price) {
    return '$' . number_format($price, 2);
}

/**
 * Format date
 */
function formatDate($date, $format = 'F j, Y') {
    return date($format, strtotime($date));
}

/**
 * Generate order number
 */
function generateOrderNumber() {
    return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

/**
 * Send email (placeholder - configure with actual SMTP)
 */
function sendEmail($to, $subject, $message) {
    // In production, use PHPMailer or similar library
    $headers = 'From: ' . SITE_EMAIL . "\r\n";
    $headers .= 'Reply-To: ' . SITE_EMAIL . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
    
    return mail($to, $subject, $message, $headers);
}

/**
 * Get flash message
 */
function getFlashMessage($key) {
    if (isset($_SESSION['flash'][$key])) {
        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }
    return null;
}

/**
 * Set flash message
 */
function setFlashMessage($key, $message) {
    $_SESSION['flash'][$key] = $message;
}

/**
 * Escape output
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Include view file
 */
function view($viewPath, $data = []) {
    extract($data);
    $viewFile = APP_PATH . '/views/' . $viewPath . '.php';
    if (file_exists($viewFile)) {
        include $viewFile;
    } else {
        die("View not found: " . $viewPath);
    }
}

/**
 * Get current page
 */
function getCurrentPage() {
    return isset($_GET['page']) ? sanitize($_GET['page']) : 'home';
}

/**
 * Calculate seats left for a class
 */
function calculateSeatsLeft($capacity, $enrolled) {
    return max(0, $capacity - $enrolled);
}
