<div class="client-area">
    <h1>Order Details</h1>
    
    <nav class="breadcrumb">
        <a href="<?php echo BASE_URL; ?>index.php?page=client">My Account</a> &raquo; 
        <a href="<?php echo BASE_URL; ?>index.php?page=client&action=orders">My Orders</a> &raquo; 
        Order #<?php echo e($data['order']['order_number']); ?>
    </nav>
    
    <div class="order-detail-container">
        <div class="order-info-section">
            <h2>Order #<?php echo e($data['order']['order_number']); ?></h2>
            <p>Placed on <?php echo formatDate($data['order']['created_at'], 'F j, Y g:i A'); ?></p>
            
            <div class="status-section">
                <p><strong>Order Status:</strong> <span class="status-badge status-<?php echo $data['order']['order_status']; ?>"><?php echo ucfirst($data['order']['order_status']); ?></span></p>
                <p><strong>Payment Status:</strong> <span class="status-badge status-<?php echo $data['order']['payment_status']; ?>"><?php echo ucfirst($data['order']['payment_status']); ?></span></p>
            </div>
        </div>
        
        <div class="order-items-section">
            <h3>Order Items</h3>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Options</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['orderItems'] as $item): ?>
                        <tr>
                            <td><?php echo e($item['product_title']); ?></td>
                            <td>
                                <?php 
                                $options = json_decode($item['selected_options'], true);
                                if ($options && is_array($options)) {
                                    echo implode(', ', array_map(function($k, $v) {
                                        return ucfirst($k) . ': ' . e($v);
                                    }, array_keys($options), $options));
                                } else {
                                    echo 'Standard';
                                }
                                ?>
                            </td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo formatPrice($item['unit_price']); ?></td>
                            <td><?php echo formatPrice($item['subtotal']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="order-totals">
            <div class="totals-row">
                <span>Subtotal:</span>
                <span><?php echo formatPrice($data['order']['subtotal']); ?></span>
            </div>
            <?php if ($data['order']['tax'] > 0): ?>
            <div class="totals-row">
                <span>Tax:</span>
                <span><?php echo formatPrice($data['order']['tax']); ?></span>
            </div>
            <?php endif; ?>
            <?php if ($data['order']['shipping_cost'] > 0): ?>
            <div class="totals-row">
                <span>Shipping:</span>
                <span><?php echo formatPrice($data['order']['shipping_cost']); ?></span>
            </div>
            <?php endif; ?>
            <div class="totals-row total">
                <span><strong>Total:</strong></span>
                <span><strong><?php echo formatPrice($data['order']['total']); ?></strong></span>
            </div>
        </div>
        
        <div class="order-addresses">
            <div class="address-column">
                <h3>Shipping Address</h3>
                <div class="address-content">
                    <?php echo nl2br(e($data['order']['shipping_address'])); ?>
                </div>
            </div>
            
            <div class="address-column">
                <h3>Billing Address</h3>
                <div class="address-content">
                    <?php 
                    $billingAddress = $data['order']['billing_address'] ?? $data['order']['shipping_address'];
                    echo nl2br(e($billingAddress)); 
                    ?>
                </div>
            </div>
        </div>
        
        <div class="order-contact">
            <h3>Contact Information</h3>
            <p><strong>Email:</strong> <?php echo e($data['order']['customer_email']); ?></p>
            <?php if (!empty($data['order']['customer_phone'])): ?>
            <p><strong>Phone:</strong> <?php echo e($data['order']['customer_phone']); ?></p>
            <?php endif; ?>
        </div>
        
        <?php if (!empty($data['order']['notes'])): ?>
        <div class="order-notes">
            <h3>Order Notes</h3>
            <p><?php echo nl2br(e($data['order']['notes'])); ?></p>
        </div>
        <?php endif; ?>
        
        <div class="order-actions">
            <a href="<?php echo BASE_URL; ?>index.php?page=client&action=orders" class="btn btn-secondary">Back to Orders</a>
            <a href="<?php echo BASE_URL; ?>index.php?page=contact" class="btn btn-primary">Contact Support</a>
        </div>
    </div>
</div>

<style>
.client-area {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.breadcrumb {
    margin-bottom: 1.5rem;
    color: #6c757d;
}

.breadcrumb a {
    color: #007bff;
    text-decoration: none;
}

.order-detail-container {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.order-info-section {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid #dee2e6;
}

.order-info-section h2 {
    margin: 0 0 0.5rem 0;
}

.status-section {
    margin-top: 1rem;
}

.status-section p {
    margin: 0.5rem 0;
}

.status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 4px;
    font-size: 0.875rem;
    font-weight: 500;
}

.status-pending {
    color: #856404;
    background: #fff3cd;
}

.status-completed,
.status-delivered {
    color: #155724;
    background: #d4edda;
}

.status-processing,
.status-shipped {
    color: #004085;
    background: #cce5ff;
}

.status-cancelled,
.status-failed {
    color: #721c24;
    background: #f8d7da;
}

.order-items-section {
    margin-bottom: 2rem;
}

.items-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.items-table th,
.items-table td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.items-table th {
    background: #f8f9fa;
    font-weight: 600;
}

.order-totals {
    max-width: 400px;
    margin-left: auto;
    margin-bottom: 2rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 4px;
}

.totals-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
}

.totals-row.total {
    border-top: 2px solid #333;
    margin-top: 0.5rem;
    padding-top: 1rem;
    font-size: 1.1rem;
}

.order-addresses {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.address-column h3 {
    margin-top: 0;
}

.address-content {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 4px;
}

.order-contact,
.order-notes {
    margin-bottom: 2rem;
}

.order-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.btn-primary {
    background: #007bff;
    color: white;
}

.btn-primary:hover {
    background: #0056b3;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}
</style>
