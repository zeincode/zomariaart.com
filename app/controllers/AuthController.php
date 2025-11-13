<?php
/**
 * Authentication Controller
 */
class AuthController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function showLogin() {
        // If already logged in, redirect to admin
        if (isLoggedIn()) {
            redirect(BASE_URL . 'index.php?page=admin');
            return;
        }
        
        // Page data
        $data = [
            'title' => 'Admin Login',
            'csrf_token' => generateCSRFToken()
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/auth/login.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    public function login() {
        // Verify CSRF token
        if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid form submission');
            redirect(BASE_URL . 'index.php?page=login');
            return;
        }
        
        $username = sanitize($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        $user = $this->userModel->authenticate($username, $password);
        
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            
            redirect(BASE_URL . 'index.php?page=admin');
        } else {
            setFlashMessage('error', 'Invalid username or password');
            redirect(BASE_URL . 'index.php?page=login');
        }
    }
    
    public function logout() {
        session_destroy();
        redirect(BASE_URL . 'index.php');
    }
}
