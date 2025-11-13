<h1>Admin Dashboard</h1>

<div class="dashboard-stats">
    <div class="stat-card">
        <h3>Total Revenue</h3>
        <p class="stat-number"><?php echo formatPrice($data['stats']['total_revenue'] ?? 0); ?></p>
    </div>
    
    <div class="stat-card">
        <h3>Total Orders</h3>
        <p class="stat-number"><?php echo $data['stats']['total_orders'] ?? 0; ?></p>
    </div>
    
    <div class="stat-card">
        <h3>Average Order</h3>
        <p class="stat-number"><?php echo formatPrice($data['stats']['average_order'] ?? 0); ?></p>
    </div>
</div>

<div class="dashboard-sections">
    <section class="dashboard-section">
        <h2>Recent Orders</h2>
        <?php if (!empty($data['recentOrders'])): ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($data['recentOrders'], 0, 10) as $order): ?>
                        <tr>
                            <td>
                                <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=viewOrder&id=<?php echo $order['id']; ?>">
                                    <?php echo e($order['order_number']); ?>
                                </a>
                            </td>
                            <td><?php echo e($order['customer_name']); ?></td>
                            <td><?php echo formatPrice($order['total']); ?></td>
                            <td><span class="status-<?php echo $order['order_status']; ?>"><?php echo ucfirst($order['order_status']); ?></span></td>
                            <td><?php echo formatDate($order['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No recent orders.</p>
        <?php endif; ?>
    </section>
    
    <section class="dashboard-section">
        <h2>Upcoming Classes</h2>
        <?php if (!empty($data['upcomingClasses'])): ?>
            <div class="class-list">
                <?php foreach ($data['upcomingClasses'] as $class): ?>
                    <div class="class-item">
                        <h4><?php echo e($class['title']); ?></h4>
                        <p><?php echo formatDate($class['date']); ?> at <?php echo date('g:i A', strtotime($class['time'])); ?></p>
                        <p><?php echo $class['enrolled']; ?> / <?php echo $class['capacity']; ?> enrolled</p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No upcoming classes.</p>
        <?php endif; ?>
    </section>
</div>
