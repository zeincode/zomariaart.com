<div class="page-header">
    <div class="container">
        <h1><?php echo e($data['class']['title']); ?></h1>
    </div>
</div>

<div class="class-detail container">
    <div class="class-layout">
        <div class="class-main">
            <?php if ($data['class']['image_url']): ?>
                <img src="<?php echo IMAGES_URL . $data['class']['image_url']; ?>" 
                     alt="<?php echo e($data['class']['title']); ?>"
                     class="class-image-large">
            <?php endif; ?>
            
            <section class="class-info-section">
                <h2>About This Class</h2>
                <p><?php echo nl2br(e($data['class']['description'])); ?></p>
            </section>
            
            <?php if ($data['class']['syllabus']): ?>
                <section class="class-info-section">
                    <h2>Syllabus</h2>
                    <p><?php echo nl2br(e($data['class']['syllabus'])); ?></p>
                </section>
            <?php endif; ?>
            
            <?php if ($data['class']['required_materials']): ?>
                <section class="class-info-section">
                    <h2>Required Materials</h2>
                    <p><?php echo nl2br(e($data['class']['required_materials'])); ?></p>
                </section>
            <?php endif; ?>
        </div>
        
        <aside class="class-sidebar">
            <div class="enrollment-card">
                <h3>Class Details</h3>
                
                <div class="detail-item">
                    <strong>Date:</strong>
                    <span><?php echo formatDate($data['class']['date']); ?></span>
                </div>
                
                <div class="detail-item">
                    <strong>Time:</strong>
                    <span><?php echo date('g:i A', strtotime($data['class']['time'])); ?></span>
                </div>
                
                <div class="detail-item">
                    <strong>Location:</strong>
                    <span><?php echo e($data['class']['location']); ?></span>
                </div>
                
                <div class="detail-item">
                    <strong>Price:</strong>
                    <span class="price"><?php echo formatPrice($data['class']['price']); ?></span>
                </div>
                
                <div class="detail-item">
                    <strong>Seats Available:</strong>
                    <span class="<?php echo $data['seatsLeft'] > 0 ? 'seats-available' : 'seats-full'; ?>">
                        <?php echo $data['seatsLeft']; ?> of <?php echo $data['class']['capacity']; ?>
                    </span>
                </div>
                
                <?php if ($data['seatsLeft'] > 0): ?>
                    <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=teaching&action=enroll" class="enrollment-form">
                        <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
                        <input type="hidden" name="class_id" value="<?php echo $data['class']['id']; ?>">
                        
                        <h4>Enroll Now</h4>
                        
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-large">Enroll Now</button>
                        
                        <p class="enrollment-note">
                            You will receive a confirmation email with payment instructions.
                        </p>
                    </form>
                <?php else: ?>
                    <div class="class-full-message">
                        <p>This class is currently full.</p>
                        <a href="<?php echo BASE_URL; ?>index.php?page=contact" class="btn btn-secondary">
                            Contact for Waitlist
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </aside>
    </div>
</div>
