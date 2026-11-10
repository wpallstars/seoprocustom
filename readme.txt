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

Change how your theme and plugins behave when their settings can't, without waiting on their makers: one small file per change, in your own copy.

== Description ==

SEO Pro Custom is an empty plugin you make your own. Fork its repository and install your fork on the sites you want to change; one fork serves as many sites as you like. Each change your site needs, that the theme's or a plugin's settings can't make, is one small file in your fork, which you or your AI assistant write, release and deploy the same day. The theme and plugins stay untouched, so their updates keep coming. When a change would help everyone, ask the product's maker for it; once the product does the job, your file switches itself off.

* **One file per change** in `customizations/`, with headers for what it does, which sites, what it requires, the upstream request and when it can retire. A file with a PHP error is reported and skipped; the site keeps working.
* **A style and script per change**, loaded after the theme's styles while the file is loaded.
* **Four states**: loaded, skipped, retired and failed, on the settings screen, in Tools → Site Health and in `wp seoprocustom list --format=json`.
* **Nothing when empty**: no front-end output and no database queries without customisation files.
* **Rules for your AI assistant** in `AGENTS.md`: a setting first, then a documented filter or action, then CSS, then code; never edit the theme's or plugins' own files.
* **Report a problem** (Tools): the site's AI assistant drafts problem reports and improvements for wpallstars plugins and themes; an administrator reviews and sends them.

Fork it on GitHub (wpallstars/seoprocustom), or choose Use this template for a private copy: the Read Me tab explains how.

= Built with AI =

SEO Pro Custom is built and maintained with aidevops (https://aidevops.sh), the same developer's open-source AI harness for creating and managing anything online with AI.

Questions about using or changing SEO Pro Custom: ask aidevops. It reads the plugin's docs and code to answer, writes customisations, and can report a problem for you.

Made from WP Plugin Starter (https://github.com/wpallstars/wp-plugin-starter-template-for-ai-coding), the wpallstars starter plugin.

== Installation ==

1. Upload the `seoprocustom` folder to `/wp-content/plugins/`, or install the zip from Plugins → Add New → Upload Plugin.
2. Activate it, then open Settings → SEO Pro Custom.
3. Add your changes to your own copy's `customizations/` folder (Settings → SEO Pro Custom → Read Me).

== Frequently Asked Questions ==

= Does it do anything on its own? =

No. Until you add customisation files to its `customizations` folder it adds nothing to the front end and runs no database queries. It has a settings screen, a Read Me tab and Tools → Report a problem.

= When should I use it instead of a setting? =

Only when no setting does the job. Try a setting first, then a documented filter or action, then CSS. Use code last.

= How do I add a change? =

Fork the repository (or use Use this template for a private copy), copy `customizations/example.php` to a new file, fill in its header and hooks, release your fork and update each site from it. Keep your fork in sync with ours to get our fixes.

= Can I send my site's changes upstream? =

Keep your site's own changes in your fork. Issues and pull requests on wpallstars/seoprocustom are welcome for the blank plugin itself: the loader, its reports, the AI rules, the example and the docs. Ask a theme or plugin for a feature every site would use on that product's repository, or with the Product request form for private products.

= What happens when the theme or plugin catches up? =

Give the file a `Retire-When:` header, such as `some-plugin >= 2.0`. Once that version is active the file stops loading and Site Health tells you to delete it.

= Where do I get help? =

Ask aidevops (https://aidevops.sh): open the plugin's repository, or your site, with it and ask. To report a problem or suggest an improvement, use Tools → Report a problem (also the Support link on the settings screen). Your site's AI assistant can draft reports there too; nothing is sent until an administrator reviews and sends it.

= Does it contact other services? =

No. The WordPress.org build contacts nothing outside WordPress. A problem report goes out only when an administrator sends it from Tools → Report a problem: as a GitHub issue they submit themselves, or by email with the site's own mailer for plugins and themes whose code is private.

= When do versions reach WordPress.org? =

GitHub releases are the stable beta channel: each version comes out there first. WordPress.org gets it 30 days later, except security releases, which come out on both at once.

== Screenshots ==

1. The settings screen (Settings → SEO Pro Custom) with the Customisations card: each file and what became of it on this site.
2. Tools → Site Health reporting a customisation with a PHP error, skipped so the site keeps working.

== Changelog ==

= 0.1.0 =
* First version: loads your own changes from customizations/, reported in Site Health and WP-CLI.

Every change: changelog.txt.
