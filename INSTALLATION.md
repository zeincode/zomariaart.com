# Installation Guide - Zo's Art Gallery

## Quick Start Guide

### Step 1: Upload Files to Hostinger

1. Log into your Hostinger control panel
2. Go to File Manager
3. Navigate to `public_html` directory
4. Upload all files from this repository
5. Make sure the `public` folder contents are in your `public_html` root

**Important File Structure:**
```
public_html/
├── index.php          (from public/ folder)
├── .htaccess          (from public/ folder)  
├── app/               (entire folder)
├── config/            (entire folder)
├── assets/            (entire folder)
└── sql/               (entire folder)
```

### Step 2: Create MySQL Database

1. In Hostinger control panel, go to **MySQL Databases**
2. Click **Create New Database**
3. Database name: `zomariaart_db` (or your choice)
4. Create a database user with a strong password
5. Assign user to database with all privileges
6. Note down:
   - Database name
   - Database username
   - Database password
   - Database host (usually `localhost`)

### Step 3: Import Database Schema

**Option A: Using phpMyAdmin**
1. Go to phpMyAdmin in Hostinger control panel
2. Select your database from left sidebar
3. Click **Import** tab
4. Choose file: `sql/schema.sql`
5. Click **Go** button

**Option B: Using MySQL command line**
```bash
mysql -u your_username -p your_database < sql/schema.sql
```

### Step 4: Configure Database Connection

Edit `config/database.php`:

```php
define('DB_HOST', 'localhost');          // Usually localhost
define('DB_NAME', 'zomariaart_db');      // Your database name
define('DB_USER', 'your_username');      // Your database username
define('DB_PASS', 'your_password');      // Your database password
```

### Step 5: Update Site Configuration

Edit `config/config.php`:

```php
// Update your domain
define('SITE_URL', 'https://zomariaart.com');

// Update email settings
define('SITE_EMAIL', 'contact@zomariaart.com');
define('SMTP_USER', 'noreply@zomariaart.com');
define('SMTP_PASS', 'your_email_password');
```

### Step 6: Set File Permissions

Set proper permissions for security:
```bash
# Directories
chmod 755 app/
chmod 755 config/
chmod 755 assets/
chmod 755 assets/images/

# Make images writable for uploads
chmod 775 assets/images/
chmod 775 assets/images/placeholder/
chmod 775 assets/images/watermark/

# Protect config files
chmod 644 config/*.php
```

### Step 7: Test Your Installation

1. Visit your site: `https://zomariaart.com`
2. You should see the home page
3. Test admin login: `https://zomariaart.com/index.php?page=login`
   - Username: `admin`
   - Password: `admin123`

### Step 8: Security - MUST DO!

**Immediately after installation:**

1. **Change Admin Password**
   - Login to admin dashboard
   - Navigate to settings (or manually in database)
   - Update password

2. **Enable HTTPS**
   - In `public/.htaccess`, uncomment these lines:
   ```apache
   RewriteCond %{HTTPS} off
   RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
   ```

3. **Update Database Password**
   - Use a strong, unique password for database
   - Never use "password" or "admin123"

4. **Disable Error Display in Production**
   - In `config/config.php`, change:
   ```php
   error_reporting(0);
   ini_set('display_errors', 0);
   ```

### Step 9: Add Your Content

1. **Upload Your Artwork Images**
   - Go to admin dashboard
   - Upload images to `assets/images/`
   - Recommended: 1200x1200px for main images
   - Recommended: 400x400px for thumbnails

2. **Add Products**
   - Login to admin
   - Go to Products → Add New Product
   - Fill in details and upload images

3. **Create Classes**
   - Go to Classes → Add New Class
   - Set date, time, location, and capacity

4. **Customize Content**
   - Edit `app/views/about/index.php` for your bio
   - Update social media links in footer
   - Add your contact information

## Payment Gateway Setup

### Stripe Configuration

1. Create account at https://stripe.com
2. Get API keys from dashboard
3. Update `config/config.php`:
   ```php
   define('STRIPE_PUBLIC_KEY', 'pk_live_your_key');
   define('STRIPE_SECRET_KEY', 'sk_live_your_key');
   ```
4. Implement Stripe checkout in `CheckoutController.php`

### PayPal Configuration

1. Create business account at https://paypal.com
2. Get client ID and secret
3. Update `config/config.php`:
   ```php
   define('PAYPAL_CLIENT_ID', 'your_client_id');
   define('PAYPAL_SECRET', 'your_secret');
   ```

## Email Configuration

For order confirmations and notifications:

1. Use Hostinger email or external SMTP
2. Update in `config/config.php`:
   ```php
   define('SMTP_HOST', 'smtp.hostinger.com');
   define('SMTP_PORT', 587);
   define('SMTP_USER', 'noreply@zomariaart.com');
   define('SMTP_PASS', 'your_password');
   ```

3. Consider using PHPMailer library for robust email:
   ```bash
   composer require phpmailer/phpmailer
   ```

## Troubleshooting

### 500 Internal Server Error
- Check `.htaccess` file exists in public folder
- Verify mod_rewrite is enabled
- Check file permissions
- Review error logs in Hostinger panel

### Database Connection Failed
- Verify database credentials in `config/database.php`
- Ensure database user has proper privileges
- Check if database exists

### Images Not Loading
- Check file permissions on `assets/images/`
- Verify correct path in database
- Check .htaccess rules

### Admin Login Not Working
- Clear browser cache
- Check session configuration
- Verify database has admin user
- Default: username `admin`, password `admin123`

## Backup Recommendations

1. **Database Backup**
   - Use phpMyAdmin to export database weekly
   - Or use Hostinger's automatic backup feature

2. **File Backup**
   - Download entire site via FTP monthly
   - Keep backups of uploaded images

3. **Code Backup**
   - Keep a copy of your customized code
   - Use version control (Git)

## Support

For issues:
1. Check error logs in Hostinger control panel
2. Review PHP error logs
3. Check browser console for JavaScript errors
4. Refer to README.md for detailed documentation

## Next Steps

After installation:
- [ ] Test all pages (home, gallery, cart, checkout)
- [ ] Add your products and images
- [ ] Create your first class
- [ ] Test the checkout process
- [ ] Set up payment gateway
- [ ] Configure email notifications
- [ ] Customize colors and branding
- [ ] Add SSL certificate (HTTPS)
- [ ] Submit sitemap to search engines
- [ ] Launch and share!

Congratulations! Your art gallery is now live. 🎨
