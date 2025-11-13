# Deployment Checklist for Zo's Art Gallery

## Pre-Deployment

- [ ] All code committed to repository
- [ ] Database schema reviewed and tested
- [ ] Configuration files prepared
- [ ] Documentation reviewed (README.md, INSTALLATION.md)

## Server Setup

- [ ] Hostinger account active
- [ ] Domain name configured (zomariaart.com)
- [ ] SSL certificate installed (HTTPS)
- [ ] PHP version 7.4+ confirmed
- [ ] MySQL 5.7+ available
- [ ] mod_rewrite enabled

## Database Setup

- [ ] Database created
- [ ] Database user created with strong password
- [ ] Schema imported (sql/schema.sql)
- [ ] Test connection successful
- [ ] Admin user exists in database

## File Upload

- [ ] All files uploaded to public_html/
- [ ] Correct directory structure verified
- [ ] File permissions set correctly:
  - [ ] 755 for directories
  - [ ] 644 for PHP files
  - [ ] 775 for images directory
- [ ] .htaccess file in place

## Configuration

- [ ] config/database.php updated with credentials
- [ ] config/config.php updated:
  - [ ] SITE_URL set to domain
  - [ ] SITE_EMAIL configured
  - [ ] Error reporting disabled for production
- [ ] SMTP settings configured for emails

## Security

- [ ] Admin password changed from default
- [ ] Database password is strong and unique
- [ ] HTTPS enforced (uncommented in .htaccess)
- [ ] Error display disabled in production
- [ ] Security headers configured
- [ ] File upload restrictions in place

## Testing

- [ ] Homepage loads correctly
- [ ] Gallery page displays
- [ ] Product details work
- [ ] Cart functionality tested
- [ ] Checkout process tested
- [ ] Admin login works
- [ ] Admin dashboard accessible
- [ ] Product management tested
- [ ] Order management tested
- [ ] Class management tested
- [ ] Contact form submits
- [ ] Mobile responsive verified
- [ ] All links working
- [ ] Images loading properly
- [ ] JavaScript working (no console errors)

## Content

- [ ] Replace placeholder images
- [ ] Add actual products
- [ ] Upload artwork images
- [ ] Create initial classes
- [ ] Update About page with bio
- [ ] Add social media links
- [ ] Update contact information
- [ ] Add featured products

## Payment Gateway

- [ ] Stripe/PayPal account created
- [ ] API keys configured
- [ ] Test transaction completed
- [ ] Payment flow tested end-to-end
- [ ] Order confirmation emails working

## SEO & Marketing

- [ ] Meta descriptions added
- [ ] Alt text on images
- [ ] Sitemap.xml created
- [ ] robots.txt configured
- [ ] Google Analytics added (optional)
- [ ] Social media Open Graph tags
- [ ] Submitted to search engines

## Email Configuration

- [ ] SMTP settings tested
- [ ] Order confirmation emails work
- [ ] Contact form emails delivered
- [ ] Newsletter signup functional

## Performance

- [ ] Page load speed tested
- [ ] Images optimized
- [ ] Caching headers configured
- [ ] Compression enabled

## Backup

- [ ] Backup system configured
- [ ] Database backup scheduled
- [ ] File backup scheduled
- [ ] Backup restoration tested

## Launch

- [ ] All checklist items completed
- [ ] Final testing round done
- [ ] Stakeholders notified
- [ ] Launch announcement prepared
- [ ] Monitor site for first 24 hours

## Post-Launch

- [ ] Monitor error logs daily (first week)
- [ ] Check order flow works correctly
- [ ] Verify email notifications
- [ ] Test from different devices
- [ ] Check analytics setup
- [ ] Gather initial feedback
- [ ] Plan regular maintenance schedule

## Maintenance Schedule

### Daily
- Check for new orders
- Respond to contact inquiries
- Monitor error logs

### Weekly
- Review sales reports
- Update inventory if needed
- Backup database
- Check for security updates

### Monthly
- Review analytics
- Update content as needed
- Test all functionality
- Review and optimize images
- Check broken links
- Review customer feedback

### Quarterly
- Full security audit
- Performance optimization review
- Content refresh
- Marketing campaign review
- Feature enhancement planning

## Emergency Contacts

- Hostinger Support: [support link]
- Database Administrator: [contact]
- Developer: [contact]
- Domain Registrar: [contact]

## Useful Links

- Admin Dashboard: https://zomariaart.com/index.php?page=admin
- phpMyAdmin: [from Hostinger panel]
- File Manager: [from Hostinger panel]
- Email Accounts: [from Hostinger panel]
- SSL Certificate: [from Hostinger panel]

---

**Remember**: Always test changes in a staging environment before deploying to production!
