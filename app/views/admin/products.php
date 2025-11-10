<h1>Product Management</h1>

<div class="admin-actions">
    <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=editProduct" class="btn btn-primary">Add New Product</a>
</div>

<?php if (!empty($data['products'])): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['products'] as $product): ?>
                <tr>
                    <td><?php echo e($product['title']); ?></td>
                    <td><?php echo e($product['category']); ?></td>
                    <td><?php echo formatPrice($product['base_price']); ?></td>
                    <td><?php echo $product['stock_quantity']; ?></td>
                    <td><?php echo ucfirst($product['status']); ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=editProduct&id=<?php echo $product['id']; ?>">Edit</a>
                        |
                        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=deleteProduct&id=<?php echo $product['id']; ?>" 
                           onclick="return confirm('Delete this product?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No products found.</p>
<?php endif; ?>
