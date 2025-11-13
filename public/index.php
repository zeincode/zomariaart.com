<?php
/**
 * Front Controller / Router
 * Zo's Art Gallery Store
 */

// Load configuration
require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

// Get current page
$page = getCurrentPage();

// Route to appropriate controller
switch ($page) {
    case 'home':
    case '':
        require_once APP_PATH . '/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
        
    case 'gallery':
    case 'shop':
        require_once APP_PATH . '/controllers/GalleryController.php';
        $controller = new GalleryController();
        $controller->index();
        break;
        
    case 'product':
        require_once APP_PATH . '/controllers/ProductController.php';
        $controller = new ProductController();
        $controller->show();
        break;
        
    case 'cart':
        require_once APP_PATH . '/controllers/CartController.php';
        $controller = new CartController();
        
        if (isset($_GET['action'])) {
            $action = sanitize($_GET['action']);
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                $controller->index();
            }
        } else {
            $controller->index();
        }
        break;
        
    case 'checkout':
        require_once APP_PATH . '/controllers/CheckoutController.php';
        $controller = new CheckoutController();
        
        if (isset($_GET['action'])) {
            $action = sanitize($_GET['action']);
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                $controller->index();
            }
        } else {
            $controller->index();
        }
        break;
        
    case 'teaching':
    case 'classes':
        require_once APP_PATH . '/controllers/TeachingController.php';
        $controller = new TeachingController();
        
        if (isset($_GET['action'])) {
            $action = sanitize($_GET['action']);
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                $controller->index();
            }
        } else {
            $controller->index();
        }
        break;
        
    case 'about':
        require_once APP_PATH . '/controllers/AboutController.php';
        $controller = new AboutController();
        $controller->index();
        break;
        
    case 'contact':
        require_once APP_PATH . '/controllers/ContactController.php';
        $controller = new ContactController();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->submit();
        } else {
            $controller->index();
        }
        break;
        
    case 'login':
        require_once APP_PATH . '/controllers/AuthController.php';
        $controller = new AuthController();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->showLogin();
        }
        break;
        
    case 'logout':
        require_once APP_PATH . '/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;
        
    case 'admin':
        requireAdmin();
        require_once APP_PATH . '/controllers/AdminController.php';
        $controller = new AdminController();
        
        if (isset($_GET['action'])) {
            $action = sanitize($_GET['action']);
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                $controller->index();
            }
        } else {
            $controller->index();
        }
        break;
        
    default:
        http_response_code(404);
        require_once APP_PATH . '/views/errors/404.php';
        break;
}
