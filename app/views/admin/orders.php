<h1>Order Management</h1>

<?php if (!empty($data['orders'])): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['orders'] as $order): ?>
                <tr>
                    <td><?php echo e($order['order_number']); ?></td>
                    <td><?php echo e($order['customer_name']); ?></td>
                    <td><?php echo formatPrice($order['total']); ?></td>
                    <td><span class="status-<?php echo $order['payment_status']; ?>"><?php echo ucfirst($order['payment_status']); ?></span></td>
                    <td><span class="status-<?php echo $order['order_status']; ?>"><?php echo ucfirst($order['order_status']); ?></span></td>
                    <td><?php echo formatDate($order['created_at']); ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=viewOrder&id=<?php echo $order['id']; ?>">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>
