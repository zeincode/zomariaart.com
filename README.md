# Zo's Art Gallery & Store

A complete, responsive online art gallery and store built with PHP and JavaScript, featuring an e-commerce system, class/workshop management, and admin dashboard.

## Features

### Customer-Facing Features
- **Home Page**: Hero banner, artist bio, featured artwork, and call-to-action buttons
- **Gallery/Shop**: Grid layout with filtering by category, medium, size, and price
- **Product Details**: Large images with watermark protection, dynamic pricing based on options
- **Shopping Cart**: Full cart management with quantity updates and price calculations
- **Checkout**: Secure single-page checkout with payment integration support (Stripe/PayPal)
- **Teaching Section**: Browse classes, view details, and enroll with online registration
- **About Page**: Artist biography, creative process, and achievements
- **Contact Page**: Contact form for inquiries and commissions

### Admin Features
- **Dashboard**: Sales statistics, recent orders, and upcoming classes overview
- **Product Management**: Create, edit, delete artwork with pricing and options
- **Order Management**: View orders, update status, manage fulfillment
- **Class Management**: Create/edit classes, view enrollments, manage capacity
- **Secure Login**: Admin authentication system

### Security & Protection
- Image protection with watermarks and right-click prevention
- SQL injection prevention using prepared statements
- CSRF token protection on forms
- Input sanitization and validation
- HTTPS support (configurable)
- Secure password hashing

### Design & UX
- Fully responsive design (mobile, tablet, desktop)
- Clean, modern interface
- Smooth animations and hover effects
- Accessible with semantic HTML and ARIA attributes
- SEO-friendly with meta tags and structured data

## Technology Stack

- **Backend**: PHP 7.4+ with MVC architecture
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript (ES6)
- **Server**: Apache with mod_rewrite

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server with mod_rewrite enabled
- Hostinger cloud hosting or similar

### Setup Steps

1. **Upload Files**
   ```bash
   # Upload all files to your Hostinger public_html directory
   # The public folder should be your document root
   ```

2. **Configure Database**
   ```bash
   # Create a MySQL database through Hostinger control panel
   # Import the schema.sql file
   mysql -u your_username -p your_database < sql/schema.sql
   ```

3. **Update Configuration**
   Edit `config/database.php`:
   ```php
   define('DB_HOST', 'your_host');
   define('DB_NAME', 'your_database');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   ```

   Edit `config/config.php`:
   - Update SITE_URL with your domain
   - Configure email settings for notifications
   - Add Stripe/PayPal API keys for payment processing

4. **Set Permissions**
   ```bash
   # Make assets/images writable for uploads
   chmod 755 assets/images
   chmod 755 assets/images/placeholder
   ```

5. **Configure .htaccess**
   - Ensure mod_rewrite is enabled on your server
   - Update RewriteBase if not in root directory
   - Uncomment HTTPS redirect in production

## Default Admin Credentials

- **Username**: admin
- **Email**: admin@zomariaart.com
- **Password**: admin123

⚠️ **IMPORTANT**: Change the default admin password immediately after first login!

## Directory Structure

```
zomariaart.com/
├── public/              # Document root
│   ├── index.php       # Front controller
│   └── .htaccess       # Apache configuration
├── app/
│   ├── controllers/    # MVC Controllers
│   ├── models/         # Database models
│   └── views/          # View templates
│       ├── layouts/    # Header/footer templates
│       ├── home/       # Home page views
│       ├── gallery/    # Gallery views
│       ├── product/    # Product detail views
│       ├── cart/       # Shopping cart views
│       ├── checkout/   # Checkout views
│       ├── teaching/   # Classes views
│       ├── admin/      # Admin dashboard views
│       ├── about/      # About page
│       ├── contact/    # Contact page
│       └── auth/       # Login views
├── config/
│   ├── config.php      # Application configuration
│   ├── database.php    # Database connection
│   └── helpers.php     # Helper functions
├── assets/
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript files
│   └── images/         # Images and uploads
└── sql/
    └── schema.sql      # Database schema
```

## Usage

### Adding Products
1. Login to admin dashboard at `/index.php?page=admin`
2. Navigate to "Products" → "Add New Product"
3. Fill in product details, pricing, and options
4. Upload product images (replace placeholder images)

### Managing Orders
1. View orders from the admin dashboard
2. Update order status (pending, processing, shipped, delivered)
3. Process refunds if needed
4. Send confirmation emails to customers

### Creating Classes
1. Go to "Classes" in admin dashboard
2. Click "Add New Class"
3. Enter class details, date, time, location, and capacity
4. Students can enroll through the teaching section

### Customization
- Replace placeholder images in `assets/images/placeholder/`
- Update artist bio and content in view files
- Customize colors in `assets/css/style.css` (see CSS variables)
- Add social media links in footer
- Configure payment gateway credentials

## Payment Integration

### Stripe Setup
1. Create account at stripe.com
2. Get API keys from dashboard
3. Update `STRIPE_PUBLIC_KEY` and `STRIPE_SECRET_KEY` in config.php
4. Implement payment processing in CheckoutController

### PayPal Setup
1. Create business account at paypal.com
2. Get API credentials
3. Update `PAYPAL_CLIENT_ID` and `PAYPAL_SECRET` in config.php
4. Implement PayPal SDK integration

## Email Configuration

Update SMTP settings in `config/config.php`:
```php
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'noreply@zomariaart.com');
define('SMTP_PASS', 'your_password');
```

Use PHPMailer library for robust email sending (install via Composer or manually).

## Security Best Practices

1. **Change default admin password** immediately
2. **Enable HTTPS** in production (uncomment in .htaccess)
3. **Keep PHP and MySQL updated**
4. **Regular backups** of database and files
5. **Restrict file upload types** and sizes
6. **Use strong passwords** for admin accounts
7. **Monitor error logs** regularly

## SEO Optimization

- Update meta descriptions in each view file
- Add alt text to all images
- Submit sitemap to search engines
- Use descriptive URLs
- Add Open Graph tags for social sharing

## Maintenance

### Regular Tasks
- Backup database weekly
- Review and process orders daily
- Update product inventory
- Monitor server logs
- Test checkout process monthly

### Troubleshooting
- Check PHP error logs for issues
- Verify database connection settings
- Ensure proper file permissions
- Clear browser cache after updates

## Support

For issues or questions:
- Email: admin@zomariaart.com
- Review code comments for detailed documentation
- Check PHP error logs for debugging

## License

Copyright © 2024 Zo's Art Gallery. All rights reserved.

## Version

Version 1.0.0 - Initial Release
