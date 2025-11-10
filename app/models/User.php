<?php
/**
 * User Model
 */
class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Authenticate user
     */
    public function authenticate($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username OR email = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':username' => $username]);
        
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        
        return false;
    }
    
    /**
     * Get user by ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    /**
     * Create new user
     */
    public function create($data) {
        $sql = "INSERT INTO users (username, email, password_hash, role) 
                VALUES (:username, :email, :password_hash, :role)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':role' => $data['role'] ?? 'customer'
        ]);
    }
    
    /**
     * Update user
     */
    public function update($id, $data) {
        $sql = "UPDATE users SET username = :username, email = :email";
        $params = [
            ':id' => $id,
            ':username' => $data['username'],
            ':email' => $data['email']
        ];
        
        if (!empty($data['password'])) {
            $sql .= ", password_hash = :password_hash";
            $params[':password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    
    /**
     * Subscribe to newsletter
     */
    public function subscribeNewsletter($email) {
        $sql = "INSERT INTO newsletter_subscribers (email) VALUES (:email) 
                ON DUPLICATE KEY UPDATE status = 'active'";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':email' => $email]);
    }
    
    /**
     * Save contact inquiry
     */
    public function saveContactInquiry($data) {
        $sql = "INSERT INTO contact_inquiries (name, email, subject, message) 
                VALUES (:name, :email, :subject, :message)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':subject' => $data['subject'] ?? 'General Inquiry',
            ':message' => $data['message']
        ]);
    }
}
