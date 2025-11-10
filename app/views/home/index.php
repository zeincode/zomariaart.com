<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Welcome to Zo's Art Gallery</h1>
        <p class="hero-subtitle">Discover unique original artwork and join our creative community</p>
        <div class="hero-buttons">
            <a href="<?php echo BASE_URL; ?>index.php?page=gallery" class="btn btn-primary">Browse Gallery</a>
            <a href="<?php echo BASE_URL; ?>index.php?page=teaching" class="btn btn-secondary">View Classes</a>
        </div>
    </div>
</div>

<section class="about-preview container">
    <h2>About the Artist</h2>
    <div class="about-content">
        <div class="about-text">
            <p>
                Welcome! I'm Zo, a passionate artist dedicated to creating vibrant and meaningful artwork. 
                My work explores themes of nature, emotion, and the human experience through various media including 
                acrylics, watercolors, and mixed media.
            </p>
            <p>
                In addition to creating art, I love sharing my passion through teaching. Join me in exploring 
                your own creativity through hands-on workshops and classes.
            </p>
            <a href="<?php echo BASE_URL; ?>index.php?page=about" class="btn btn-link">Learn More About Zo →</a>
        </div>
        <div class="about-image">
            <img src="<?php echo IMAGES_URL; ?>placeholder/artist-photo.jpg" alt="Artist Zo" loading="lazy">
        </div>
    </div>
</section>

<section class="featured-artwork container">
    <h2>Featured Artwork</h2>
    
    <?php if (!empty($data['featuredProducts'])): ?>
        <div class="gallery-grid">
            <?php foreach ($data['featuredProducts'] as $product): ?>
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
                            <p class="price"><?php echo formatPrice($product['base_price']); ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center">
            <a href="<?php echo BASE_URL; ?>index.php?page=gallery" class="btn btn-primary">View All Artwork</a>
        </div>
    <?php else: ?>
        <p class="text-center">No featured artwork available at this time.</p>
    <?php endif; ?>
</section>

<section class="cta-section">
    <div class="container">
        <h2>Start Your Creative Journey</h2>
        <p>Join our upcoming workshops and classes to explore your artistic potential</p>
        <a href="<?php echo BASE_URL; ?>index.php?page=teaching" class="btn btn-primary">Explore Classes</a>
    </div>
</section>
