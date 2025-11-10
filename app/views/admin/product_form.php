<h1><?php echo $data['product'] ? 'Edit Product' : 'Add New Product'; ?></h1>

<form method="POST" action="<?php echo BASE_URL; ?>index.php?page=admin&action=saveProduct" class="admin-form">
    <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
    <?php if ($data['product']): ?>
        <input type="hidden" name="product_id" value="<?php echo $data['product']['id']; ?>">
    <?php endif; ?>
    
    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" required 
               value="<?php echo $data['product'] ? e($data['product']['title']) : ''; ?>">
    </div>
    
    <div class="form-group">
        <label for="description">Description *</label>
        <textarea id="description" name="description" rows="6" required><?php echo $data['product'] ? e($data['product']['description']) : ''; ?></textarea>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label for="base_price">Base Price *</label>
            <input type="number" id="base_price" name="base_price" step="0.01" required 
                   value="<?php echo $data['product'] ? $data['product']['base_price'] : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="stock_quantity">Stock Quantity *</label>
            <input type="number" id="stock_quantity" name="stock_quantity" required 
                   value="<?php echo $data['product'] ? $data['product']['stock_quantity'] : '0'; ?>">
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" 
                   value="<?php echo $data['product'] ? e($data['product']['category']) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="medium">Medium</label>
            <input type="text" id="medium" name="medium" 
                   value="<?php echo $data['product'] ? e($data['product']['medium']) : ''; ?>">
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label for="status">Status *</label>
            <select id="status" name="status" required>
                <option value="active" <?php echo ($data['product'] && $data['product']['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?php echo ($data['product'] && $data['product']['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                <option value="sold" <?php echo ($data['product'] && $data['product']['status'] === 'sold') ? 'selected' : ''; ?>>Sold</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="featured" value="1" 
                       <?php echo ($data['product'] && $data['product']['featured']) ? 'checked' : ''; ?>>
                Featured Product
            </label>
        </div>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save Product</button>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=products" class="btn btn-secondary">Cancel</a>
    </div>
</form>
