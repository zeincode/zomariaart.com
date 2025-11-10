<?php
/**
 * Cart Controller
 */
class CartController {
    
    public function index() {
        // Get cart from session
        $cart = $_SESSION['cart'] ?? [];
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $tax = $subtotal * 0.08; // 8% tax
        $shipping = $subtotal > 100 ? 0 : 15; // Free shipping over $100
        $total = $subtotal + $tax + $shipping;
        
        // Page data
        $data = [
            'title' => 'Shopping Cart',
            'cart' => $cart,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/cart/index.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            $quantity = (int)($_POST['quantity'] ?? 1);
            $selectedOptions = $_POST['options'] ?? [];
            
            if ($productId) {
                $productModel = new Product();
                $product = $productModel->getById($productId);
                
                if ($product) {
                    // Calculate price with options
                    $price = $product['base_price'];
                    
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }
                    
                    $cartItemKey = $productId . '_' . md5(json_encode($selectedOptions));
                    
                    $_SESSION['cart'][$cartItemKey] = [
                        'product_id' => $productId,
                        'title' => $product['title'],
                        'price' => $price,
                        'quantity' => $quantity,
                        'options' => $selectedOptions,
                        'image' => $product['thumbnail_url']
                    ];
                    
                    setFlashMessage('success', 'Product added to cart!');
                }
            }
        }
        
        redirect(BASE_URL . 'index.php?page=cart');
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartItemKey = $_POST['item_key'] ?? null;
            $quantity = (int)($_POST['quantity'] ?? 1);
            
            if ($cartItemKey && isset($_SESSION['cart'][$cartItemKey])) {
                if ($quantity > 0) {
                    $_SESSION['cart'][$cartItemKey]['quantity'] = $quantity;
                } else {
                    unset($_SESSION['cart'][$cartItemKey]);
                }
            }
        }
        
        redirect(BASE_URL . 'index.php?page=cart');
    }
    
    public function remove() {
        $cartItemKey = $_GET['item'] ?? null;
        
        if ($cartItemKey && isset($_SESSION['cart'][$cartItemKey])) {
            unset($_SESSION['cart'][$cartItemKey]);
            setFlashMessage('success', 'Item removed from cart');
        }
        
        redirect(BASE_URL . 'index.php?page=cart');
    }
    
    public function clear() {
        $_SESSION['cart'] = [];
        setFlashMessage('success', 'Cart cleared');
        redirect(BASE_URL . 'index.php?page=cart');
    }
}
