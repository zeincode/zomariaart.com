<div class="client-area">
    <h1>My Classes</h1>
    
    <nav class="breadcrumb">
        <a href="<?php echo BASE_URL; ?>index.php?page=client">My Account</a> &raquo; My Classes
    </nav>
    
    <?php if (!empty($data['enrollments'])): ?>
        <div class="enrollments-list">
            <?php foreach ($data['enrollments'] as $enrollment): ?>
                <div class="enrollment-card">
                    <div class="enrollment-header">
                        <h3><?php echo e($enrollment['title']); ?></h3>
                        <span class="status-badge status-<?php echo $enrollment['payment_status']; ?>">
                            <?php echo ucfirst($enrollment['payment_status']); ?>
                        </span>
                    </div>
                    
                    <div class="enrollment-details">
                        <div class="detail-row">
                            <strong>Date:</strong> <?php echo formatDate($enrollment['date']); ?>
                        </div>
                        <div class="detail-row">
                            <strong>Time:</strong> <?php echo date('g:i A', strtotime($enrollment['time'])); ?>
                        </div>
                        <div class="detail-row">
                            <strong>Location:</strong> <?php echo e($enrollment['location']); ?>
                        </div>
                        <div class="detail-row">
                            <strong>Price:</strong> <?php echo formatPrice($enrollment['price']); ?>
                        </div>
                    </div>
                    
                    <?php if (!empty($enrollment['description'])): ?>
                    <div class="enrollment-description">
                        <p><?php echo nl2br(e($enrollment['description'])); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <div class="enrollment-footer">
                        <p class="enrollment-date">Enrolled on <?php echo formatDate($enrollment['created_at']); ?></p>
                        <?php if (!empty($enrollment['notes'])): ?>
                        <p class="enrollment-notes"><strong>Notes:</strong> <?php echo e($enrollment['notes']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <p>You are not enrolled in any classes yet.</p>
            <a href="<?php echo BASE_URL; ?>index.php?page=teaching" class="btn btn-primary">Browse Available Classes</a>
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

.enrollments-list {
    display: grid;
    gap: 1.5rem;
}

.enrollment-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.enrollment-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #dee2e6;
    gap: 1rem;
}

.enrollment-header h3 {
    margin: 0;
    flex: 1;
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

.status-completed {
    color: #155724;
    background: #d4edda;
}

.status-refunded {
    color: #721c24;
    background: #f8d7da;
}

.enrollment-details {
    display: grid;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.detail-row {
    display: flex;
    gap: 0.5rem;
}

.detail-row strong {
    min-width: 80px;
}

.enrollment-description {
    margin: 1rem 0;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 4px;
}

.enrollment-description p {
    margin: 0;
}

.enrollment-footer {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #dee2e6;
    font-size: 0.9rem;
    color: #6c757d;
}

.enrollment-footer p {
    margin: 0.25rem 0;
}

.enrollment-notes {
    margin-top: 0.5rem;
    color: #333;
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
</style>
