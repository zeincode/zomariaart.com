<div class="page-header">
    <div class="container">
        <h1>Order Confirmation</h1>
    </div>
</div>

<div class="order-success container">
    <div class="success-message">
        <div class="success-icon">✓</div>
        <h2>Thank You for Your Order!</h2>
        <p>Your order has been received and is being processed.</p>
    </div>
    
    <div class="order-details">
        <h3>Order Details</h3>
        
        <div class="order-info-grid">
            <div class="info-item">
                <strong>Order Number:</strong>
                <span><?php echo e($data['order']['order_number']); ?></span>
            </div>
            
            <div class="info-item">
                <strong>Order Date:</strong>
                <span><?php echo formatDate($data['order']['created_at']); ?></span>
            </div>
            
            <div class="info-item">
                <strong>Total:</strong>
                <span><?php echo formatPrice($data['order']['total']); ?></span>
            </div>
            
            <div class="info-item">
                <strong>Payment Status:</strong>
                <span class="status-<?php echo $data['order']['payment_status']; ?>">
                    <?php echo ucfirst($data['order']['payment_status']); ?>
                </span>
            </div>
        </div>
        
        <div class="order-items">
            <h4>Items Ordered:</h4>
            <?php foreach ($data['orderItems'] as $item): ?>
                <div class="order-item">
                    <span><?php echo e($item['product_title']); ?> × <?php echo $item['quantity']; ?></span>
                    <span><?php echo formatPrice($item['subtotal']); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="order-address">
            <h4>Shipping Address:</h4>
            <p><?php echo nl2br(e($data['order']['shipping_address'])); ?></p>
        </div>
    </div>
    
    <div class="success-actions">
        <p>A confirmation email has been sent to <?php echo e($data['order']['customer_email']); ?></p>
        <a href="<?php echo BASE_URL; ?>index.php?page=home" class="btn btn-primary">Return to Home</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=gallery" class="btn btn-secondary">Continue Shopping</a>
    </div>
</div>
