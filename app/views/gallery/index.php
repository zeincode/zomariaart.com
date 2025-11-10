<div class="page-header">
    <div class="container">
        <h1>Gallery & Shop</h1>
        <p>Browse our collection of original artwork</p>
    </div>
</div>

<div class="gallery-container container">
    <aside class="gallery-filters">
        <h3>Filter Artwork</h3>
        
        <form method="GET" action="index.php" class="filter-form">
            <input type="hidden" name="page" value="gallery">
            
            <div class="filter-group">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" placeholder="Search artwork..." 
                       value="<?php echo e($data['currentFilters']['search'] ?? ''); ?>">
            </div>
            
            <div class="filter-group">
                <label for="category">Category</label>
                <select id="category" name="category">
                    <option value="">All Categories</option>
                    <?php foreach ($data['categories'] as $category): ?>
                        <option value="<?php echo e($category); ?>" 
                                <?php echo ($data['currentFilters']['category'] ?? '') === $category ? 'selected' : ''; ?>>
                            <?php echo e($category); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="medium">Medium</label>
                <select id="medium" name="medium">
                    <option value="">All Media</option>
                    <?php foreach ($data['mediaTypes'] as $medium): ?>
                        <option value="<?php echo e($medium); ?>"
                                <?php echo ($data['currentFilters']['medium'] ?? '') === $medium ? 'selected' : ''; ?>>
                            <?php echo e($medium); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="min_price">Price Range</label>
                <div class="price-inputs">
                    <input type="number" id="min_price" name="min_price" placeholder="Min" 
                           value="<?php echo e($data['currentFilters']['min_price'] ?? ''); ?>">
                    <span>-</span>
                    <input type="number" id="max_price" name="max_price" placeholder="Max"
                           value="<?php echo e($data['currentFilters']['max_price'] ?? ''); ?>">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Apply Filters</button>
            <a href="<?php echo BASE_URL; ?>index.php?page=gallery" class="btn btn-secondary">Clear Filters</a>
        </form>
    </aside>
    
    <div class="gallery-main">
        <?php if (!empty($data['products'])): ?>
            <div class="gallery-grid">
                <?php foreach ($data['products'] as $product): ?>
                    <div class="gallery-item">
                        <a href="<?php echo BASE_URL; ?>index.php?page=product&id=<?php echo $product['id']; ?>">
                            <div class="gallery-image">
                                <img src="<?php echo IMAGES_URL . ($product['thumbnail_url'] ?? 'placeholder/art-placeholder.jpg'); ?>" 
                                     alt="<?php echo e($product['title']); ?>"
                                     loading="lazy">
                                <div class="gallery-overlay">
                                    <span class="view-details">View Details</span>
                                </div>
                            </div>
                            <div class="gallery-info">
                                <h3><?php echo e($product['title']); ?></h3>
                                <?php if ($product['category']): ?>
                                    <p class="category"><?php echo e($product['category']); ?></p>
                                <?php endif; ?>
                                <p class="price"><?php echo formatPrice($product['base_price']); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <p>No artwork found matching your criteria.</p>
                <a href="<?php echo BASE_URL; ?>index.php?page=gallery" class="btn btn-primary">View All Artwork</a>
            </div>
        <?php endif; ?>
    </div>
</div>
