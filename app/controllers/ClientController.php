<?php
/**
 * Client Controller
 * Handles customer account management
 */
class ClientController {
    private $userModel;
    private $orderModel;
    private $classModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->orderModel = new Order();
        $this->classModel = new ClassModel();
    }
    
    /**
     * Client dashboard
     */
    public function index() {
        requireLogin();
        
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getById($userId);
        
        // Get customer orders
        $orders = $this->orderModel->getByCustomerEmail($user['email']);
        
        // Get customer class enrollments
        $enrollments = $this->classModel->getEnrollmentsByEmail($user['email']);
        
        $data = [
            'title' => 'My Account',
            'user' => $user,
            'recentOrders' => array_slice($orders, 0, 5),
            'enrollments' => $enrollments
        ];
        
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/client/dashboard.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    /**
     * View all orders
     */
    public function orders() {
        requireLogin();
        
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getById($userId);
        $orders = $this->orderModel->getByCustomerEmail($user['email']);
        
        $data = [
            'title' => 'My Orders',
            'user' => $user,
            'orders' => $orders
        ];
        
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/client/orders.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    /**
     * View order details
     */
    public function viewOrder() {
        requireLogin();
        
        $orderId = $_GET['id'] ?? null;
        
        if (!$orderId) {
            redirect(BASE_URL . 'index.php?page=client&action=orders');
            return;
        }
        
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getById($userId);
        $order = $this->orderModel->getById($orderId);
        
        // Security: Verify this order belongs to this customer
        if (!$order || $order['customer_email'] !== $user['email']) {
            setFlashMessage('error', 'Order not found');
            redirect(BASE_URL . 'index.php?page=client&action=orders');
            return;
        }
        
        $orderItems = $this->orderModel->getItems($orderId);
        
        $data = [
            'title' => 'Order Details',
            'user' => $user,
            'order' => $order,
            'orderItems' => $orderItems
        ];
        
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/client/order_detail.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    /**
     * View profile
     */
    public function profile() {
        requireLogin();
        
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getById($userId);
        
        $data = [
            'title' => 'My Profile',
            'user' => $user,
            'csrf_token' => generateCSRFToken()
        ];
        
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/client/profile.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    /**
     * Update profile
     */
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(BASE_URL . 'index.php?page=client&action=profile');
            return;
        }
        
        requireLogin();
        
        if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid form submission');
            redirect(BASE_URL . 'index.php?page=client&action=profile');
            return;
        }
        
        $userId = $_SESSION['user_id'];
        
        $userData = [
            'username' => sanitize($_POST['username']),
            'email' => sanitize($_POST['email'])
        ];
        
        // Validate email
        if (!validateEmail($userData['email'])) {
            setFlashMessage('error', 'Invalid email address');
            redirect(BASE_URL . 'index.php?page=client&action=profile');
            return;
        }
        
        // Update password if provided
        if (!empty($_POST['password'])) {
            if ($_POST['password'] !== $_POST['password_confirm']) {
                setFlashMessage('error', 'Passwords do not match');
                redirect(BASE_URL . 'index.php?page=client&action=profile');
                return;
            }
            $userData['password'] = $_POST['password'];
        }
        
        if ($this->userModel->update($userId, $userData)) {
            $_SESSION['username'] = $userData['username'];
            setFlashMessage('success', 'Profile updated successfully');
        } else {
            setFlashMessage('error', 'Failed to update profile');
        }
        
        redirect(BASE_URL . 'index.php?page=client&action=profile');
    }
    
    /**
     * View class enrollments
     */
    public function classes() {
        requireLogin();
        
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getById($userId);
        $enrollments = $this->classModel->getEnrollmentsByEmail($user['email']);
        
        $data = [
            'title' => 'My Classes',
            'user' => $user,
            'enrollments' => $enrollments
        ];
        
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/client/classes.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
}
