<h1>Order Details</h1>

<div class="order-detail-page">
    <div class="order-info-card">
        <h2>Order #<?php echo e($data['order']['order_number']); ?></h2>
        
        <div class="info-grid">
            <div class="info-item">
                <strong>Order Date:</strong>
                <span><?php echo formatDate($data['order']['created_at'], 'F j, Y g:i A'); ?></span>
            </div>
            
            <div class="info-item">
                <strong>Payment Status:</strong>
                <span class="status-<?php echo $data['order']['payment_status']; ?>">
                    <?php echo ucfirst($data['order']['payment_status']); ?>
                </span>
            </div>
            
            <div class="info-item">
                <strong>Order Status:</strong>
                <span class="status-<?php echo $data['order']['order_status']; ?>">
                    <?php echo ucfirst($data['order']['order_status']); ?>
                </span>
            </div>
            
            <div class="info-item">
                <strong>Total:</strong>
                <span><?php echo formatPrice($data['order']['total']); ?></span>
            </div>
        </div>
    </div>
    
    <div class="order-customer-card">
        <h3>Customer Information</h3>
        <p><strong>Name:</strong> <?php echo e($data['order']['customer_name']); ?></p>
        <p><strong>Email:</strong> <?php echo e($data['order']['customer_email']); ?></p>
        <?php if ($data['order']['customer_phone']): ?>
            <p><strong>Phone:</strong> <?php echo e($data['order']['customer_phone']); ?></p>
        <?php endif; ?>
        
        <h4>Shipping Address</h4>
        <p><?php echo nl2br(e($data['order']['shipping_address'])); ?></p>
    </div>
    
    <div class="order-items-card">
        <h3>Order Items</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['orderItems'] as $item): ?>
                    <tr>
                        <td><?php echo e($item['product_title']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo formatPrice($item['unit_price']); ?></td>
                        <td><?php echo formatPrice($item['subtotal']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Subtotal:</strong></td>
                    <td><?php echo formatPrice($data['order']['subtotal']); ?></td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Tax:</strong></td>
                    <td><?php echo formatPrice($data['order']['tax']); ?></td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Shipping:</strong></td>
                    <td><?php echo formatPrice($data['order']['shipping_cost']); ?></td>
                </tr>
                <tr class="total-row">
                    <td colspan="3"><strong>Total:</strong></td>
                    <td><strong><?php echo formatPrice($data['order']['total']); ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <div class="order-actions-card">
        <h3>Update Order Status</h3>
        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=admin&action=updateOrderStatus">
            <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
            <input type="hidden" name="order_id" value="<?php echo $data['order']['id']; ?>">
            
            <div class="form-group">
                <label for="status">Order Status:</label>
                <select id="status" name="status">
                    <option value="pending" <?php echo $data['order']['order_status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="processing" <?php echo $data['order']['order_status'] === 'processing' ? 'selected' : ''; ?>>Processing</option>
                    <option value="shipped" <?php echo $data['order']['order_status'] === 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                    <option value="delivered" <?php echo $data['order']['order_status'] === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                    <option value="cancelled" <?php echo $data['order']['order_status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Order Status</button>
        </form>
        
        <h3 style="margin-top: 2rem;">Update Payment Status</h3>
        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=admin&action=updatePaymentStatus">
            <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
            <input type="hidden" name="order_id" value="<?php echo $data['order']['id']; ?>">
            
            <div class="form-group">
                <label for="payment_status">Payment Status:</label>
                <select id="payment_status" name="payment_status">
                    <option value="pending" <?php echo $data['order']['payment_status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="completed" <?php echo $data['order']['payment_status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                    <option value="failed" <?php echo $data['order']['payment_status'] === 'failed' ? 'selected' : ''; ?>>Failed</option>
                    <option value="refunded" <?php echo $data['order']['payment_status'] === 'refunded' ? 'selected' : ''; ?>>Refunded</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Payment Status</button>
        </form>
    </div>
    
    <div class="order-navigation">
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=orders" class="btn btn-secondary">← Back to Orders</a>
    </div>
</div>

<style>
.order-detail-page {
    display: grid;
    gap: 1.5rem;
}

.order-info-card,
.order-customer-card,
.order-items-card,
.order-actions-card {
    background: #fff;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.total-row {
    font-size: 1.2rem;
    border-top: 2px solid #2c3e50;
}
</style>
