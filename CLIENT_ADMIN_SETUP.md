# Client and Admin Area Setup Guide

## Quick Start

The client and admin areas are now fully functional. No additional setup is required beyond the existing database and configuration.

## Default Access

### Admin Account
- **URL**: `http://zomariaart.local/index.php?page=admin`
- **Username**: `admin`
- **Email**: `admin@zomariaart.com`
- **Password**: `admin123`
- **⚠️ IMPORTANT**: Change this password immediately in production!

### Customer Registration
- **URL**: `http://zomariaart.local/index.php?page=register`
- Customers can create their own accounts
- No admin approval required

## How to Use

### For Customers

1. **Create an Account**
   - Go to `/index.php?page=register`
   - Fill in username, email, and password
   - Click "Create Account"

2. **Login**
   - Go to `/index.php?page=login`
   - Enter username/email and password
   - Click "Login"

3. **Access Your Dashboard**
   - After login, click "My Account" in the navigation
   - View orders, manage profile, see enrolled classes

4. **View Orders**
   - From dashboard, click "My Orders"
   - Click any order to see full details
   - Track payment and shipping status

5. **Update Profile**
   - From dashboard, click "My Profile"
   - Update username, email, or password
   - Click "Update Profile"

### For Admins

1. **Login**
   - Go to `/index.php?page=login`
   - Use admin credentials
   - You'll be redirected to admin dashboard

2. **Manage Orders**
   - Click "Orders" in sidebar
   - Click any order to view details
   - Update order status or payment status

3. **Manage Payments**
   - Click "Payments" in sidebar
   - View revenue statistics
   - Filter by payment status
   - Click any order to manage payment

4. **Manage Products**
   - Click "Products" in sidebar
   - Add, edit, or delete products
   - Set pricing and inventory

5. **Manage Classes**
   - Click "Classes" in sidebar
   - Add, edit, or delete classes
   - View enrollments

## Navigation Overview

### Public Navigation (Not Logged In)
```
Home | Gallery | Classes | About | Contact | Login | Cart
```

### Customer Navigation (Logged In)
```
Home | Gallery | Classes | About | Contact | My Account | Logout | Cart
```

### Admin Navigation (Logged In as Admin)
```
Home | Gallery | Classes | About | Contact | Admin | Logout | Cart
```

## Features by Role

### Customer Features
✅ View order history  
✅ View order details with tracking  
✅ Update account profile  
✅ Change password  
✅ View enrolled classes  
✅ Manage account information  

### Admin Features
✅ View all orders  
✅ Update order status  
✅ Update payment status  
✅ View payment statistics  
✅ Filter payments by status  
✅ Manage products (add, edit, delete)  
✅ Manage classes (add, edit, delete)  
✅ View customer information  

## Status Values

### Order Status
- **Pending**: Order received, awaiting processing
- **Processing**: Order is being prepared
- **Shipped**: Order has been shipped
- **Delivered**: Order has been delivered
- **Cancelled**: Order was cancelled

### Payment Status
- **Pending**: Payment not yet received
- **Completed**: Payment successfully processed
- **Failed**: Payment attempt failed
- **Refunded**: Payment was refunded

## Security Notes

### For Production Use

1. **Change Default Admin Password**
   ```sql
   UPDATE users 
   SET password_hash = '$2y$10$...' -- Generate new hash
   WHERE username = 'admin';
   ```

2. **Enable HTTPS**
   - Edit `config/config.php`
   - Set `ENABLE_HTTPS` to `true`

3. **Update Email Settings**
   - Configure SMTP settings in `config/config.php`
   - Set proper sender email address

4. **Configure Payment Gateways**
   - Add Stripe API keys
   - Add PayPal credentials

### Security Best Practices
- ✅ CSRF tokens on all forms
- ✅ Password hashing with bcrypt
- ✅ SQL injection prevention with PDO
- ✅ HTML entity encoding for output
- ✅ Session-based authentication
- ✅ Role-based access control

## Troubleshooting

### Can't Access Admin Area
**Problem**: Redirected to login page  
**Solution**: Make sure you're logged in with an admin account

### Customer Can't See Orders
**Problem**: Order list is empty  
**Solution**: Orders are matched by email address. Verify the email in the order matches the customer's account email

### Can't Update Order Status
**Problem**: Changes don't save  
**Solution**: 
1. Check browser console for errors
2. Verify CSRF token is present
3. Check PHP error logs

### Registration Fails
**Problem**: "Failed to create account" error  
**Solution**: Username or email already exists. Try different credentials

### Flash Messages Don't Show
**Problem**: Success/error messages not appearing  
**Solution**: Check that sessions are working and flash message code is in layout header

## Database Queries

### Check Admin Users
```sql
SELECT * FROM users WHERE role = 'admin';
```

### Check Customer Orders
```sql
SELECT o.*, u.email 
FROM orders o 
JOIN users u ON o.customer_email = u.email 
WHERE u.id = ?;
```

### View Payment Statistics
```sql
SELECT 
    COUNT(*) as total_orders,
    SUM(total) as total_revenue,
    payment_status,
    order_status
FROM orders 
GROUP BY payment_status, order_status;
```

## Testing the Implementation

### Test Customer Flow
1. Register new customer account
2. Login with new account
3. Verify dashboard shows welcome message
4. Check "My Orders" (should be empty for new account)
5. Update profile information
6. Change password
7. Logout and login with new password

### Test Admin Flow
1. Login as admin
2. View admin dashboard
3. Click "Payments" - verify statistics
4. Filter payments by status
5. Click "Orders" - verify order list
6. Click an order - update status
7. Verify flash message shows success

## Support

For issues or questions:
1. Check this documentation
2. Review FEATURE_DOCUMENTATION.md for detailed info
3. Check PHP error logs
4. Review browser console for JavaScript errors

## Additional Resources

- **Main Documentation**: See FEATURE_DOCUMENTATION.md
- **Installation Guide**: See INSTALLATION.md
- **Quick Start**: See QUICK_START.md
- **Database Schema**: See sql/schema.sql
