# Client and Admin Area Features Documentation

## Overview
This document describes the new client account management and admin CRM features implemented for Zo Maria Art website.

## Features Implemented

### 1. Client Area (Customer Portal)

#### Customer Dashboard (`/index.php?page=client`)
- **Overview**: Central hub for customer account management
- **Features**:
  - Welcome message with username
  - Quick navigation to profile, orders, and classes
  - Recent orders summary (last 5 orders)
  - Enrolled classes overview
  - Quick links to browse gallery and classes

#### Order Management (`/index.php?page=client&action=orders`)
- **Order History**: Complete list of all customer orders
- **Order Details**: Each order card displays:
  - Order number and date
  - Total amount
  - Payment status (pending, completed, failed, refunded)
  - Order status (pending, processing, shipped, delivered, cancelled)
  - Direct link to detailed order view

#### Order Detail View (`/index.php?page=client&action=viewOrder&id=X`)
- **Comprehensive Order Information**:
  - Order number and placement date
  - Order and payment status badges
  - Itemized list of products with options
  - Price breakdown (subtotal, tax, shipping)
  - Shipping and billing addresses
  - Contact information
  - Order notes (if any)
  - Link to contact support

#### Profile Management (`/index.php?page=client&action=profile`)
- **Account Settings**:
  - Update username
  - Update email address
  - Change password
  - View account type (customer/admin)
  - View member since date
- **Security**: CSRF token protection, password confirmation

#### Class Enrollments (`/index.php?page=client&action=classes`)
- **My Classes**: List of all enrolled classes
- **Class Details**:
  - Class title and description
  - Date, time, and location
  - Payment status
  - Enrollment date
  - Class notes

#### Customer Registration (`/index.php?page=register`)
- **New Account Creation**:
  - Username selection
  - Email registration
  - Password creation with confirmation
  - Automatic redirect after registration
  - Duplicate username/email prevention

### 2. Admin Area Enhancements

#### Payment Management Dashboard (`/index.php?page=admin&action=payments`)
- **Payment Statistics**:
  - Total revenue from completed payments
  - Number of completed payments
  - Pending payments count
  - Failed payments count
  
- **Payment Filtering**:
  - Filter by status: All, Pending, Completed, Failed, Refunded
  - Real-time table filtering via JavaScript
  
- **Transaction Management**:
  - Complete order list with payment details
  - Customer name and email
  - Amount and payment method
  - Payment and order status
  - Quick access to order details

#### Enhanced Order Details (`/index.php?page=admin&action=viewOrder&id=X`)
- **Payment Status Management**:
  - Update payment status dropdown
  - Options: Pending, Completed, Failed, Refunded
  - Separate form for payment status updates
  
- **Order Status Management**:
  - Update order status dropdown
  - Options: Pending, Processing, Shipped, Delivered, Cancelled
  - Separate form for order status updates

### 3. Navigation & Access Control

#### Header Navigation
- **Logged Out Users**: 
  - Login link
  - Shopping cart
  
- **Logged In Customers**:
  - "My Account" link
  - Logout link
  - Shopping cart
  
- **Logged In Admins**:
  - "Admin" link
  - Logout link
  - Shopping cart

#### Admin Sidebar
- Dashboard
- Products
- Orders
- **Payments** (NEW)
- Classes
- View Site
- Logout

### 4. Security Features

#### Authentication
- `requireLogin()` - Requires user to be logged in (any role)
- `requireAdmin()` - Requires user to have admin role
- Session-based authentication
- Automatic redirects for unauthorized access

#### Data Protection
- **CSRF Token Protection**: All forms protected with CSRF tokens
- **Customer Data Isolation**: Customers can only view their own orders
- **Email Verification**: Orders verified by customer email before display
- **Password Security**: 
  - Minimum 6 characters
  - Passwords hashed with `password_hash()`
  - Password confirmation required

#### Input Validation
- HTML entity encoding with `sanitize()`
- Email validation with `validateEmail()`
- SQL injection prevention via PDO prepared statements

## Database Requirements

### Existing Tables (No Changes Required)
- `users` - For customer and admin accounts
- `orders` - For order management
- `order_items` - For order line items
- `classes` - For class/workshop management
- `class_enrollments` - For student enrollments

### Sample Data
Default admin user already exists:
- Username: `admin`
- Email: `admin@zomariaart.com`
- Password: `admin123` (should be changed in production)

## URL Routes

### Public Routes
- `/index.php?page=login` - Login page
- `/index.php?page=register` - Registration page
- `/index.php?page=logout` - Logout action

### Customer Routes (Requires Login)
- `/index.php?page=client` - Customer dashboard
- `/index.php?page=client&action=orders` - Order history
- `/index.php?page=client&action=viewOrder&id=X` - Order details
- `/index.php?page=client&action=profile` - Profile management
- `/index.php?page=client&action=classes` - Class enrollments
- `/index.php?page=account` - Alias for client dashboard

### Admin Routes (Requires Admin Role)
- `/index.php?page=admin` - Admin dashboard
- `/index.php?page=admin&action=products` - Product management
- `/index.php?page=admin&action=orders` - Order management
- `/index.php?page=admin&action=payments` - Payment management (NEW)
- `/index.php?page=admin&action=viewOrder&id=X` - Order details
- `/index.php?page=admin&action=classes` - Class management

## Technical Implementation

### New Files Created
```
app/controllers/ClientController.php       - Customer portal controller
app/views/client/dashboard.php            - Customer dashboard
app/views/client/orders.php                - Order history list
app/views/client/order_detail.php         - Order detail view
app/views/client/profile.php              - Profile management
app/views/client/classes.php              - Class enrollments
app/views/auth/register.php               - Registration form
app/views/admin/payments.php              - Payment management
```

### Modified Files
```
app/controllers/AdminController.php        - Added payment methods
app/controllers/AuthController.php         - Added registration methods
app/models/Order.php                       - Added getByCustomerEmail()
app/models/ClassModel.php                  - Added getEnrollmentsByEmail()
app/views/layouts/header.php               - Enhanced navigation
app/views/layouts/admin_header.php         - Added payments link
app/views/admin/order_detail.php           - Added payment controls
config/helpers.php                         - Added requireLogin()
public/index.php                           - Added client & register routes
```

### Code Patterns
- **MVC Architecture**: Controllers handle logic, views display data
- **Data Access**: PDO with prepared statements
- **Session Management**: PHP sessions for authentication
- **Flash Messages**: Session-based success/error messages
- **Inline CSS**: Styling included in view files for simplicity

## Testing Recommendations

### Manual Testing Checklist

#### Customer Registration & Login
- [ ] Register new customer account
- [ ] Verify duplicate username prevention
- [ ] Verify duplicate email prevention
- [ ] Login with new account
- [ ] Verify redirect to customer dashboard

#### Customer Dashboard
- [ ] View dashboard overview
- [ ] Navigate to orders page
- [ ] Navigate to profile page
- [ ] Navigate to classes page
- [ ] Verify only customer's own data is shown

#### Order Management
- [ ] View order history
- [ ] View order details
- [ ] Verify order status displays correctly
- [ ] Verify payment status displays correctly
- [ ] Attempt to access another customer's order (should fail)

#### Profile Management
- [ ] Update username
- [ ] Update email
- [ ] Change password
- [ ] Verify validation errors
- [ ] Verify password confirmation

#### Admin Payment Dashboard
- [ ] View payment statistics
- [ ] Filter by payment status
- [ ] View all transactions
- [ ] Access order details from payments page
- [ ] Update payment status
- [ ] Verify statistics update

#### Admin Order Management
- [ ] Update order status
- [ ] Update payment status
- [ ] Verify both updates work independently
- [ ] View order details

## Future Enhancements

### Potential Improvements
1. **Email Notifications**: Send order confirmations and status updates
2. **Password Reset**: Forgot password functionality
3. **Order Tracking**: Real-time shipping tracking integration
4. **Invoice Generation**: PDF invoice downloads
5. **Payment Gateway Integration**: Stripe/PayPal processing
6. **Advanced Filtering**: Date ranges, amount filters
7. **Export Functionality**: Export orders and payments to CSV/Excel
8. **Customer Reviews**: Allow customers to review products
9. **Wishlist**: Save products for later
10. **Order History Search**: Search orders by number, product, date

### Performance Optimizations
1. **Pagination**: Add pagination for large order lists
2. **Caching**: Cache frequently accessed data
3. **Database Indexes**: Optimize queries with proper indexes
4. **Lazy Loading**: Load images and data on demand

## Support & Maintenance

### Common Issues

**Issue**: Customer can't see their orders
- **Solution**: Verify email address matches order records

**Issue**: Can't update payment status
- **Solution**: Check admin permissions and CSRF token

**Issue**: Registration fails
- **Solution**: Check for duplicate username/email

### Logging
- PHP error logs: Check server error logs
- Flash messages: User-friendly feedback in UI
- Session debugging: Check $_SESSION contents

### Security Maintenance
- Regularly update PHP version
- Keep dependencies updated
- Review access logs for suspicious activity
- Change default admin password
- Enable HTTPS in production (set ENABLE_HTTPS = true)

## Conclusion

This implementation provides a complete customer account management system and admin CRM dashboard for managing orders and payments. The system is secure, user-friendly, and follows best practices for web application development.
