<?php
/**
 * Product Controller
 */
class ProductController {
    private $productModel;
    
    public function __construct() {
        $this->productModel = new Product();
    }
    
    public function show() {
        $productId = $_GET['id'] ?? null;
        
        if (!$productId) {
            redirect(BASE_URL . 'index.php?page=gallery');
            return;
        }
        
        $product = $this->productModel->getById($productId);
        
        if (!$product) {
            http_response_code(404);
            require_once APP_PATH . '/views/errors/404.php';
            return;
        }
        
        // Get product options
        $options = $this->productModel->getOptions($productId);
        
        // Page data
        $data = [
            'title' => $product['title'] . ' - ' . SITE_NAME,
            'product' => $product,
            'options' => $options
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/product/detail.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
}
