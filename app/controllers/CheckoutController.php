<?php
/**
 * Checkout Controller
 */
class CheckoutController {
    private $orderModel;
    
    public function __construct() {
        $this->orderModel = new Order();
    }
    
    public function index() {
        // Check if cart is empty
        $cart = $_SESSION['cart'] ?? [];
        
        if (empty($cart)) {
            redirect(BASE_URL . 'index.php?page=cart');
            return;
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $tax = $subtotal * 0.08;
        $shipping = $subtotal > 100 ? 0 : 15;
        $total = $subtotal + $tax + $shipping;
        
        // Page data
        $data = [
            'title' => 'Checkout',
            'cart' => $cart,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'csrf_token' => generateCSRFToken()
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/checkout/index.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    public function process() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(BASE_URL . 'index.php?page=checkout');
            return;
        }
        
        // Verify CSRF token
        if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid form submission');
            redirect(BASE_URL . 'index.php?page=checkout');
            return;
        }
        
        // Validate and sanitize input
        $customerName = sanitize($_POST['name'] ?? '');
        $customerEmail = sanitize($_POST['email'] ?? '');
        $customerPhone = sanitize($_POST['phone'] ?? '');
        $shippingAddress = sanitize($_POST['shipping_address'] ?? '');
        $billingAddress = sanitize($_POST['billing_address'] ?? $shippingAddress);
        $paymentMethod = sanitize($_POST['payment_method'] ?? 'stripe');
        
        // Validation
        $errors = [];
        
        if (empty($customerName)) {
            $errors[] = 'Name is required';
        }
        
        if (empty($customerEmail) || !validateEmail($customerEmail)) {
            $errors[] = 'Valid email is required';
        }
        
        if (empty($shippingAddress)) {
            $errors[] = 'Shipping address is required';
        }
        
        if (!empty($errors)) {
            setFlashMessage('error', implode('<br>', $errors));
            redirect(BASE_URL . 'index.php?page=checkout');
            return;
        }
        
        // Get cart
        $cart = $_SESSION['cart'] ?? [];
        
        if (empty($cart)) {
            redirect(BASE_URL . 'index.php?page=cart');
            return;
        }
        
        // Calculate totals
        $subtotal = 0;
        $items = [];
        
        foreach ($cart as $item) {
            $itemSubtotal = $item['price'] * $item['quantity'];
            $subtotal += $itemSubtotal;
            
            $items[] = [
                'product_id' => $item['product_id'],
                'product_title' => $item['title'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'selected_options' => $item['options'],
                'subtotal' => $itemSubtotal
            ];
        }
        
        $tax = $subtotal * 0.08;
        $shipping = $subtotal > 100 ? 0 : 15;
        $total = $subtotal + $tax + $shipping;
        
        // Create order
        $orderData = [
            'order_number' => generateOrderNumber(),
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'shipping_address' => $shippingAddress,
            'billing_address' => $billingAddress,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping_cost' => $shipping,
            'total' => $total,
            'payment_method' => $paymentMethod,
            'items' => $items
        ];
        
        $orderId = $this->orderModel->create($orderData);
        
        if ($orderId) {
            // Clear cart
            $_SESSION['cart'] = [];
            
            // Send confirmation email (placeholder)
            // sendEmail($customerEmail, 'Order Confirmation', 'Thank you for your order!');
            
            // Redirect to success page
            redirect(BASE_URL . 'index.php?page=checkout&action=success&order=' . $orderData['order_number']);
        } else {
            setFlashMessage('error', 'Error processing order. Please try again.');
            redirect(BASE_URL . 'index.php?page=checkout');
        }
    }
    
    public function success() {
        $orderNumber = $_GET['order'] ?? null;
        
        if (!$orderNumber) {
            redirect(BASE_URL . 'index.php');
            return;
        }
        
        $order = $this->orderModel->getByOrderNumber($orderNumber);
        
        if (!$order) {
            redirect(BASE_URL . 'index.php');
            return;
        }
        
        $orderItems = $this->orderModel->getItems($order['id']);
        
        // Page data
        $data = [
            'title' => 'Order Confirmation',
            'order' => $order,
            'orderItems' => $orderItems
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/checkout/success.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
}
