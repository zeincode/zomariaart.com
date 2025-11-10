<?php
/**
 * Product Model
 */
class Product {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Get all products with optional filters
     */
    public function getAll($filters = []) {
        $sql = "SELECT * FROM products WHERE status = 'active'";
        $params = [];
        
        if (!empty($filters['category'])) {
            $sql .= " AND category = :category";
            $params[':category'] = $filters['category'];
        }
        
        if (!empty($filters['medium'])) {
            $sql .= " AND medium = :medium";
            $params[':medium'] = $filters['medium'];
        }
        
        if (!empty($filters['search'])) {
            $sql .= " AND (title LIKE :search OR description LIKE :search)";
            $params[':search'] = '%' . $filters['search'] . '%';
        }
        
        if (!empty($filters['min_price'])) {
            $sql .= " AND base_price >= :min_price";
            $params[':min_price'] = $filters['min_price'];
        }
        
        if (!empty($filters['max_price'])) {
            $sql .= " AND base_price <= :max_price";
            $params[':max_price'] = $filters['max_price'];
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    /**
     * Get featured products
     */
    public function getFeatured($limit = 6) {
        $sql = "SELECT * FROM products WHERE featured = 1 AND status = 'active' ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Get product by ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    /**
     * Get product options
     */
    public function getOptions($productId) {
        $sql = "SELECT * FROM product_options WHERE product_id = :product_id ORDER BY option_type, option_value";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':product_id' => $productId]);
        
        $options = [];
        foreach ($stmt->fetchAll() as $option) {
            $options[$option['option_type']][] = $option;
        }
        return $options;
    }
    
    /**
     * Create new product
     */
    public function create($data) {
        $sql = "INSERT INTO products (title, description, base_price, category, medium, featured, stock_quantity, image_url, thumbnail_url, status) 
                VALUES (:title, :description, :base_price, :category, :medium, :featured, :stock_quantity, :image_url, :thumbnail_url, :status)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':base_price' => $data['base_price'],
            ':category' => $data['category'],
            ':medium' => $data['medium'],
            ':featured' => $data['featured'] ?? 0,
            ':stock_quantity' => $data['stock_quantity'] ?? 0,
            ':image_url' => $data['image_url'] ?? null,
            ':thumbnail_url' => $data['thumbnail_url'] ?? null,
            ':status' => $data['status'] ?? 'active'
        ]);
    }
    
    /**
     * Update product
     */
    public function update($id, $data) {
        $sql = "UPDATE products SET 
                title = :title, 
                description = :description, 
                base_price = :base_price, 
                category = :category, 
                medium = :medium, 
                featured = :featured, 
                stock_quantity = :stock_quantity, 
                status = :status 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':base_price' => $data['base_price'],
            ':category' => $data['category'],
            ':medium' => $data['medium'],
            ':featured' => $data['featured'] ?? 0,
            ':stock_quantity' => $data['stock_quantity'] ?? 0,
            ':status' => $data['status'] ?? 'active'
        ]);
    }
    
    /**
     * Delete product
     */
    public function delete($id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    
    /**
     * Get all categories
     */
    public function getCategories() {
        $sql = "SELECT DISTINCT category FROM products WHERE category IS NOT NULL AND status = 'active' ORDER BY category";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    /**
     * Get all media types
     */
    public function getMediaTypes() {
        $sql = "SELECT DISTINCT medium FROM products WHERE medium IS NOT NULL AND status = 'active' ORDER BY medium";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
