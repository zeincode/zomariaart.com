<div class="product-detail container">
    <div class="product-layout">
        <div class="product-image-section">
            <div class="product-image-main">
                <img src="<?php echo IMAGES_URL . ($data['product']['image_url'] ?? 'placeholder/art-placeholder.jpg'); ?>" 
                     alt="<?php echo e($data['product']['title']); ?>"
                     class="product-image watermarked">
                <div class="watermark">© <?php echo SITE_NAME; ?></div>
            </div>
        </div>
        
        <div class="product-info-section">
            <h1 class="product-title"><?php echo e($data['product']['title']); ?></h1>
            
            <?php if ($data['product']['category']): ?>
                <p class="product-category">
                    Category: <span><?php echo e($data['product']['category']); ?></span>
                </p>
            <?php endif; ?>
            
            <?php if ($data['product']['medium']): ?>
                <p class="product-medium">
                    Medium: <span><?php echo e($data['product']['medium']); ?></span>
                </p>
            <?php endif; ?>
            
            <div class="product-price">
                <span class="price-label">Base Price:</span>
                <span class="price-amount" id="displayPrice"><?php echo formatPrice($data['product']['base_price']); ?></span>
            </div>
            
            <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=cart&action=add" class="product-form">
                <input type="hidden" name="product_id" value="<?php echo $data['product']['id']; ?>">
                <input type="hidden" name="base_price" value="<?php echo $data['product']['base_price']; ?>" id="basePrice">
                
                <?php if (!empty($data['options'])): ?>
                    <div class="product-options">
                        <?php foreach ($data['options'] as $optionType => $optionValues): ?>
                            <div class="option-group">
                                <label for="option_<?php echo $optionType; ?>">
                                    <?php echo ucfirst($optionType); ?>:
                                </label>
                                <select name="options[<?php echo $optionType; ?>]" 
                                        id="option_<?php echo $optionType; ?>" 
                                        class="price-modifier" 
                                        data-type="<?php echo $optionType; ?>">
                                    <option value="">Select <?php echo $optionType; ?></option>
                                    <?php foreach ($optionValues as $option): ?>
                                        <option value="<?php echo e($option['option_value']); ?>" 
                                                data-modifier="<?php echo $option['price_modifier']; ?>">
                                            <?php echo e($option['option_value']); ?>
                                            <?php if ($option['price_modifier'] > 0): ?>
                                                (+<?php echo formatPrice($option['price_modifier']); ?>)
                                            <?php endif; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="quantity-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="10">
                </div>
                
                <?php if ($data['product']['stock_quantity'] > 0 || $data['product']['stock_quantity'] === 0): ?>
                    <button type="submit" class="btn btn-primary btn-large">Add to Cart</button>
                <?php else: ?>
                    <button type="button" class="btn btn-disabled btn-large" disabled>Out of Stock</button>
                <?php endif; ?>
            </form>
            
            <div class="product-description">
                <h3>About This Artwork</h3>
                <p><?php echo nl2br(e($data['product']['description'])); ?></p>
            </div>
            
            <div class="product-share">
                <h4>Share This Artwork:</h4>
                <div class="share-buttons">
                    <a href="#" class="share-btn" onclick="shareOnFacebook(); return false;">Facebook</a>
                    <a href="#" class="share-btn" onclick="shareOnTwitter(); return false;">Twitter</a>
                    <a href="#" class="share-btn" onclick="shareOnPinterest(); return false;">Pinterest</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Dynamic price update based on selected options
document.addEventListener('DOMContentLoaded', function() {
    const basePrice = parseFloat(document.getElementById('basePrice').value);
    const priceDisplay = document.getElementById('displayPrice');
    const modifiers = document.querySelectorAll('.price-modifier');
    
    function updatePrice() {
        let totalPrice = basePrice;
        
        modifiers.forEach(function(select) {
            const selectedOption = select.options[select.selectedIndex];
            if (selectedOption && selectedOption.dataset.modifier) {
                totalPrice += parseFloat(selectedOption.dataset.modifier);
            }
        });
        
        priceDisplay.textContent = '$' + totalPrice.toFixed(2);
    }
    
    modifiers.forEach(function(select) {
        select.addEventListener('change', updatePrice);
    });
});

// Share functions
function shareOnFacebook() {
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href), '_blank');
}

function shareOnTwitter() {
    window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href), '_blank');
}

function shareOnPinterest() {
    window.open('https://pinterest.com/pin/create/button/?url=' + encodeURIComponent(window.location.href), '_blank');
}
</script>
