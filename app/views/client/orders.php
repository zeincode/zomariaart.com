<div class="client-area">
    <h1>My Orders</h1>
    
    <nav class="breadcrumb">
        <a href="<?php echo BASE_URL; ?>index.php?page=client">My Account</a> &raquo; My Orders
    </nav>
    
    <?php if (!empty($data['orders'])): ?>
        <div class="orders-list">
            <?php foreach ($data['orders'] as $order): ?>
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <h3>Order #<?php echo e($order['order_number']); ?></h3>
                            <p class="order-date">Placed on <?php echo formatDate($order['created_at'], 'F j, Y g:i A'); ?></p>
                        </div>
                        <div class="order-status-section">
                            <span class="status-badge status-<?php echo $order['order_status']; ?>">
                                <?php echo ucfirst($order['order_status']); ?>
                            </span>
                            <span class="status-badge status-<?php echo $order['payment_status']; ?>">
                                Payment: <?php echo ucfirst($order['payment_status']); ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="order-summary">
                        <p><strong>Total:</strong> <?php echo formatPrice($order['total']); ?></p>
                        <p><strong>Payment Method:</strong> <?php echo e($order['payment_method'] ?? 'N/A'); ?></p>
                    </div>
                    
                    <div class="order-actions">
                        <a href="<?php echo BASE_URL; ?>index.php?page=client&action=viewOrder&id=<?php echo $order['id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <p>You haven't placed any orders yet.</p>
            <a href="<?php echo BASE_URL; ?>index.php?page=gallery" class="btn btn-primary">Start Shopping</a>
        </div>
    <?php endif; ?>
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

.orders-list {
    display: grid;
    gap: 1.5rem;
}

.order-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #dee2e6;
    flex-wrap: wrap;
    gap: 1rem;
}

.order-header h3 {
    margin: 0 0 0.5rem 0;
}

.order-date {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

.order-status-section {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
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

.order-summary {
    margin-bottom: 1rem;
}

.order-summary p {
    margin: 0.5rem 0;
}

.order-actions {
    margin-top: 1rem;
}

.btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #007bff;
    color: white;
}

.btn-primary:hover {
    background: #0056b3;
}

.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-state p {
    font-size: 1.2rem;
    color: #6c757d;
    margin-bottom: 1.5rem;
}
</style>
