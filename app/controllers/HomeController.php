<?php
/**
 * Home Controller
 */
class HomeController {
    private $productModel;
    
    public function __construct() {
        $this->productModel = new Product();
    }
    
    public function index() {
        // Get featured products
        $featuredProducts = $this->productModel->getFeatured(6);
        
        // Page data
        $data = [
            'title' => 'Welcome to ' . SITE_NAME,
            'featuredProducts' => $featuredProducts
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/home/index.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
}
