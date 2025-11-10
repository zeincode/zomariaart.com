<div class="page-header">
    <div class="container">
        <h1>Shopping Cart</h1>
    </div>
</div>

<div class="cart-container container">
    <?php if (!empty($data['cart'])): ?>
        <div class="cart-content">
            <div class="cart-items">
                <?php foreach ($data['cart'] as $key => $item): ?>
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="<?php echo IMAGES_URL . ($item['image'] ?? 'placeholder/art-placeholder.jpg'); ?>" 
                                 alt="<?php echo e($item['title']); ?>">
                        </div>
                        
                        <div class="item-details">
                            <h3><?php echo e($item['title']); ?></h3>
                            <?php if (!empty($item['options'])): ?>
                                <ul class="item-options">
                                    <?php foreach ($item['options'] as $optType => $optValue): ?>
                                        <li><?php echo ucfirst($optType); ?>: <?php echo e($optValue); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <p class="item-price"><?php echo formatPrice($item['price']); ?> each</p>
                        </div>
                        
                        <div class="item-quantity">
                            <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=cart&action=update" class="quantity-form">
                                <input type="hidden" name="item_key" value="<?php echo $key; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" max="10">
                                <button type="submit" class="btn btn-small">Update</button>
                            </form>
                        </div>
                        
                        <div class="item-subtotal">
                            <p><?php echo formatPrice($item['price'] * $item['quantity']); ?></p>
                        </div>
                        
                        <div class="item-remove">
                            <a href="<?php echo BASE_URL; ?>index.php?page=cart&action=remove&item=<?php echo $key; ?>" 
                               class="btn-remove" 
                               onclick="return confirm('Remove this item from cart?');">
                                Remove
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-summary">
                <h3>Order Summary</h3>
                
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span><?php echo formatPrice($data['subtotal']); ?></span>
                </div>
                
                <div class="summary-row">
                    <span>Tax (8%):</span>
                    <span><?php echo formatPrice($data['tax']); ?></span>
                </div>
                
                <div class="summary-row">
                    <span>Shipping:</span>
                    <span><?php echo $data['shipping'] > 0 ? formatPrice($data['shipping']) : 'FREE'; ?></span>
                </div>
                
                <?php if ($data['subtotal'] < 100 && $data['shipping'] > 0): ?>
                    <p class="shipping-note">Free shipping on orders over $100</p>
                <?php endif; ?>
                
                <div class="summary-row summary-total">
                    <span>Total:</span>
                    <span><?php echo formatPrice($data['total']); ?></span>
                </div>
                
                <div class="cart-actions">
                    <a href="<?php echo BASE_URL; ?>index.php?page=checkout" class="btn btn-primary btn-large">
                        Proceed to Checkout
                    </a>
                    <a href="<?php echo BASE_URL; ?>index.php?page=gallery" class="btn btn-secondary">
                        Continue Shopping
                    </a>
                    <a href="<?php echo BASE_URL; ?>index.php?page=cart&action=clear" 
                       class="btn btn-link" 
                       onclick="return confirm('Clear entire cart?');">
                        Clear Cart
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="empty-cart">
            <p>Your cart is empty.</p>
            <a href="<?php echo BASE_URL; ?>index.php?page=gallery" class="btn btn-primary">Browse Gallery</a>
        </div>
    <?php endif; ?>
</div>
