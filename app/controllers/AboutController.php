<?php
/**
 * About Controller
 */
class AboutController {
    
    public function index() {
        // Page data
        $data = [
            'title' => 'About Zo - Artist Biography'
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/about/index.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
}
