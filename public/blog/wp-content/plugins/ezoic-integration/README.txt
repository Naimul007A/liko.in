=== Ezoic ===
Contributors: ezoic
Author URI: https://ezoic.com/
Plugin URL: https://wordpress.org/plugins/ezoic-integration/
Tags: ezoic, ads, monetization, ads.txt, site speed, cdn, seo, caching, cache, cloud, adstxt, optimization
Requires at least: 5.2.0
Tested up to: 6.0
Requires PHP: 5.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Ezoic plugin provides a simple and intuitive way to integrate and connect with the entire Ezoic technology platform.

== Description ==

The Ezoic plugin provides WordPress with features and settings for Ezoic on their website. This includes:

* **Automatic Ezoic ad placeholder insertion**
* **Website performance optimizations included in Ezoic Leap**
* **Ezoic caching and CDN settings**
* **Detection of conflicting plugins or WordPress theme settings**
* **Platform integration (if a site is not Cloud integrated)**
* **Create, manage, and validate your ads.txt**

Ezoic is a technology platform designed to help publishers improve every visitor session by using artificial intelligence to streamline ad revenue growth, testing, website performance SEO, and content.

Ezoic is used by everyone from independent website owners to major media brands.

For more information on the Ezoic platform and to use it on your website, visit [https://www.ezoic.com/](https://www.ezoic.com/).

== Installation ==

The plugin can be added by downloading it from our WordPress listing or by searching directly in the plugin directory from your WordPress admin dashboard.

= Using The Plugin For Initial Ezoic Integration: =

The Ezoic plugin can be used on its own for initial Ezoic integration. It is **NOT recommended** as a long-term integration method.

Sites can follow setup directions inside their Ezoic dashboard upon login to finish setting up Ezoic after integration is complete.

= Ezoic recommends switching to Cloud integration =

Ezoic’s plugin is best utilized alongside Cloud integration (via Cloudflare or by changing your nameservers at your host or registrar)

How to change from WordPress integration to Cloud integration:

[https://support.ezoic.com/kb/article/switching-from-wordpress-integration-to-ezoic-name-server-integration?id=switching-from-wordpress-integration-to-ezoic-name-server-integration](https://support.ezoic.com/kb/article/switching-from-wordpress-integration-to-ezoic-name-server-integration?id=switching-from-wordpress-integration-to-ezoic-name-server-integration)

---

= Setting up Ad Tester Placeholders: =

Ezoic’s WordPress plugin allows you to easily set up and adjust ad placeholders based on Ezoic's best practices.

The following guide will walk you through installing, activating and updating your placeholder setup within the Ezoic WordPress Plugin:

[https://support.ezoic.com/kb/article/setting-up-ad-tester-placeholders-with-the-ezoic-wordpress-plugin](https://support.ezoic.com/kb/article/setting-up-ad-tester-placeholders-with-the-ezoic-wordpress-plugin)

---

= Leap Optimization: =

It is recommended you install the Ezoic plugin to maximize performance while using Leap.

Cloud Integration is required to ensure the best performance when using Ezoic Leap. Without Cloud integration in place most of Leap’s features and the plugin’s benefits will not be available.

*Note: Installing and activating the Ezoic Plugin will not change your integration method if you are already Cloud Integrated.*

* **Step 1:** Download the Ezoic Plugin found here: [https://wordpress.org/plugins/ezoic-integration](https://wordpress.org/plugins/ezoic-integration/)

* **Step 2:** Navigate to the “Plugins” section of your WordPress dashboard

* **Step 3:** Complete the setup by activating the Plugin

---

= Using the super-fast Ezoic Cloud for caching and page loading: =

You will need to enable API access to the Ezoic Cloud to utilize caching features inside your site’s WordPress admin. This is located in the settings tab of the Ezoic user dashboard.

*Note: WordPress integrated sites are unable to use Ezoic Cloud caching unless they are Cloud Integrated.*


Once you have your API key from your Ezoic dashboard, it can be added to your Ezoic plugin settings inside the site’s WordPress admin dashboard under Ezoic > CDN settings.

== Changelog ==

= 2.7.19 =
* Minor bug fixes

= 2.7.18 =
* Add cache clearing for nav menu updates

= 2.7.17 =
* Minor bug fixes

= 2.7.16 =
* Minor bug fixes

= 2.7.15 =
* Minor bug fixes

= 2.7.14 =
* Minor bug fixes

= 2.7.13 =
* Minor user interface improvements

= 2.7.12 =
* Remove admin scripts from other plugins causing our settings page to fail

= 2.7.11 =
* Ad Settings: Category page support
* Ad Settings: Bug fixes

= 2.7.10 =
* Minor bug fixes

= 2.7.9 =
* Minor bug fixes

= 2.7.8 =
* Minor bug fixes

= 2.7.7 =
* CDN Settings: bug fixes

= 2.7.6 =
* CDN Settings: Minor bug fixes

= 2.7.5 =
* CDN Settings: Add setting for URLs to always purge

= 2.7.4 =
* Minor bug fixes

= 2.7.3 =
* Minor bug fixes

= 2.7.2 =
* Minor bug fixes

= 2.7.1 =
* Minor bug fixes

= 2.7.0 =
* Integration: Basic Ads support
* Ads.txt: Show required setup

= 2.6.36 =
* Ad Settings: Treat archive pages like posts

= 2.6.35 =
* Bug fixes

= 2.6.34 =
* Add revenue column next to placeholders
* Bug fixes

= 2.6.33 =
* CDN Settings: Minor bug fixes

= 2.6.32 =
* CDN Settings: Minor bug fixes

= 2.6.31 =
* CDN Settings: Add ability to automatically clear Facebook share cache

= 2.6.30 =
* Ad Settings: Fix interrupted placeholder generation

= 2.6.29 =
* Minor bug fixes

= 2.6.28 =
* Bug fix for cookie array values

= 2.6.27 =
* Ad Settings: Add support for top and bottom of page

= 2.6.26 =
* Minor bug fixes

= 2.6.25 =
* Minor bug fixes

= 2.6.24 =
* Minor bug fixes

= 2.6.23 =
* New authorization features

= 2.6.22 =
* Minor bug fixes

= 2.6.21 =
* Bug fixes

= 2.6.20 =
* Administrators can now disable ads by user roles

= 2.6.19 =
* Minor bug fixes

= 2.6.18 =
* WP Integration: Fix for legacy WP integrations

= 2.6.17 =
* WP Integration: Bug fix for disabled integration
* Ad Settings: Fix Twentig incompatibility

= 2.6.16 =
* Ad Settings: Rewrite of HTML Insertion engine
* Ad Settings: Update HTML Element Picker
* Minor bug fixes

= 2.6.15 =
* Ad Settings: Minor bug fixes related to parent filters

= 2.6.14 =
* Minor bug fixes

= 2.6.13 =
* Minor bug fixes

= 2.6.12 =
* Minor bug fixes

= 2.6.11 =
* Ad Settings: Update HTML Picker look and feel
* Ad Settings: Add URL Navigator to HTML Picker

= 2.6.10 =
* Ad Settings: Minor bug fix

= 2.6.9 =
* Changed destination URL for sending debug data

= 2.6.8 =
* Minor bug fixes

= 2.6.7 =
* Fix fallback WP integration check setting

= 2.6.6 =
* Minor Bug Fix
* Ad Settings: Compatibility Fixes

= 2.6.5 =
* Remove Ads.txt Manager tab when WP integration is disabled

= 2.6.4 =
* Ad Settings: Better handling of void and unclosed elements
* Ad Settings: Add ability to filter paragraphs based on word count

= 2.6.3 =
* Minor bug fixes

= 2.6.2 =
* Caching: Disable warning which occurs occasionally

= 2.6.1 =
* Minor bug fixes

= 2.6.0 =
* Ad Settings: Enable new parser/inserter for everyone
* Ad Settings: Include error reporting
