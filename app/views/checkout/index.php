<div class="page-header">
    <div class="container">
        <h1>Checkout</h1>
    </div>
</div>

<div class="checkout-container container">
    <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=checkout&action=process" class="checkout-form" id="checkoutForm">
        <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
        
        <div class="checkout-main">
            <section class="checkout-section">
                <h2>Customer Information</h2>
                
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                </div>
            </section>
            
            <section class="checkout-section">
                <h2>Shipping Address</h2>
                
                <div class="form-group">
                    <label for="shipping_address">Address *</label>
                    <textarea id="shipping_address" name="shipping_address" rows="4" required 
                              placeholder="Street address, city, state, ZIP code"></textarea>
                </div>
            </section>
            
            <section class="checkout-section">
                <h2>Billing Address</h2>
                
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="sameAsShipping" checked>
                        Same as shipping address
                    </label>
                </div>
                
                <div class="form-group" id="billingAddressGroup" style="display: none;">
                    <label for="billing_address">Billing Address</label>
                    <textarea id="billing_address" name="billing_address" rows="4" 
                              placeholder="Street address, city, state, ZIP code"></textarea>
                </div>
            </section>
            
            <section class="checkout-section">
                <h2>Payment Method</h2>
                
                <div class="payment-options">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="stripe" checked>
                        <span>Credit Card (Stripe)</span>
                    </label>
                    
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="paypal">
                        <span>PayPal</span>
                    </label>
                </div>
                
                <p class="payment-note">
                    Payment processing will be completed on the next page after order confirmation.
                </p>
            </section>
        </div>
        
        <aside class="checkout-sidebar">
            <div class="order-summary">
                <h3>Order Summary</h3>
                
                <div class="summary-items">
                    <?php foreach ($data['cart'] as $item): ?>
                        <div class="summary-item">
                            <span><?php echo e($item['title']); ?> × <?php echo $item['quantity']; ?></span>
                            <span><?php echo formatPrice($item['price'] * $item['quantity']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="summary-totals">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span><?php echo formatPrice($data['subtotal']); ?></span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Tax:</span>
                        <span><?php echo formatPrice($data['tax']); ?></span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span><?php echo $data['shipping'] > 0 ? formatPrice($data['shipping']) : 'FREE'; ?></span>
                    </div>
                    
                    <div class="summary-row summary-total">
                        <span>Total:</span>
                        <span><?php echo formatPrice($data['total']); ?></span>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-large">Place Order</button>
            </div>
        </aside>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sameAsShipping = document.getElementById('sameAsShipping');
    const billingAddressGroup = document.getElementById('billingAddressGroup');
    const billingAddress = document.getElementById('billing_address');
    
    sameAsShipping.addEventListener('change', function() {
        if (this.checked) {
            billingAddressGroup.style.display = 'none';
            billingAddress.removeAttribute('required');
        } else {
            billingAddressGroup.style.display = 'block';
            billingAddress.setAttribute('required', 'required');
        }
    });
    
    // Form validation
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Please enter a valid email address');
            return false;
        }
    });
});
</script>
