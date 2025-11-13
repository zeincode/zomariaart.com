# Configuration Setup

## Important: Config Files with Credentials

The following files contain sensitive credentials and are **NOT tracked in Git**:

- `config/config.php`
- `config/database.php`

## Setting Up Configuration

### For New Installation:

1. Copy the example files:
   ```bash
   cp config/config.example.php config/config.php
   cp config/database.example.php config/database.php
   ```

2. Edit `config/database.php` with your database credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'your_database_name');
   define('DB_USER', 'your_database_user');
   define('DB_PASS', 'your_database_password');
   ```

3. Edit `config/config.php` with your site settings:
   - Update `SITE_URL` for your domain
   - Set `ENABLE_HTTPS` to `true` for production
   - Configure payment gateway keys (Stripe, PayPal)
   - Configure SMTP email settings

### For Local Development:

Your local config files are already set up and will stay on your machine. They won't be committed to version control.

### For Production Deployment:

1. Create new `config.php` and `database.php` from the `.example.php` templates
2. Use production credentials (never commit these!)
3. Enable HTTPS in production
4. Disable error display in production

## Security Note

⚠️ **Never commit files with real credentials to Git!**

The `.gitignore` file is configured to exclude these files automatically.
