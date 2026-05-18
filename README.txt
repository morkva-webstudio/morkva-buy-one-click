=== morkva quick order button ===
Contributors: bandido, dpmine
Tags: woocommerce, quick order, buy now, request a quote, order button
Requires at least: 5.2
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 0.3.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add a quick order button to WooCommerce product pages. Customers send a short form, your manager gets the order — no cart needed.

== Description ==

**morkva quick order button** lets customers place an order request directly from the product page — without going through the WooCommerce cart and checkout.

A customer clicks the button, fills in their name and phone number, and submits. An order is instantly created in your WooCommerce dashboard, ready for your sales manager to follow up.

**Perfect for stores where a human is part of the sales process.**

= Who needs this? =

* Stores with a sales manager who confirms orders by phone
* Shops selling products without a fixed price — where the customer needs a quote first
* Stores selling complex, custom, or high-ticket products
* Any shop where the standard WooCommerce checkout feels like too much friction

= How it works =

1. Install and activate the plugin
2. A "Buy now" button appears on your product pages
3. Customer clicks → fills a short form → an order is created in WooCommerce
4. Your manager sees the order and contacts the customer

= Request a Quote mode =

Selling products without a price? Enable **Request a Quote** mode: when a simple product has no price set, the button automatically turns into "Get a quote". The customer submits the same short form, and the order is tagged as a quote request so your manager knows it needs a price before confirmation.

= Free version features =

* Quick order button on single product pages
* Simple popup form — name and phone only
* Works with simple products
* Request a Quote mode for simple products without a price
* Custom button and form text
* Button placement: after the Add to Cart button, in the product summary, or anywhere via the `[mrkv_buy_one_click]` shortcode
* Orders are created with the "On hold" status
* Native Flatsome theme support

= Pro version features =

* Variable products and all other product types
* Request a Quote mode for variable products, with per-variation switching
* Custom order status for new quick orders
* Full style controls — colors, fonts, and border radius
* Product info (image, title, price) shown inside the popup
* Priority support

[Upgrade to Pro](https://morkva.co.ua/en/product/quick-order-button-pro/)

= Why not just use a "Buy Now" plugin? =

Most "Buy Now" plugins skip the cart and push customers straight to the WooCommerce checkout. That works for simple B2C stores — but if your sales process involves a manager, custom pricing, or a follow-up call, you need an **order request**, not a forced checkout.

morkva quick order button creates a WooCommerce order with the "On hold" status. Your team handles it from there.

= Compatibility =

* WooCommerce 5.4+
* WordPress 5.2+
* PHP 7.4+
* WooCommerce HPOS (High-Performance Order Storage) — supported
* Flatsome theme — native support
* Translation-ready (WPML / Polylang compatible)

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/morkva-buy-one-click` directory, or install the plugin through the WordPress plugins screen.
2. Activate the plugin through the "Plugins" screen in WordPress.
3. Open the **morkva quick order button** menu in your WordPress admin to configure the button and form.
4. The button appears automatically on single product pages. To place it manually, use the `[mrkv_buy_one_click]` shortcode.

== Frequently Asked Questions ==

= Can I use this with variable products? =

The free version supports simple products. Variable product support is available in the [Pro version](https://morkva.co.ua/en/product/quick-order-button-pro/).

= Can I choose where the button appears? =

Yes. Show it automatically after the Add to Cart button, in the product summary, or insert it manually anywhere with the `[mrkv_buy_one_click]` shortcode.

= What happens after the customer submits the form? =

A WooCommerce order is created with the "On hold" status, and the store admin receives a standard WooCommerce new order notification.

= How does Request a Quote mode work? =

When the mode is enabled and a simple product has no price, the button turns into "Get a quote". The submitted order is marked as a quote request (order meta `_mrkv_is_quote_request`) and gets an order note, so your manager can see it needs a price.

= Can I change the button text? =

Yes. You can set custom text for the open button and the form submit button in the plugin settings — separately for normal mode and Request a Quote mode.

= Will it conflict with other plugins or my theme? =

The plugin is lightweight and uses standard WooCommerce hooks, so conflicts are unlikely. It has native support for the Flatsome theme. If you find a conflict, contact our support and we'll investigate.

= Is there a Pro version? =

Yes. [Quick Order Button Pro](https://morkva.co.ua/en/product/quick-order-button-pro/) adds variable products, Request a Quote for variations, custom order status, full style controls, product info in the popup, and priority support.

== Screenshots ==

1. Quick order button on a product page
2. The quick order popup form
3. Request a Quote button on a product without a price
4. Plugin settings page

== Changelog ==

= 0.3.0 =
* [new] Request a Quote mode — for simple products without a price the button turns into "Get a quote"; the order is tagged as a quote request with an order note.
* [new] Separate custom text for the Request a Quote open and submit buttons.
* WOO 10.7.0 - compatible

= 0.2.7 =
* WOO 10.5.0 - compatible

= 0.2.6 =
* [new] added default country selection for numbers from WooCommerce settings.
* [fix] fixed the display of the button in the after_add_to_cart_button hook.

= 0.2.5 =
* [new] changed plugin name
* [fix] fixed settings field

= 0.2.4 =
* WP 6.9 - compatible

= 0.2.3 =
* [fix] change order creator function

= 0.2.2 =
* [new] added new position

= 0.2.1 =
* [fix] fixed settings color button

= 0.2.0 =
* Initial release with support for simple products and minimal form.
