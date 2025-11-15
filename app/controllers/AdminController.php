<?php
/**
 * Admin Controller
 */
class AdminController {
    private $productModel;
    private $orderModel;
    private $classModel;
    
    public function __construct() {
        $this->productModel = new Product();
        $this->orderModel = new Order();
        $this->classModel = new ClassModel();
    }
    
    public function index() {
        // Get statistics
        $stats = $this->orderModel->getSalesStats();
        $recentOrders = $this->orderModel->getAll(['limit' => 10]);
        $upcomingClasses = $this->classModel->getUpcoming(5);
        
        // Page data
        $data = [
            'title' => 'Admin Dashboard',
            'stats' => $stats,
            'recentOrders' => $recentOrders,
            'upcomingClasses' => $upcomingClasses
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/admin_header.php';
        require_once APP_PATH . '/views/admin/dashboard.php';
        require_once APP_PATH . '/views/layouts/admin_footer.php';
    }
    
    // Product Management
    public function products() {
        $products = $this->productModel->getAll([]);
        
        $data = [
            'title' => 'Product Management',
            'products' => $products
        ];
        
        require_once APP_PATH . '/views/layouts/admin_header.php';
        require_once APP_PATH . '/views/admin/products.php';
        require_once APP_PATH . '/views/layouts/admin_footer.php';
    }
    
    public function editProduct() {
        $productId = $_GET['id'] ?? null;
        $product = $productId ? $this->productModel->getById($productId) : null;
        
        $data = [
            'title' => $productId ? 'Edit Product' : 'Add Product',
            'product' => $product,
            'csrf_token' => generateCSRFToken()
        ];
        
        require_once APP_PATH . '/views/layouts/admin_header.php';
        require_once APP_PATH . '/views/admin/product_form.php';
        require_once APP_PATH . '/views/layouts/admin_footer.php';
    }
    
    public function saveProduct() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(BASE_URL . 'index.php?page=admin&action=products');
            return;
        }
        
        $productId = $_POST['product_id'] ?? null;
        
        $productData = [
            'title' => sanitize($_POST['title']),
            'description' => sanitize($_POST['description']),
            'base_price' => (float)$_POST['base_price'],
            'category' => sanitize($_POST['category']),
            'medium' => sanitize($_POST['medium']),
            'featured' => isset($_POST['featured']) ? 1 : 0,
            'stock_quantity' => (int)$_POST['stock_quantity'],
            'status' => sanitize($_POST['status'])
        ];
        
        if ($productId) {
            $this->productModel->update($productId, $productData);
            setFlashMessage('success', 'Product updated successfully');
        } else {
            $this->productModel->create($productData);
            setFlashMessage('success', 'Product created successfully');
        }
        
        redirect(BASE_URL . 'index.php?page=admin&action=products');
    }
    
    public function deleteProduct() {
        $productId = $_GET['id'] ?? null;
        
        if ($productId) {
            $this->productModel->delete($productId);
            setFlashMessage('success', 'Product deleted successfully');
        }
        
        redirect(BASE_URL . 'index.php?page=admin&action=products');
    }
    
    // Order Management
    public function orders() {
        $orders = $this->orderModel->getAll();
        
        $data = [
            'title' => 'Order Management',
            'orders' => $orders
        ];
        
        require_once APP_PATH . '/views/layouts/admin_header.php';
        require_once APP_PATH . '/views/admin/orders.php';
        require_once APP_PATH . '/views/layouts/admin_footer.php';
    }
    
    public function viewOrder() {
        $orderId = $_GET['id'] ?? null;
        
        if (!$orderId) {
            redirect(BASE_URL . 'index.php?page=admin&action=orders');
            return;
        }
        
        $order = $this->orderModel->getById($orderId);
        $orderItems = $this->orderModel->getItems($orderId);
        
        $data = [
            'title' => 'Order Details',
            'order' => $order,
            'orderItems' => $orderItems,
            'csrf_token' => generateCSRFToken()
        ];
        
        require_once APP_PATH . '/views/layouts/admin_header.php';
        require_once APP_PATH . '/views/admin/order_detail.php';
        require_once APP_PATH . '/views/layouts/admin_footer.php';
    }
    
    public function updateOrderStatus() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(BASE_URL . 'index.php?page=admin&action=orders');
            return;
        }
        
        $orderId = $_POST['order_id'] ?? null;
        $status = $_POST['status'] ?? null;
        
        if ($orderId && $status) {
            $this->orderModel->updateStatus($orderId, $status);
            setFlashMessage('success', 'Order status updated');
        }
        
        redirect(BASE_URL . 'index.php?page=admin&action=viewOrder&id=' . $orderId);
    }
    
    public function updatePaymentStatus() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(BASE_URL . 'index.php?page=admin&action=orders');
            return;
        }
        
        $orderId = $_POST['order_id'] ?? null;
        $status = $_POST['payment_status'] ?? null;
        
        if ($orderId && $status) {
            $this->orderModel->updatePaymentStatus($orderId, $status);
            setFlashMessage('success', 'Payment status updated');
        }
        
        redirect(BASE_URL . 'index.php?page=admin&action=viewOrder&id=' . $orderId);
    }
    
    // Payment Management Dashboard
    public function payments() {
        $orders = $this->orderModel->getAll([]);
        
        // Calculate payment statistics
        $stats = [
            'total_revenue' => 0,
            'pending_payments' => 0,
            'completed_payments' => 0,
            'failed_payments' => 0
        ];
        
        foreach ($orders as $order) {
            if ($order['payment_status'] === 'completed') {
                $stats['total_revenue'] += $order['total'];
                $stats['completed_payments']++;
            } elseif ($order['payment_status'] === 'pending') {
                $stats['pending_payments']++;
            } elseif ($order['payment_status'] === 'failed') {
                $stats['failed_payments']++;
            }
        }
        
        $data = [
            'title' => 'Payment Management',
            'orders' => $orders,
            'stats' => $stats
        ];
        
        require_once APP_PATH . '/views/layouts/admin_header.php';
        require_once APP_PATH . '/views/admin/payments.php';
        require_once APP_PATH . '/views/layouts/admin_footer.php';
    }
    
    // Class Management
    public function classes() {
        $classes = $this->classModel->getAll();
        
        $data = [
            'title' => 'Class Management',
            'classes' => $classes
        ];
        
        require_once APP_PATH . '/views/layouts/admin_header.php';
        require_once APP_PATH . '/views/admin/classes.php';
        require_once APP_PATH . '/views/layouts/admin_footer.php';
    }
    
    public function editClass() {
        $classId = $_GET['id'] ?? null;
        $class = $classId ? $this->classModel->getById($classId) : null;
        
        $data = [
            'title' => $classId ? 'Edit Class' : 'Add Class',
            'class' => $class,
            'csrf_token' => generateCSRFToken()
        ];
        
        require_once APP_PATH . '/views/layouts/admin_header.php';
        require_once APP_PATH . '/views/admin/class_form.php';
        require_once APP_PATH . '/views/layouts/admin_footer.php';
    }
    
    public function saveClass() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(BASE_URL . 'index.php?page=admin&action=classes');
            return;
        }
        
        $classId = $_POST['class_id'] ?? null;
        
        $classData = [
            'title' => sanitize($_POST['title']),
            'description' => sanitize($_POST['description']),
            'syllabus' => sanitize($_POST['syllabus']),
            'required_materials' => sanitize($_POST['required_materials']),
            'date' => sanitize($_POST['date']),
            'time' => sanitize($_POST['time']),
            'location' => sanitize($_POST['location']),
            'price' => (float)$_POST['price'],
            'capacity' => (int)$_POST['capacity'],
            'status' => sanitize($_POST['status'])
        ];
        
        if ($classId) {
            $this->classModel->update($classId, $classData);
            setFlashMessage('success', 'Class updated successfully');
        } else {
            $this->classModel->create($classData);
            setFlashMessage('success', 'Class created successfully');
        }
        
        redirect(BASE_URL . 'index.php?page=admin&action=classes');
    }
    
    public function deleteClass() {
        $classId = $_GET['id'] ?? null;
        
        if ($classId) {
            $this->classModel->delete($classId);
            setFlashMessage('success', 'Class deleted successfully');
        }
        
        redirect(BASE_URL . 'index.php?page=admin&action=classes');
    }
}
