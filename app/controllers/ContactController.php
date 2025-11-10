<?php
/**
 * Contact Controller
 */
class ContactController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function index() {
        // Page data
        $data = [
            'title' => 'Contact Us',
            'csrf_token' => generateCSRFToken()
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/contact/index.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    public function submit() {
        // Verify CSRF token
        if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid form submission');
            redirect(BASE_URL . 'index.php?page=contact');
            return;
        }
        
        $name = sanitize($_POST['name'] ?? '');
        $email = sanitize($_POST['email'] ?? '');
        $subject = sanitize($_POST['subject'] ?? '');
        $message = sanitize($_POST['message'] ?? '');
        
        // Validation
        $errors = [];
        
        if (empty($name)) {
            $errors[] = 'Name is required';
        }
        
        if (empty($email) || !validateEmail($email)) {
            $errors[] = 'Valid email is required';
        }
        
        if (empty($message)) {
            $errors[] = 'Message is required';
        }
        
        if (!empty($errors)) {
            setFlashMessage('error', implode('<br>', $errors));
            redirect(BASE_URL . 'index.php?page=contact');
            return;
        }
        
        // Save inquiry
        $inquiryData = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ];
        
        if ($this->userModel->saveContactInquiry($inquiryData)) {
            // Send notification email (placeholder)
            // sendEmail(SITE_EMAIL, 'New Contact Inquiry', 'From: ' . $name);
            
            setFlashMessage('success', 'Thank you for your message! We will get back to you soon.');
        } else {
            setFlashMessage('error', 'An error occurred. Please try again.');
        }
        
        redirect(BASE_URL . 'index.php?page=contact');
    }
}
