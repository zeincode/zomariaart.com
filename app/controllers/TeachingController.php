<?php
/**
 * Teaching Controller
 */
class TeachingController {
    private $classModel;
    
    public function __construct() {
        $this->classModel = new ClassModel();
    }
    
    public function index() {
        // Get upcoming classes
        $upcomingClasses = $this->classModel->getUpcoming();
        
        // Get testimonials
        $testimonials = $this->classModel->getTestimonials();
        
        // Page data
        $data = [
            'title' => 'Classes & Workshops',
            'classes' => $upcomingClasses,
            'testimonials' => $testimonials
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/teaching/index.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    public function detail() {
        $classId = $_GET['id'] ?? null;
        
        if (!$classId) {
            redirect(BASE_URL . 'index.php?page=teaching');
            return;
        }
        
        $class = $this->classModel->getById($classId);
        
        if (!$class) {
            http_response_code(404);
            require_once APP_PATH . '/views/errors/404.php';
            return;
        }
        
        // Calculate seats left
        $seatsLeft = calculateSeatsLeft($class['capacity'], $class['enrolled']);
        
        // Page data
        $data = [
            'title' => $class['title'] . ' - Classes',
            'class' => $class,
            'seatsLeft' => $seatsLeft,
            'csrf_token' => generateCSRFToken()
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/teaching/detail.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
    
    public function enroll() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(BASE_URL . 'index.php?page=teaching');
            return;
        }
        
        // Verify CSRF token
        if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid form submission');
            redirect(BASE_URL . 'index.php?page=teaching');
            return;
        }
        
        $classId = $_POST['class_id'] ?? null;
        $studentName = sanitize($_POST['name'] ?? '');
        $studentEmail = sanitize($_POST['email'] ?? '');
        $studentPhone = sanitize($_POST['phone'] ?? '');
        
        // Validation
        $errors = [];
        
        if (!$classId) {
            $errors[] = 'Invalid class';
        }
        
        if (empty($studentName)) {
            $errors[] = 'Name is required';
        }
        
        if (empty($studentEmail) || !validateEmail($studentEmail)) {
            $errors[] = 'Valid email is required';
        }
        
        if (!empty($errors)) {
            setFlashMessage('error', implode('<br>', $errors));
            redirect(BASE_URL . 'index.php?page=teaching&action=detail&id=' . $classId);
            return;
        }
        
        // Enroll student
        $enrollmentData = [
            'class_id' => $classId,
            'student_name' => $studentName,
            'student_email' => $studentEmail,
            'student_phone' => $studentPhone
        ];
        
        if ($this->classModel->enroll($enrollmentData)) {
            setFlashMessage('success', 'Successfully enrolled! You will receive a confirmation email shortly.');
        } else {
            setFlashMessage('error', 'Unable to enroll. Class may be full or an error occurred.');
        }
        
        redirect(BASE_URL . 'index.php?page=teaching&action=detail&id=' . $classId);
    }
}
