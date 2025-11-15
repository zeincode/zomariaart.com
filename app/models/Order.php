<?php
/**
 * Order Model
 */
class Order {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Get all orders
     */
    public function getAll($filters = []) {
        $sql = "SELECT * FROM orders";
        $params = [];
        $where = [];
        
        if (!empty($filters['status'])) {
            $where[] = "order_status = :status";
            $params[':status'] = $filters['status'];
        }
        
        if (!empty($filters['payment_status'])) {
            $where[] = "payment_status = :payment_status";
            $params[':payment_status'] = $filters['payment_status'];
        }
        
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    /**
     * Get order by ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    /**
     * Get order by order number
     */
    public function getByOrderNumber($orderNumber) {
        $sql = "SELECT * FROM orders WHERE order_number = :order_number";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':order_number' => $orderNumber]);
        return $stmt->fetch();
    }
    
    /**
     * Get orders by customer email
     */
    public function getByCustomerEmail($email) {
        $sql = "SELECT * FROM orders WHERE customer_email = :email ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetchAll();
    }
    
    /**
     * Get order items
     */
    public function getItems($orderId) {
        $sql = "SELECT * FROM order_items WHERE order_id = :order_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':order_id' => $orderId]);
        return $stmt->fetchAll();
    }
    
    /**
     * Create new order
     */
    public function create($data) {
        try {
            $this->db->beginTransaction();
            
            // Insert order
            $sql = "INSERT INTO orders (order_number, customer_name, customer_email, customer_phone, 
                    shipping_address, billing_address, subtotal, tax, shipping_cost, total, 
                    payment_method, payment_status, order_status, notes) 
                    VALUES (:order_number, :customer_name, :customer_email, :customer_phone, 
                    :shipping_address, :billing_address, :subtotal, :tax, :shipping_cost, :total, 
                    :payment_method, :payment_status, :order_status, :notes)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':order_number' => $data['order_number'],
                ':customer_name' => $data['customer_name'],
                ':customer_email' => $data['customer_email'],
                ':customer_phone' => $data['customer_phone'] ?? null,
                ':shipping_address' => $data['shipping_address'],
                ':billing_address' => $data['billing_address'] ?? $data['shipping_address'],
                ':subtotal' => $data['subtotal'],
                ':tax' => $data['tax'] ?? 0,
                ':shipping_cost' => $data['shipping_cost'] ?? 0,
                ':total' => $data['total'],
                ':payment_method' => $data['payment_method'] ?? 'pending',
                ':payment_status' => 'pending',
                ':order_status' => 'pending',
                ':notes' => $data['notes'] ?? null
            ]);
            
            $orderId = $this->db->lastInsertId();
            
            // Insert order items
            $itemSql = "INSERT INTO order_items (order_id, product_id, product_title, quantity, unit_price, selected_options, subtotal) 
                        VALUES (:order_id, :product_id, :product_title, :quantity, :unit_price, :selected_options, :subtotal)";
            $itemStmt = $this->db->prepare($itemSql);
            
            foreach ($data['items'] as $item) {
                $itemStmt->execute([
                    ':order_id' => $orderId,
                    ':product_id' => $item['product_id'],
                    ':product_title' => $item['product_title'],
                    ':quantity' => $item['quantity'],
                    ':unit_price' => $item['unit_price'],
                    ':selected_options' => json_encode($item['selected_options'] ?? []),
                    ':subtotal' => $item['subtotal']
                ]);
            }
            
            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
    
    /**
     * Update order status
     */
    public function updateStatus($id, $status) {
        $sql = "UPDATE orders SET order_status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id, ':status' => $status]);
    }
    
    /**
     * Update payment status
     */
    public function updatePaymentStatus($id, $status) {
        $sql = "UPDATE orders SET payment_status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id, ':status' => $status]);
    }
    
    /**
     * Get sales statistics
     */
    public function getSalesStats($month = null, $year = null) {
        $sql = "SELECT 
                COUNT(*) as total_orders,
                SUM(total) as total_revenue,
                AVG(total) as average_order
                FROM orders 
                WHERE payment_status = 'completed'";
        
        $params = [];
        
        if ($month && $year) {
            $sql .= " AND MONTH(created_at) = :month AND YEAR(created_at) = :year";
            $params[':month'] = $month;
            $params[':year'] = $year;
        } elseif ($year) {
            $sql .= " AND YEAR(created_at) = :year";
            $params[':year'] = $year;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }
}
