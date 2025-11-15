<h1>Payment Management</h1>

<div class="payment-stats">
    <div class="stat-card">
        <h3>Total Revenue</h3>
        <p class="stat-number"><?php echo formatPrice($data['stats']['total_revenue']); ?></p>
        <p class="stat-label">From completed payments</p>
    </div>
    
    <div class="stat-card">
        <h3>Completed Payments</h3>
        <p class="stat-number"><?php echo $data['stats']['completed_payments']; ?></p>
        <p class="stat-label">Successful transactions</p>
    </div>
    
    <div class="stat-card warning">
        <h3>Pending Payments</h3>
        <p class="stat-number"><?php echo $data['stats']['pending_payments']; ?></p>
        <p class="stat-label">Awaiting confirmation</p>
    </div>
    
    <div class="stat-card danger">
        <h3>Failed Payments</h3>
        <p class="stat-number"><?php echo $data['stats']['failed_payments']; ?></p>
        <p class="stat-label">Requires attention</p>
    </div>
</div>

<div class="payment-filters">
    <h2>All Transactions</h2>
    <div class="filter-buttons">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="pending">Pending</button>
        <button class="filter-btn" data-filter="completed">Completed</button>
        <button class="filter-btn" data-filter="failed">Failed</button>
        <button class="filter-btn" data-filter="refunded">Refunded</button>
    </div>
</div>

<?php if (!empty($data['orders'])): ?>
    <table class="data-table" id="paymentsTable">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['orders'] as $order): ?>
                <tr data-payment-status="<?php echo $order['payment_status']; ?>">
                    <td>
                        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=viewOrder&id=<?php echo $order['id']; ?>">
                            <?php echo e($order['order_number']); ?>
                        </a>
                    </td>
                    <td>
                        <?php echo e($order['customer_name']); ?>
                        <br>
                        <small><?php echo e($order['customer_email']); ?></small>
                    </td>
                    <td><?php echo formatPrice($order['total']); ?></td>
                    <td><?php echo e($order['payment_method'] ?? 'N/A'); ?></td>
                    <td>
                        <span class="status-badge status-<?php echo $order['payment_status']; ?>">
                            <?php echo ucfirst($order['payment_status']); ?>
                        </span>
                    </td>
                    <td>
                        <span class="status-badge status-<?php echo $order['order_status']; ?>">
                            <?php echo ucfirst($order['order_status']); ?>
                        </span>
                    </td>
                    <td><?php echo formatDate($order['created_at'], 'M j, Y'); ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=viewOrder&id=<?php echo $order['id']; ?>" class="btn-action">
                            View
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No payment records found.</p>
<?php endif; ?>

<style>
.payment-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-left: 4px solid #28a745;
}

.stat-card.warning {
    border-left-color: #ffc107;
}

.stat-card.danger {
    border-left-color: #dc3545;
}

.stat-card h3 {
    margin: 0 0 1rem 0;
    font-size: 0.9rem;
    color: #6c757d;
    text-transform: uppercase;
    font-weight: 600;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    margin: 0;
    color: #333;
}

.stat-label {
    margin: 0.5rem 0 0 0;
    font-size: 0.85rem;
    color: #6c757d;
}

.payment-filters {
    margin-bottom: 2rem;
}

.payment-filters h2 {
    margin-bottom: 1rem;
}

.filter-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 0.5rem 1rem;
    border: 1px solid #dee2e6;
    background: white;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.filter-btn:hover {
    background: #f8f9fa;
}

.filter-btn.active {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.data-table th,
.data-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.data-table th {
    background: #f8f9fa;
    font-weight: 600;
    position: sticky;
    top: 0;
}

.data-table tbody tr:hover {
    background: #f8f9fa;
}

.data-table small {
    color: #6c757d;
    font-size: 0.85rem;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
    font-size: 0.85rem;
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

.status-failed,
.status-cancelled {
    color: #721c24;
    background: #f8d7da;
}

.status-refunded {
    color: #383d41;
    background: #e2e3e5;
}

.btn-action {
    padding: 0.375rem 0.75rem;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-size: 0.875rem;
    display: inline-block;
}

.btn-action:hover {
    background: #0056b3;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const tableRows = document.querySelectorAll('#paymentsTable tbody tr');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active state
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            // Filter rows
            tableRows.forEach(row => {
                const paymentStatus = row.getAttribute('data-payment-status');
                
                if (filter === 'all' || paymentStatus === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});
</script>
