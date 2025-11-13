-- Sample Data for Zo's Art Gallery
-- This file contains sample products, classes, and testimonials for testing
-- Run this AFTER importing schema.sql

-- Sample Products
INSERT INTO products (title, description, base_price, category, medium, featured, stock_quantity, image_url, thumbnail_url, status) VALUES
('Sunset Dreams', 'A vibrant abstract piece capturing the warmth and beauty of a summer sunset. Rich oranges and purples blend together in this captivating work.', 299.99, 'Abstract', 'Acrylic', 1, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Mountain Majesty', 'Majestic mountain landscape painted in oils. This piece brings the serenity of nature into your home.', 449.99, 'Landscape', 'Oil', 1, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Ocean Waves', 'Dynamic seascape capturing the power and beauty of ocean waves. Textured layers create depth and movement.', 349.99, 'Seascape', 'Mixed Media', 1, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Floral Harmony', 'Delicate watercolor of spring flowers. Soft pastels create a peaceful, ethereal composition.', 199.99, 'Floral', 'Watercolor', 0, 2, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Urban Rhythm', 'Contemporary cityscape exploring the energy and rhythm of urban life. Bold colors and strong lines.', 399.99, 'Contemporary', 'Acrylic', 1, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Peaceful Valley', 'Tranquil valley scene painted in the impressionist style. Perfect for creating a calming atmosphere.', 329.99, 'Landscape', 'Oil', 0, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Abstract Emotion', 'Bold abstract expressionist piece exploring raw emotion through color and form.', 499.99, 'Abstract', 'Mixed Media', 1, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Garden Path', 'Charming garden scene with a winding path through blooming flowers. Impressionist technique.', 279.99, 'Floral', 'Oil', 0, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Desert Sunset', 'Dramatic desert landscape at sunset. Warm earth tones and dramatic sky create stunning visual impact.', 359.99, 'Landscape', 'Acrylic', 0, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Coastal Morning', 'Peaceful coastal scene at dawn. Soft light and gentle waves invite contemplation.', 289.99, 'Seascape', 'Watercolor', 0, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Abstract Flow', 'Fluid abstract painting exploring movement and color relationships. Contemporary style.', 379.99, 'Abstract', 'Acrylic', 0, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active'),
('Autumn Reflections', 'Beautiful autumn scene with trees reflected in still water. Rich fall colors throughout.', 319.99, 'Landscape', 'Oil', 0, 1, 'placeholder/art-placeholder.jpg', 'placeholder/art-placeholder.jpg', 'active');

-- Sample Product Options (sizes, media types, finishes)
-- For product ID 1 (Sunset Dreams)
INSERT INTO product_options (product_id, option_type, option_value, price_modifier) VALUES
(1, 'size', '12x16 inches', 0.00),
(1, 'size', '18x24 inches', 100.00),
(1, 'size', '24x36 inches', 200.00),
(1, 'media', 'Canvas Print', 0.00),
(1, 'media', 'Paper Print', -50.00),
(1, 'media', 'Metal Print', 150.00),
(1, 'finish', 'Matte', 0.00),
(1, 'finish', 'Glossy', 25.00),
(1, 'finish', 'Gallery Wrap', 75.00);

-- Sample Classes
INSERT INTO classes (title, description, syllabus, required_materials, date, time, location, price, capacity, enrolled, status, image_url) VALUES
('Beginner Acrylic Painting', 'Perfect introduction to acrylic painting for absolute beginners. Learn basic techniques, color mixing, and composition. All materials provided.', 
'Session 1: Introduction to acrylics and materials\nSession 2: Color theory and mixing\nSession 3: Basic brush techniques\nSession 4: Creating your first painting',
'All materials provided. Just bring your creativity!',
DATE_ADD(CURDATE(), INTERVAL 14 DAY), '10:00:00', 'Studio at 123 Art Street', 149.99, 12, 8, 'upcoming', 'placeholder/art-placeholder.jpg'),

('Watercolor Landscapes', 'Learn to paint beautiful landscapes in watercolor. Suitable for beginners with some painting experience.',
'Week 1: Understanding watercolor properties\nWeek 2: Sky and clouds techniques\nWeek 3: Trees and foliage\nWeek 4: Complete landscape composition',
'Watercolor set, brushes (sizes 4, 8, 12), watercolor paper, palette',
DATE_ADD(CURDATE(), INTERVAL 21 DAY), '14:00:00', 'Studio at 123 Art Street', 179.99, 10, 5, 'upcoming', 'placeholder/art-placeholder.jpg'),

('Abstract Expressionism Workshop', 'Explore your creativity through abstract expressionism. No experience necessary - just enthusiasm!',
'Half-day intensive workshop covering abstract techniques, color relationships, and emotional expression through art.',
'All materials provided. Wear clothes you don''t mind getting paint on!',
DATE_ADD(CURDATE(), INTERVAL 28 DAY), '09:00:00', 'Studio at 123 Art Street', 99.99, 15, 3, 'upcoming', 'placeholder/art-placeholder.jpg'),

('Oil Painting Fundamentals', 'Comprehensive introduction to oil painting. Learn traditional techniques and modern approaches.',
'Week 1: Oil painting materials and setup\nWeek 2: Color mixing with oils\nWeek 3: Layering and glazing\nWeek 4: Still life painting\nWeek 5: Portrait techniques\nWeek 6: Landscape painting',
'Oil paint set, brushes, canvas panels, palette, linseed oil, turpentine substitute',
DATE_ADD(CURDATE(), INTERVAL 35 DAY), '18:00:00', 'Studio at 123 Art Street', 249.99, 8, 2, 'upcoming', 'placeholder/art-placeholder.jpg'),

('Mixed Media Art', 'Experiment with combining different art materials and techniques. Perfect for creative exploration!',
'Session 1: Introduction to mixed media\nSession 2: Collage techniques\nSession 3: Texture and layering\nSession 4: Final project',
'Various materials will be explored. Supply list provided upon registration.',
DATE_ADD(CURDATE(), INTERVAL 42 DAY), '13:00:00', 'Studio at 123 Art Street', 169.99, 12, 1, 'upcoming', 'placeholder/art-placeholder.jpg');

-- Sample Testimonials
INSERT INTO testimonials (student_name, class_id, testimonial, rating, status) VALUES
('Sarah Johnson', 1, 'Zo is an amazing teacher! I had never painted before, and now I have a beautiful piece hanging in my home. The class was well-paced and encouraging.', 5, 'approved'),
('Michael Chen', 2, 'The watercolor landscape class exceeded my expectations. Zo''s patient instruction and demonstrations made complex techniques easy to understand.', 5, 'approved'),
('Emily Rodriguez', 3, 'What a liberating experience! The abstract workshop helped me break free from perfectionism and just create. Highly recommend!', 5, 'approved'),
('David Thompson', 1, 'Great beginner class. Zo creates a supportive environment where everyone feels comfortable experimenting and learning.', 5, 'approved'),
('Lisa Martinez', 4, 'The oil painting fundamentals course was comprehensive and well-structured. I learned so much in six weeks!', 5, 'approved'),
('James Wilson', 2, 'Wonderful class! Zo''s passion for art is contagious. I came away with new skills and inspiration.', 5, 'approved');

-- Sample Newsletter Subscribers
INSERT INTO newsletter_subscribers (email, status) VALUES
('art.lover@example.com', 'active'),
('creative.mind@example.com', 'active'),
('gallery.fan@example.com', 'active');

-- Note: Placeholder images should be replaced with actual images
-- Upload your artwork to assets/images/ and update image_url and thumbnail_url accordingly
-- After adding real images, update the products table:
-- UPDATE products SET image_url = 'your-image.jpg', thumbnail_url = 'your-thumbnail.jpg' WHERE id = X;
