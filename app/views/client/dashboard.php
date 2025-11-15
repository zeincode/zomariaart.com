<div class="client-area">
    <h1>My Account</h1>
    
    <div class="client-welcome">
        <p>Welcome back, <strong><?php echo e($data['user']['username']); ?></strong>!</p>
    </div>
    
    <div class="client-nav">
        <a href="<?php echo BASE_URL; ?>index.php?page=client&action=profile" class="btn btn-secondary">My Profile</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=client&action=orders" class="btn btn-secondary">My Orders</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=client&action=classes" class="btn btn-secondary">My Classes</a>
    </div>
    
    <div class="dashboard-sections">
        <section class="dashboard-section">
            <h2>Recent Orders</h2>
            <?php if (!empty($data['recentOrders'])): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['recentOrders'] as $order): ?>
                            <tr>
                                <td><?php echo e($order['order_number']); ?></td>
                                <td><?php echo formatDate($order['created_at']); ?></td>
                                <td><?php echo formatPrice($order['total']); ?></td>
                                <td><span class="status-<?php echo $order['order_status']; ?>"><?php echo ucfirst($order['order_status']); ?></span></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>index.php?page=client&action=viewOrder&id=<?php echo $order['id']; ?>">View Details</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p><a href="<?php echo BASE_URL; ?>index.php?page=client&action=orders">View all orders</a></p>
            <?php else: ?>
                <p>You haven't placed any orders yet.</p>
                <p><a href="<?php echo BASE_URL; ?>index.php?page=gallery">Browse our gallery</a></p>
            <?php endif; ?>
        </section>
        
        <section class="dashboard-section">
            <h2>My Classes</h2>
            <?php if (!empty($data['enrollments'])): ?>
                <div class="enrollment-list">
                    <?php foreach (array_slice($data['enrollments'], 0, 3) as $enrollment): ?>
                        <div class="enrollment-item">
                            <h4><?php echo e($enrollment['title']); ?></h4>
                            <p><strong>Date:</strong> <?php echo formatDate($enrollment['date']); ?> at <?php echo date('g:i A', strtotime($enrollment['time'])); ?></p>
                            <p><strong>Location:</strong> <?php echo e($enrollment['location']); ?></p>
                            <p><strong>Payment Status:</strong> <span class="status-<?php echo $enrollment['payment_status']; ?>"><?php echo ucfirst($enrollment['payment_status']); ?></span></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p><a href="<?php echo BASE_URL; ?>index.php?page=client&action=classes">View all my classes</a></p>
            <?php else: ?>
                <p>You are not enrolled in any classes yet.</p>
                <p><a href="<?php echo BASE_URL; ?>index.php?page=teaching">Browse available classes</a></p>
            <?php endif; ?>
        </section>
    </div>
</div>

<style>
.client-area {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.client-welcome {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
}

.client-nav {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.dashboard-sections {
    display: grid;
    gap: 2rem;
}

.dashboard-section {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.dashboard-section h2 {
    margin-top: 0;
    margin-bottom: 1.5rem;
    color: #333;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1rem;
}

.data-table th,
.data-table td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.data-table th {
    background: #f8f9fa;
    font-weight: 600;
}

.enrollment-list {
    display: grid;
    gap: 1rem;
}

.enrollment-item {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 4px;
}

.enrollment-item h4 {
    margin-top: 0;
    margin-bottom: 0.5rem;
}

.enrollment-item p {
    margin: 0.25rem 0;
}

.status-pending {
    color: #856404;
    background: #fff3cd;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
}

.status-completed,
.status-delivered {
    color: #155724;
    background: #d4edda;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
}

.status-processing,
.status-shipped {
    color: #004085;
    background: #cce5ff;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
}

.status-cancelled {
    color: #721c24;
    background: #f8d7da;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
}

.btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}
</style>
