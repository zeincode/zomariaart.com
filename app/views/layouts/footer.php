    </main>
    
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About</h3>
                    <p><?php echo SITE_NAME; ?> showcases original artwork and offers art education through workshops and classes.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>index.php?page=home">Home</a></li>
                        <li><a href="<?php echo BASE_URL; ?>index.php?page=gallery">Gallery</a></li>
                        <li><a href="<?php echo BASE_URL; ?>index.php?page=teaching">Classes</a></li>
                        <li><a href="<?php echo BASE_URL; ?>index.php?page=about">About</a></li>
                        <li><a href="<?php echo BASE_URL; ?>index.php?page=contact">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Connect</h3>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook">Facebook</a>
                        <a href="#" aria-label="Instagram">Instagram</a>
                        <a href="#" aria-label="Twitter">Twitter</a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Newsletter</h3>
                    <form action="<?php echo BASE_URL; ?>index.php?page=newsletter" method="POST" class="newsletter-form">
                        <input type="email" name="email" placeholder="Your email" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
                <p class="copyright-notice">All artwork is protected by copyright. Unauthorized reproduction is prohibited.</p>
                <?php if (isAdmin()): ?>
                    <p><a href="<?php echo BASE_URL; ?>index.php?page=admin">Admin Dashboard</a></p>
                <?php endif; ?>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
