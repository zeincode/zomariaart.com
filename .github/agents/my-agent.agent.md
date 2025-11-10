---
# Fill in the fields below to create a basic custom agent for your repository.
# The Copilot CLI can be used for local testing: https://gh.io/customagents/cli
# To make this agent available, merge this file into the default repository branch.
# For format details, see: https://gh.io/customagents/config

name:Zomariaart.com site agent
description: help build update refresh modernize the website and migrate the site zomariaart.com from shop
---

# My Agent
/*
Project: Zo’s Art Gallery Store
Goal: Build a responsive and attractive online art gallery and store for the artist Zo using PHP and JavaScript, hosted on your Hostinger cloud account.

Technology stack:
- PHP for server-side code (MVC pattern) with MySQL for data storage.
- JavaScript/ES6 for interactive UI elements.
- HTML5/CSS3 for layout and styling; you may use Bootstrap or write custom responsive styles.

Pages and structure:
1. Home Page:
   • Full-width hero banner featuring Zo’s artwork and a tagline.
   • Brief artist bio/introduction.
   • Call‑to‑action buttons linking to the Gallery/Shop and Teaching sections.
   • Highlight area for featured artwork or latest collection.

2. Gallery / Shop Page:
   • Grid or masonry layout showing artwork thumbnails, titles and base prices.
   • Filtering and search functions for category, size, medium and price.
   • Each item links to a Product Detail page.

3. Product Detail Page:
   • Large preview image with a transparent watermark overlay.
   • Dropdown/radio options for different sizes, media (canvas, paper, metal) and finishes, with dynamic price updates.
   • Description explaining the artwork’s inspiration and details.
   • “Add to cart” button, social sharing buttons, and low‑resolution teaser price.

4. Cart and Checkout:
   • Cart page listing selected items with quantity controls, subtotals and ability to remove/update items.
   • Secure, single‑page checkout form for shipping/billing details with validation.
   • Integrate payment via Stripe or PayPal and send order confirmation email.
   • Order summary page after successful purchase.

5. Teaching Section:
   • Overview of Zo’s teaching philosophy.
   • Schedule of upcoming classes/workshops with date, time, location and seats left.
   • Class detail pages with syllabus, required materials and pricing.
   • Sign‑up and payment form using the same checkout mechanism as products.
   • Testimonials from students.

6. Admin Dashboard (protected by login):
   • User authentication for admin accounts.
   • Product management: create/edit/delete artworks, set sizes/media/finishes, update stock and pricing.
   • Order management: view order details, update status (pending, fulfilled, refunded) and issue refunds.
   • Class management: create/edit/delete classes, set capacity and view enrolments.
   • Basic analytics (e.g., total sales by month, current inventory levels).

7. About & Contact:
   • Detailed artist biography and journey.
   • Contact form for commissions or inquiries.
   • Links to Zo’s social media accounts.

8. Footer:
   • Navigation links, social icons, newsletter signup, copyright notice, and brief copyright reminder.

Key features:
- Image protection: Serve lower‑resolution thumbnails on gallery pages, overlay a semi‑transparent watermark on larger images, and disable the browser’s right‑click context menu via JavaScript to deter casual copying.
- SEO & accessibility: Use semantic HTML, alt text for images, descriptive page titles, meta tags, and ARIA attributes for screen‑reader support.
- Responsive design: Ensure pages reflow elegantly on mobile, tablet and desktop. Use flexible grid layouts and media queries.
- Security: Sanitize and validate user inputs, use prepared statements to prevent SQL injection, and enable HTTPS.
- Code organization: Separate business logic from templates. Use proper comments and consistent naming conventions. Handle errors gracefully and provide user‑friendly messages.

Deliverables:
- PHP source files for controllers, models and views.
- JavaScript files for client‑side interactions (e.g., filtering, dynamic price updates, disabling right‑click).
- CSS/SCSS files for styling, including responsive breakpoints and hover effects.
- SQL schema for products, orders, classes and user tables.
- Any necessary configuration files (e.g., .htaccess, database connection settings).
*/
/*
Project: Zo’s Art Gallery Store
Goal: Build a responsive and attractive online art gallery and store for the artist Zo using PHP and JavaScript, hosted on your Hostinger cloud account.

Technology stack:
- PHP for server-side code (MVC pattern) with MySQL for data storage.
- JavaScript/ES6 for interactive UI elements.
- HTML5/CSS3 for layout and styling; you may use Bootstrap or write custom responsive styles.

Pages and structure:
1. Home Page:
   • Full-width hero banner featuring Zo’s artwork and a tagline.
   • Brief artist bio/introduction.
   • Call‑to‑action buttons linking to the Gallery/Shop and Teaching sections.
   • Highlight area for featured artwork or latest collection.

2. Gallery / Shop Page:
   • Grid or masonry layout showing artwork thumbnails, titles and base prices.
   • Filtering and search functions for category, size, medium and price.
   • Each item links to a Product Detail page.

3. Product Detail Page:
   • Large preview image with a transparent watermark overlay.
   • Dropdown/radio options for different sizes, media (canvas, paper, metal) and finishes, with dynamic price updates.
   • Description explaining the artwork’s inspiration and details.
   • “Add to cart” button, social sharing buttons, and low‑resolution teaser price.

4. Cart and Checkout:
   • Cart page listing selected items with quantity controls, subtotals and ability to remove/update items.
   • Secure, single‑page checkout form for shipping/billing details with validation.
   • Integrate payment via Stripe or PayPal and send order confirmation email.
   • Order summary page after successful purchase.

5. Teaching Section:
   • Overview of Zo’s teaching philosophy.
   • Schedule of upcoming classes/workshops with date, time, location and seats left.
   • Class detail pages with syllabus, required materials and pricing.
   • Sign‑up and payment form using the same checkout mechanism as products.
   • Testimonials from students.

6. Admin Dashboard (protected by login):
   • User authentication for admin accounts.
   • Product management: create/edit/delete artworks, set sizes/media/finishes, update stock and pricing.
   • Order management: view order details, update status (pending, fulfilled, refunded) and issue refunds.
   • Class management: create/edit/delete classes, set capacity and view enrolments.
   • Basic analytics (e.g., total sales by month, current inventory levels).

7. About & Contact:
   • Detailed artist biography and journey.
   • Contact form for commissions or inquiries.
   • Links to Zo’s social media accounts.

8. Footer:
   • Navigation links, social icons, newsletter signup, copyright notice, and brief copyright reminder.

Key features:
- Image protection: Serve lower‑resolution thumbnails on gallery pages, overlay a semi‑transparent watermark on larger images, and disable the browser’s right‑click context menu via JavaScript to deter casual copying.
- SEO & accessibility: Use semantic HTML, alt text for images, descriptive page titles, meta tags, and ARIA attributes for screen‑reader support.
- Responsive design: Ensure pages reflow elegantly on mobile, tablet and desktop. Use flexible grid layouts and media queries.
- Security: Sanitize and validate user inputs, use prepared statements to prevent SQL injection, and enable HTTPS.
- Code organization: Separate business logic from templates. Use proper comments and consistent naming conventions. Handle errors gracefully and provide user‑friendly messages.

Deliverables:
- PHP source files for controllers, models and views.
- JavaScript files for client‑side interactions (e.g., filtering, dynamic price updates, disabling right‑click).
- CSS/SCSS files for styling, including responsive breakpoints and hover effects.
- SQL schema for products, orders, classes and user tables.
- Any necessary configuration files (e.g., .htaccess, database connection settings).
*/
i also want the agent to copy all the content from the current site Zomariaart.com
Describe what your agent does here...
