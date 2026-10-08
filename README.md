# iPhone Deals PHP starter

A responsive PHP catalog and session cart scaffold. **This is not ready to accept live orders.** The product catalog in `includes/functions.php` is demonstration content: product existence, device condition, prices, stock, supported configurations, images and specifications require merchant verification. Checkout intentionally has no payment button until secure order creation, shipping/tax calculation, PayPal capture, order persistence and notifications have been completed and tested.

## Run locally

Requires PHP 8.1+ with PDO MySQL for database tools. Copy `.env.example` to `.env`, set `APP_URL`, and run `php -S 127.0.0.1:8000`. Browse `http://127.0.0.1:8000`.

The storefront selects Japanese for requests identified as coming from Japan by the hosting provider, Japanese browser language, or a browser set to the `Asia/Tokyo` time zone. Visitors can switch language from the navigation. Japanese prices are converted from the demo USD catalog using `JPY_PER_USD` (defaults to 150); set that environment value to the rate your store uses. This display conversion does not configure payment processing or live exchange rates.

Import `database.sql` into MySQL, then run `php database-seed.php` from a trusted local shell to create **draft** product rows. Review and configure those rows before activation. Never expose the seed script in production. The storefront demo currently reads its catalog from PHP seed data, not those SQL rows.

## Before launch

- Replace demo catalog with verified live inventory, licensed product photos, supported storage/colors, exact specifications, prices and stock.
- Implement database-backed catalog/admin CRUD and order processing; add admin provisioning and authorization.
- Configure sales tax, shipping rates, address validation, inventory reservation and reconciliation.
- Complete PayPal server-side create/capture and verify capture amount/currency/status before recording an order. Keep credentials outside source control.
- Configure SMTP and customer/merchant notifications; implement a real contact form delivery.
- Set return period, refurb grading/battery standard, warranty, shipping, business address/phone, privacy disclosures and terms with appropriate review.
- Serve HTTPS, configure backups, error logging, security headers, rate limiting, and production session settings.

`.env` is ignored. The contact form validates input and includes a honeypot/time check but email sending is disabled. Product art is an original illustration, not product photography; replace it with imagery you have rights to use before sale.
