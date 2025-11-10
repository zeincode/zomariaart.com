<?php
/**
 * Class Model (named ClassModel to avoid PHP reserved keyword conflict)
 */
class ClassModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Get all classes
     */
    public function getAll($filters = []) {
        $sql = "SELECT * FROM classes";
        $params = [];
        $where = [];
        
        if (!empty($filters['status'])) {
            $where[] = "status = :status";
            $params[':status'] = $filters['status'];
        }
        
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        
        $sql .= " ORDER BY date ASC, time ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    /**
     * Get upcoming classes
     */
    public function getUpcoming($limit = null) {
        $sql = "SELECT * FROM classes WHERE status = 'upcoming' AND date >= CURDATE() ORDER BY date ASC, time ASC";
        
        if ($limit) {
            $sql .= " LIMIT :limit";
        }
        
        $stmt = $this->db->prepare($sql);
        
        if ($limit) {
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Get class by ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM classes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    /**
     * Get class enrollments
     */
    public function getEnrollments($classId) {
        $sql = "SELECT * FROM class_enrollments WHERE class_id = :class_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':class_id' => $classId]);
        return $stmt->fetchAll();
    }
    
    /**
     * Create new class
     */
    public function create($data) {
        $sql = "INSERT INTO classes (title, description, syllabus, required_materials, date, time, location, price, capacity, status, image_url) 
                VALUES (:title, :description, :syllabus, :required_materials, :date, :time, :location, :price, :capacity, :status, :image_url)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':syllabus' => $data['syllabus'] ?? null,
            ':required_materials' => $data['required_materials'] ?? null,
            ':date' => $data['date'],
            ':time' => $data['time'],
            ':location' => $data['location'],
            ':price' => $data['price'],
            ':capacity' => $data['capacity'],
            ':status' => $data['status'] ?? 'upcoming',
            ':image_url' => $data['image_url'] ?? null
        ]);
    }
    
    /**
     * Update class
     */
    public function update($id, $data) {
        $sql = "UPDATE classes SET 
                title = :title, 
                description = :description, 
                syllabus = :syllabus, 
                required_materials = :required_materials, 
                date = :date, 
                time = :time, 
                location = :location, 
                price = :price, 
                capacity = :capacity, 
                status = :status 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':syllabus' => $data['syllabus'] ?? null,
            ':required_materials' => $data['required_materials'] ?? null,
            ':date' => $data['date'],
            ':time' => $data['time'],
            ':location' => $data['location'],
            ':price' => $data['price'],
            ':capacity' => $data['capacity'],
            ':status' => $data['status'] ?? 'upcoming'
        ]);
    }
    
    /**
     * Delete class
     */
    public function delete($id) {
        $sql = "DELETE FROM classes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    
    /**
     * Enroll student in class
     */
    public function enroll($data) {
        try {
            $this->db->beginTransaction();
            
            // Check if class is full
            $class = $this->getById($data['class_id']);
            if ($class['enrolled'] >= $class['capacity']) {
                throw new Exception('Class is full');
            }
            
            // Insert enrollment
            $sql = "INSERT INTO class_enrollments (class_id, student_name, student_email, student_phone, payment_status, notes) 
                    VALUES (:class_id, :student_name, :student_email, :student_phone, :payment_status, :notes)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':class_id' => $data['class_id'],
                ':student_name' => $data['student_name'],
                ':student_email' => $data['student_email'],
                ':student_phone' => $data['student_phone'] ?? null,
                ':payment_status' => 'pending',
                ':notes' => $data['notes'] ?? null
            ]);
            
            // Update enrolled count
            $updateSql = "UPDATE classes SET enrolled = enrolled + 1 WHERE id = :class_id";
            $updateStmt = $this->db->prepare($updateSql);
            $updateStmt->execute([':class_id' => $data['class_id']]);
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
    
    /**
     * Get testimonials
     */
    public function getTestimonials($approved = true) {
        $sql = "SELECT t.*, c.title as class_title 
                FROM testimonials t 
                LEFT JOIN classes c ON t.class_id = c.id";
        
        if ($approved) {
            $sql .= " WHERE t.status = 'approved'";
        }
        
        $sql .= " ORDER BY t.created_at DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
