<div class="page-header">
    <div class="container">
        <h1>Contact</h1>
        <p>Get in touch for commissions, inquiries, or just to say hello</p>
    </div>
</div>

<div class="contact-container container">
    <div class="contact-layout">
        <div class="contact-form-section">
            <h2>Send a Message</h2>
            
            <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=contact" class="contact-form">
                <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
                
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <select id="subject" name="subject">
                        <option value="General Inquiry">General Inquiry</option>
                        <option value="Commission Request">Commission Request</option>
                        <option value="Class Information">Class Information</option>
                        <option value="Purchase Question">Purchase Question</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" rows="6" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary btn-large">Send Message</button>
            </form>
        </div>
        
        <div class="contact-info-section">
            <h2>Get in Touch</h2>
            
            <div class="contact-info">
                <div class="info-item">
                    <h3>Email</h3>
                    <p><a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a></p>
                </div>
                
                <div class="info-item">
                    <h3>Studio Hours</h3>
                    <p>
                        Monday - Friday: 10am - 6pm<br>
                        Saturday: 11am - 4pm<br>
                        Sunday: By appointment
                    </p>
                </div>
                
                <div class="info-item">
                    <h3>Follow Me</h3>
                    <div class="social-links">
                        <a href="#" class="social-link">Facebook</a>
                        <a href="#" class="social-link">Instagram</a>
                        <a href="#" class="social-link">Twitter</a>
                        <a href="#" class="social-link">Pinterest</a>
                    </div>
                </div>
            </div>
            
            <div class="commission-info">
                <h3>Commission Work</h3>
                <p>
                    I accept commission requests for custom artwork. Whether you're looking for a 
                    portrait, landscape, or abstract piece, I'd love to work with you to create 
                    something special.
                </p>
                <p>
                    Commission turnaround time is typically 4-6 weeks depending on size and complexity. 
                    Please include details about your vision when you reach out!
                </p>
            </div>
        </div>
    </div>
</div>

<section class="faq-section container">
    <h2>Frequently Asked Questions</h2>
    
    <div class="faq-grid">
        <div class="faq-item">
            <h3>How long does shipping take?</h3>
            <p>Standard shipping takes 5-7 business days within the US. Expedited options are available at checkout.</p>
        </div>
        
        <div class="faq-item">
            <h3>Do you offer international shipping?</h3>
            <p>Yes! International shipping is available. Costs and delivery times vary by location.</p>
        </div>
        
        <div class="faq-item">
            <h3>Can I return a purchase?</h3>
            <p>All artwork sales are final. However, if you're not satisfied, please contact us within 7 days of delivery.</p>
        </div>
        
        <div class="faq-item">
            <h3>Do you take custom commissions?</h3>
            <p>Yes! Use the contact form above to discuss your vision, and I'll provide a quote and timeline.</p>
        </div>
        
        <div class="faq-item">
            <h3>Are your classes suitable for beginners?</h3>
            <p>Absolutely! Most classes welcome all skill levels, and I provide guidance tailored to each student.</p>
        </div>
        
        <div class="faq-item">
            <h3>How do I care for my artwork?</h3>
            <p>Keep artwork away from direct sunlight and humidity. Dust gently with a soft, dry cloth.</p>
        </div>
    </div>
</section>
