<h1>Class Management</h1>

<div class="admin-actions">
    <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=editClass" class="btn btn-primary">Add New Class</a>
</div>

<?php if (!empty($data['classes'])): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Price</th>
                <th>Enrolled</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['classes'] as $class): ?>
                <tr>
                    <td><?php echo e($class['title']); ?></td>
                    <td><?php echo formatDate($class['date']); ?></td>
                    <td><?php echo date('g:i A', strtotime($class['time'])); ?></td>
                    <td><?php echo e($class['location']); ?></td>
                    <td><?php echo formatPrice($class['price']); ?></td>
                    <td><?php echo $class['enrolled']; ?> / <?php echo $class['capacity']; ?></td>
                    <td><?php echo ucfirst($class['status']); ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=editClass&id=<?php echo $class['id']; ?>">Edit</a>
                        |
                        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=deleteClass&id=<?php echo $class['id']; ?>" 
                           onclick="return confirm('Delete this class?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No classes found.</p>
<?php endif; ?>
