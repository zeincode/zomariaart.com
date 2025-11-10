<div class="page-header">
    <div class="container">
        <h1>Classes & Workshops</h1>
        <p>Explore your creativity with hands-on art instruction</p>
    </div>
</div>

<section class="teaching-philosophy container">
    <h2>Teaching Philosophy</h2>
    <p>
        I believe that everyone has creative potential waiting to be unlocked. My classes are designed 
        to provide a supportive, encouraging environment where students of all skill levels can explore 
        various artistic techniques and discover their unique creative voice.
    </p>
    <p>
        Whether you're a complete beginner or looking to refine your skills, you'll find a welcoming 
        community and expert guidance to help you grow as an artist.
    </p>
</section>

<section class="classes-section container">
    <h2>Upcoming Classes</h2>
    
    <?php if (!empty($data['classes'])): ?>
        <div class="classes-grid">
            <?php foreach ($data['classes'] as $class): ?>
                <?php $seatsLeft = calculateSeatsLeft($class['capacity'], $class['enrolled']); ?>
                <div class="class-card">
                    <?php if ($class['image_url']): ?>
                        <img src="<?php echo IMAGES_URL . $class['image_url']; ?>" 
                             alt="<?php echo e($class['title']); ?>"
                             class="class-image">
                    <?php endif; ?>
                    
                    <div class="class-content">
                        <h3><?php echo e($class['title']); ?></h3>
                        
                        <div class="class-meta">
                            <p><strong>Date:</strong> <?php echo formatDate($class['date']); ?></p>
                            <p><strong>Time:</strong> <?php echo date('g:i A', strtotime($class['time'])); ?></p>
                            <p><strong>Location:</strong> <?php echo e($class['location']); ?></p>
                            <p><strong>Price:</strong> <?php echo formatPrice($class['price']); ?></p>
                        </div>
                        
                        <p class="class-description"><?php echo e(substr($class['description'], 0, 150)); ?>...</p>
                        
                        <div class="class-footer">
                            <p class="seats-info">
                                <?php if ($seatsLeft > 0): ?>
                                    <span class="seats-available"><?php echo $seatsLeft; ?> seats left</span>
                                <?php else: ?>
                                    <span class="seats-full">Class Full</span>
                                <?php endif; ?>
                            </p>
                            
                            <a href="<?php echo BASE_URL; ?>index.php?page=teaching&action=detail&id=<?php echo $class['id']; ?>" 
                               class="btn btn-primary">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No upcoming classes at this time. Check back soon!</p>
    <?php endif; ?>
</section>

<?php if (!empty($data['testimonials'])): ?>
    <section class="testimonials-section container">
        <h2>Student Testimonials</h2>
        
        <div class="testimonials-grid">
            <?php foreach (array_slice($data['testimonials'], 0, 6) as $testimonial): ?>
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                            ★
                        <?php endfor; ?>
                    </div>
                    <p class="testimonial-text">"<?php echo e($testimonial['testimonial']); ?>"</p>
                    <p class="testimonial-author">- <?php echo e($testimonial['student_name']); ?></p>
                    <?php if ($testimonial['class_title']): ?>
                        <p class="testimonial-class"><?php echo e($testimonial['class_title']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>
