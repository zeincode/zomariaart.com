# Quick Start Guide - Get Your Gallery Live in 30 Minutes!

## For Your Hostinger Account

### Step 1: Prepare (5 minutes)

1. **Download these files** from the repository
2. **Have ready**:
   - Your Hostinger login credentials
   - A name for your database (e.g., `zomariaart_db`)
   - Your domain name

### Step 2: Create Database (5 minutes)

1. Login to Hostinger control panel
2. Find **MySQL Databases** section
3. Click **Create Database**
   - Database name: `zomariaart_db`
   - Create user: `zomariaart_user` 
   - Strong password: (generate one)
   - Assign user to database
4. **Save these credentials** - you'll need them!

### Step 3: Upload Files (10 minutes)

1. In Hostinger, go to **File Manager**
2. Navigate to `public_html`
3. **Delete** default files (index.html, etc.)
4. **Upload all files** from this repository
5. **Important**: The contents of the `public` folder should go directly in `public_html`:
   - Move `public/index.php` to `public_html/index.php`
   - Move `public/.htaccess` to `public_html/.htaccess`
   - Keep other folders (`app`, `config`, `assets`, `sql`) in `public_html`

**Your structure should look like:**
```
public_html/
├── index.php
├── .htaccess
├── app/
├── config/
├── assets/
└── sql/
```

### Step 4: Import Database (3 minutes)

1. In Hostinger, find **phpMyAdmin**
2. Select your database from left sidebar
3. Click **Import** tab
4. Choose file: `sql/schema.sql` (from your upload)
5. Click **Go**
6. Wait for "Import has been successfully finished"
7. **Optional**: Import `sql/sample_data.sql` for test products

### Step 5: Configure (5 minutes)

1. In File Manager, edit `config/database.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'zomariaart_db');        // Your database name
   define('DB_USER', 'zomariaart_user');      // Your database user
   define('DB_PASS', 'your_password_here');   // Your database password
   ```

2. Edit `config/config.php`:
   ```php
   define('SITE_URL', 'https://zomariaart.com'); // Your actual domain
   define('SITE_EMAIL', 'contact@zomariaart.com');
   ```

3. **Save both files**

### Step 6: Test! (2 minutes)

1. Visit your website: `https://zomariaart.com`
2. You should see the home page! 🎉
3. Try the gallery: `https://zomariaart.com/index.php?page=gallery`
4. Test admin login: `https://zomariaart.com/index.php?page=login`
   - Username: `admin`
   - Password: `admin123`

## That's It! Your Site is Live! 🚀

### Next Steps (Do These Soon!)

#### Security (Do First!)
1. **Change admin password immediately**
   - Login to admin
   - In database: Users table
   - Or create a password update form

2. **Enable HTTPS**
   - In `public_html/.htaccess`
   - Uncomment the HTTPS redirect lines (around line 9-10)

#### Add Your Content
1. **Upload Your Art**
   - Go to admin dashboard
   - Products → Add New Product
   - Upload your images to `assets/images/`
   - Create products with details

2. **Add Your Classes**
   - Classes → Add New Class
   - Set dates, prices, capacity

3. **Customize About Page**
   - Edit: `app/views/about/index.php`
   - Add your real bio and story

4. **Update Contact Info**
   - Edit: `app/views/contact/index.php`
   - Add real email, phone, address

5. **Social Media Links**
   - Edit: `app/views/layouts/footer.php`
   - Update social media URLs

## Common Issues & Quick Fixes

### "Database Connection Failed"
- Check credentials in `config/database.php`
- Verify database exists in phpMyAdmin
- Check user has permissions

### "500 Internal Server Error"
- Check if `.htaccess` is in `public_html/`
- Verify mod_rewrite is enabled (contact Hostinger)
- Check file permissions (755 for folders, 644 for files)

### "Page Not Found" for subpages
- Make sure `.htaccess` is in place
- Contact Hostinger to enable mod_rewrite

### Can't login to admin
- Default is username: `admin`, password: `admin123`
- Check if admin user exists in database
- Clear browser cookies

### Images not showing
- Verify file paths in database
- Check folder permissions on `assets/images/`
- Make sure images are uploaded

## Getting Help

1. Check `README.md` for detailed docs
2. Check `INSTALLATION.md` for step-by-step guide
3. Review `DEPLOYMENT_CHECKLIST.md` before launch
4. Check Hostinger knowledge base
5. Review PHP error logs in Hostinger panel

## What to Do With Sample Data

If you imported `sample_data.sql`:
- You'll have 12 sample products
- 5 sample classes  
- 6 sample testimonials

**To remove sample data:**
```sql
DELETE FROM products WHERE id > 0;
DELETE FROM classes WHERE id > 0;
DELETE FROM testimonials WHERE id > 0;
```

Or just edit them in the admin panel!

## Important URLs to Bookmark

- **Your Site**: https://zomariaart.com
- **Admin Login**: https://zomariaart.com/index.php?page=login
- **Hostinger Panel**: https://hpanel.hostinger.com
- **phpMyAdmin**: (Link in Hostinger panel)

## Payment Setup (When Ready)

### For Stripe:
1. Create account at stripe.com
2. Get test keys from dashboard
3. Update in `config/config.php`
4. Implement in `CheckoutController.php`

### For PayPal:
1. Create business account at paypal.com  
2. Get API credentials
3. Update in `config/config.php`
4. Implement in `CheckoutController.php`

## Tips for Success

1. **Start Simple**: Get one product up, test the flow
2. **Use Sample Data**: Test with sample products first
3. **Test Everything**: Try buying from your own store
4. **Mobile Check**: View on your phone
5. **Backup Often**: Download database weekly
6. **Update Regularly**: Keep PHP and MySQL updated

## Ready to Launch Checklist

- [ ] Site loads at your domain
- [ ] Admin login works
- [ ] Can add products
- [ ] Gallery displays products
- [ ] Can add items to cart
- [ ] Checkout form works
- [ ] Admin password changed
- [ ] HTTPS enabled
- [ ] Real products added
- [ ] About page updated
- [ ] Contact info correct
- [ ] Social media linked
- [ ] Test purchase completed
- [ ] Email notifications work

## Congratulations! 🎨

Your art gallery is now online! Start adding your beautiful artwork and share it with the world.

Questions? Check the detailed documentation in README.md and INSTALLATION.md.

**Happy Selling!** 🖼️
