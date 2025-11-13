<?php
/**
 * Gallery Controller
 */
class GalleryController {
    private $productModel;
    
    public function __construct() {
        $this->productModel = new Product();
    }
    
    public function index() {
        // Get filter parameters
        $filters = [
            'category' => $_GET['category'] ?? null,
            'medium' => $_GET['medium'] ?? null,
            'search' => $_GET['search'] ?? null,
            'min_price' => $_GET['min_price'] ?? null,
            'max_price' => $_GET['max_price'] ?? null
        ];
        
        // Remove empty filters
        $filters = array_filter($filters);
        
        // Get products
        $products = $this->productModel->getAll($filters);
        
        // Get filter options
        $categories = $this->productModel->getCategories();
        $mediaTypes = $this->productModel->getMediaTypes();
        
        // Page data
        $data = [
            'title' => 'Gallery & Shop',
            'products' => $products,
            'categories' => $categories,
            'mediaTypes' => $mediaTypes,
            'currentFilters' => $filters
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/gallery/index.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
}
