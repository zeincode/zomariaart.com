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
    
    public function showRegister() {
        // If already logged in, redirect based on role
        if (isLoggedIn()) {
            if (isAdmin()) {
                redirect(BASE_URL . 'index.php?page=admin');
            } else {
                redirect(BASE_URL . 'index.php?page=client');
            }
            return;
        }
        
        // Page data
        $data = [
            'title' => 'Create Account',
            'csrf_token' => generateCSRFToken()
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/auth/register.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    public function register() {
        // Verify CSRF token
        if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid form submission');
            redirect(BASE_URL . 'index.php?page=register');
            return;
        }
        
        $username = sanitize($_POST['username'] ?? '');
        $email = sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';
        
        // Validate inputs
        if (empty($username) || empty($email) || empty($password)) {
            setFlashMessage('error', 'All fields are required');
            redirect(BASE_URL . 'index.php?page=register');
            return;
        }
        
        if (!validateEmail($email)) {
            setFlashMessage('error', 'Invalid email address');
            redirect(BASE_URL . 'index.php?page=register');
            return;
        }
        
        if (strlen($password) < 6) {
            setFlashMessage('error', 'Password must be at least 6 characters');
            redirect(BASE_URL . 'index.php?page=register');
            return;
        }
        
        if ($password !== $passwordConfirm) {
            setFlashMessage('error', 'Passwords do not match');
            redirect(BASE_URL . 'index.php?page=register');
            return;
        }
        
        // Create user
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => 'customer'
        ];
        
        if ($this->userModel->create($userData)) {
            setFlashMessage('success', 'Account created successfully! Please log in.');
            redirect(BASE_URL . 'index.php?page=login');
        } else {
            setFlashMessage('error', 'Failed to create account. Username or email may already exist.');
            redirect(BASE_URL . 'index.php?page=register');
        }
    }
}
