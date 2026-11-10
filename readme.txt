=== SEO Pro Custom ===
Contributors: wpallstars
Donate link: https://buymeacoffee.com/marcusquinn
Tags: customization, custom code, developer, template, wpallstars
Requires at least: 6.2
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 0.1.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Your site's own changes, one file each, in your own repository, switched off when an SEO Pro Stack product does the same.

== Description ==

SEO Pro Custom is for owners of sites built on SEO Pro Stack who want their own changes now, without waiting for a theme or plugin release. Make a private copy of its repository, add one file per change, and deploy it to your sites; the copy installed on each site is empty until you do. Ask for useful changes upstream, and switch your file off once an SEO Pro Stack product does the same.

* **A loader for your own changes**: each `customizations/*.php` file loads on its own, with headers for what it does, which sites, what it requires, the upstream request and when it can be retired. A file with a PHP error is reported and skipped.
* **A style and script per change**, loaded after the theme's styles while the file is loaded.
* **Four states**: loaded, skipped, retired and failed, in Tools → Site Health, on the settings screen and in `wp seoprocustom list --format=json`.
* **Nothing when empty**: no front-end output and no database queries without customisation files.
* **A Read Me tab** that shows the plugin's README.md, banner included, and multisite settings.
* **Report a problem** (Tools): the site's AI assistant drafts problem reports and improvements for wpallstars plugins and themes; an administrator reviews and sends them.

Make your own copy on GitHub (wpallstars/seoprocustom, Use this template): the Read Me tab explains how.

= Built with AI =

SEO Pro Custom is built and maintained with aidevops (https://aidevops.sh), the same developer's open-source AI harness for creating and managing anything online with AI.

Questions about using or changing SEO Pro Custom: ask aidevops. It reads the plugin's docs and code to answer, and can report a problem for you.

Made from WP Plugin Starter (https://github.com/wpallstars/wp-plugin-starter-template-for-ai-coding), the wpallstars starter plugin.

== Installation ==

1. Upload the `seoprocustom` folder to `/wp-content/plugins/`, or install the zip from Plugins → Add New → Upload Plugin.
2. Activate it, then open Settings → SEO Pro Custom.

== Frequently Asked Questions ==

= Does it do anything on its own? =

No. Until you add customisation files to its `customizations` folder it adds nothing to the front end and runs no database queries. It has a settings screen, a Read Me tab and Tools → Report a problem.

= How do I add a change? =

Make your own private copy of the repository with Use this template, add one file per change to `customizations/` (see its README.md), and update the site from your copy's release.

= Where do I get help? =

Ask aidevops (https://aidevops.sh): open the plugin's repository, or your site, with it and ask. To report a problem or suggest an improvement, use Tools → Report a problem (also the Support link on the settings screen). Your site's AI assistant can draft reports there too; nothing is sent until an administrator reviews and sends it.

= Does it contact other services? =

No. The WordPress.org build contacts nothing outside WordPress. A problem report goes out only when an administrator sends it from Tools → Report a problem: as a GitHub issue they submit themselves, or by email with the site's own mailer for plugins and themes whose code is private.

= When do versions reach WordPress.org? =

GitHub releases are the stable beta channel: each version comes out there first. WordPress.org gets it 30 days later, except security releases, which come out on both at once.

== Screenshots ==

1. The settings screen (Settings → SEO Pro Custom) on the General tab, empty until features add settings.
2. The Read Me tab, showing the plugin's README.md inside WordPress.

== Changelog ==

= 0.1.0 =
* First version: loads your own changes from customizations/, reported in Site Health and WP-CLI.

Every change: changelog.txt.
