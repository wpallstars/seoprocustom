![WPALLSTARS SEO Pro Custom: Built with AI](admin/images/banner.svg)

# SEO Pro Custom

<!-- aidevops:badges:start -->
<!-- On GitHub only: the Read Me tab skips this block. scripts/rename-plugin.sh rewrites it. -->
[![CI](https://github.com/wpallstars/seoprocustom/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/wpallstars/seoprocustom/actions/workflows/ci.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=wpallstars_seoprocustom&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=wpallstars_seoprocustom)
[![License: GPL v3 or later](https://img.shields.io/badge/License-GPL%20v3%20or%20later-blue.svg)](LICENSE)
[![Latest release](https://img.shields.io/badge/release-v0.1.0-blue.svg)](https://github.com/wpallstars/seoprocustom/releases)

[![Requires WordPress](https://img.shields.io/badge/WordPress-6.2%2B-21759B.svg?logo=wordpress)](readme.txt)
[![Tested up to](https://img.shields.io/badge/tested%20up%20to-7.1-21759B.svg?logo=wordpress)](readme.txt)
[![Requires PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4.svg?logo=php)](readme.txt)
[![Lines of code](docs/metrics/badges/loc.svg)](docs/metrics/repo-metrics.md)
[![Dependencies](docs/metrics/badges/dependencies.svg)](docs/metrics/repo-metrics.md)

[![Languages by lines of code](docs/metrics/badges/languages.svg)](docs/metrics/repo-metrics.md)
<!-- aidevops:badges:end -->

Your site's own changes, one file each, in your own repository, switched off when an SEO Pro Stack product does the same.

SEO Pro Custom is for owners of sites built on SEO Pro Stack who want their own changes now, without waiting for a theme or plugin release. Make your own private copy of this repository with **Use this template**, add one file per change, and deploy it to your sites; the copy installed on each site is empty until you do. When a change would help everyone, ask for it upstream: once an SEO Pro Stack product does the same, switch your file off.

If this saves you time, headaches and costs, feel free to [buy me a coffee](https://buymeacoffee.com/marcusquinn), or whatever you like, to invest in making more things open-source.

Version: 0.1.0

<!-- github-only:start -->
## Screenshots

**Settings → SEO Pro Custom**: the General tab, empty until features add settings, with search and the Source code, Support and Buy me a coffee links.

![The SEO Pro Custom settings screen on the General tab](.wordpress-org/screenshot-1.png)

**The Read Me tab** shows this file inside WordPress, banner included.

![The Read Me tab showing README.md](.wordpress-org/screenshot-2.png)

**Updates from GitHub** (GitHub build): each GitHub release is offered on the Plugins screen as a normal WordPress update.

![The Plugins screen offering SEO Pro Custom 1.0.12 from GitHub](docs/images/github-update.png)
<!-- github-only:end -->

## What you get

- **A loader for your own changes**: every `customizations/*.php` file loads on its own, with a header that says what it does (`Description:`), which sites it is for (`Sites:`), what it needs (`Requires:`), the upstream request it waits on (`Upstream:`) and when it can go (`Retire-When:`). A file with a PHP error is reported and skipped; the site keeps working.
- **A style and script per change**: `{name}.css` and `{name}.js` next to the file load on the front end, after the theme's styles, only while the file is loaded.
- **Four states you can check**: loaded, skipped (not for this site, or a requirement is not met), retired (upstream now does this; delete the file) and failed. They show in Tools → Site Health, on Settings → SEO Pro Custom, and in `wp seoprocustom list [--format=json]`, for checking a fleet of sites.
- **Nothing when empty**: with no customisation files the plugin adds no front-end output and no database queries.
- **Rules for your AI assistant**: `AGENTS.md` says how to make a change safely: prefer a setting, then a documented filter or action, then CSS, then code; never edit upstream files.
- **Settings, Read Me, colour mode, problem reports, GitHub updates and multisite**, shared with every wpallstars plugin.
- **Scripts and CI**: lint, a smoke test on a real WordPress, the release build, a preflight check, Plugin Check, a preview site, and `scripts/sync-core.sh` to keep the shared parts the same as the starter's.

## Make your own copy

1. On GitHub, choose **Use this template** to make your own **private** repository (a fork of a public repository stays public), and clone it.
2. In `seoprocustom.php`, set `GitHub Plugin URI` (and `Update URI`, if you use it) to your repository, `owner/repo`.
3. For updates from a private repository, make a read-only fine-grained token for that one repository (Contents: read) and put it in `wp-config.php` on each site, never in Git:

   ```php
   define( 'WPALLSTARS_GITHUB_TOKEN', 'github_pat_…' );
   ```

4. Add one file per change to `customizations/` (see `customizations/README.md`, and `example.php`, which is switched off). Commit, release (`RELEASING.md`), and click **Update** on each site.
5. To ask for a change upstream, use the request form (below). When an SEO Pro Stack product does the job, add `Retire-When:` to your file, or delete it.
6. Keep the shared parts up to date: the daily Starter sync pull request, or `scripts/sync-core.sh` (`--check` lists what differs), brings in our later loader changes. Your `customizations/` folder is yours; the sync never touches it.

The easiest way to write a customisation is with [aidevops](https://aidevops.sh) or any AI assistant: open your copy, and `AGENTS.md` tells it the rules.

Use only the filters and actions the products document: those are the ones kept stable.

## Ask for a change upstream

- **Public products** (SEO Pro Stack, the starter plugins): open an issue or a pull request on that product's own repository.
- **Private products** (the PSD child theme, SEO Pro Directory): use the **Product request** form under [New issue](https://github.com/wpallstars/seoprocustom/issues/new/choose). Name the product, the customisation file it would replace, and what and why. Issues are public: leave out site addresses, private code and client data, and use **Tools → Report a problem** for anything sensitive.

## Where to find it

Go to **Settings → SEO Pro Custom**. The screen has two groups of tabs:

- **Settings**: General, empty until features add settings. Changes save instantly; there is no Save button. **Search features** (next to the plugin name) finds settings on every tab.
- **About**: this Read Me.

On a multisite network, super admins also have **Network Admin → Settings → SEO Pro Custom** (Multisite below).

At the top right of the screen, **Source code** opens the plugin’s [GitHub repository](https://github.com/wpallstars/seoprocustom) in a new tab, and **Support** opens **Tools → Report a problem** for administrators (Report a problem below), or its [GitHub issues](https://github.com/wpallstars/seoprocustom/issues) in a new tab for others. For questions, ask [aidevops](https://aidevops.sh) (Built with AI below). **Buy me a coffee**, next to it, opens the maker’s [Buy Me a Coffee](https://buymeacoffee.com/marcusquinn) page in a new tab.

## Report a problem

Found a problem in SEO Pro Custom, or an improvement that would help? Tell the maker, so every site using it gets the fix. **Tools → Report a problem** (or **Support** in the settings screen's header) takes reports for every wpallstars plugin and theme on the site:

1. Write what you did, what you expected and what happened, with the steps to see it again, or the improvement and why it would help. Save the draft.
2. Check **What will be sent**, word for word, then send it. SEO Pro Custom's reports open a new issue on its [GitHub issues](https://github.com/wpallstars/seoprocustom/issues), filled in, for you to submit with your GitHub account. Issues are public, so the site's address, email and IP addresses, server paths and anything that looks like a key are taken out first. A plugin or theme whose code is private sends its reports by email instead, with the site's own mailer, privately to its maker's help desk, with your email address to reply to.

**AI assistants:** when a problem or an improvement you find belongs to SEO Pro Custom's own code, not to the site's content or settings, draft a report for the site's administrator to review: the `wpallstars/report-problem` ability (WordPress 6.9 and later; `wpallstars/reports` lists the plugins and themes that take reports and the drafts), or WP-CLI:

```bash
wp wpallstars report products
wp wpallstars report create --product=seoprocustom --title="Short summary" --details="Steps, what was expected, what happened, versions, error messages"
wp wpallstars report list
```

Drafts only: nothing leaves the site until an administrator sends it in Tools → Report a problem, so tell them it is waiting. Leave out passwords, keys and personal data.

## Multisite

On a multisite network, **Network Admin → Settings → SEO Pro Custom** has the same header, search, tabs and cards as each site's screen, for super admins. Its settings are the network's own, kept apart from each site's:

- **New sites start with them**, and so does a site where SEO Pro Custom runs for the first time.
- **Apply to every site**, under each card, makes every site use the card's network settings. Each site's screen shows the card locked, saying the network administrator sets it, with a link to the network screen for super admins. Switch it off and each site has its own settings again: they are never overwritten.
- Under each card, the sites whose own settings differ, up to 10 named with links to their settings, and **Make every site the same**, which copies the card's network settings into every site's own settings once. Sites can change them again afterwards, unless the card is applied to every site. Networks of more than 500 sites are not compared, and Make every site the same is not offered there.
- When the network changes a site's settings, the site does what saving them there would do (schedules, rules, files) on its next admin screen, cron run or WP-CLI command, never on a visitor's page.
- Settings that only make sense on each site, such as Media Library pictures, are not on the network screen.

## Requirements

- WordPress 6.2 or later
- PHP 7.4 or later

## Updates and releases

There are two builds of each version:

- **GitHub release** (`seoprocustom-X.Y.Z.zip` on the repository’s Releases page): everything, including the shared updater in `includes/github-updater/`, so sites get each release as a normal update. Its main file also gets an `Update URI` header on github.com, so WordPress.org never offers a plugin of the same name in its place.
- **WordPress.org**: the same files without the updater (listed in `.distignore-wporg`) and without the `GitHub Plugin URI`, `Primary Branch`, `Release Asset` and `Update URI` header lines, because plugins hosted there may not install or update code from elsewhere.

The updater waits while Git Updater is active, so the two never both update a plugin.

GitHub releases are the stable beta channel: each version is released there first. WordPress.org gets a version 30 days later, once it has been used on real sites, except security releases, which go to WordPress.org at once. The WordPress.org build has no affiliate links: those listed in `.wporg-links` are replaced by plain ones when it is built.

Releasing on GitHub:

1. Merge the version change (`Version:` and `SEOPROCUSTOM_VERSION` in `seoprocustom.php`, `Stable tag:` in `readme.txt`, `Version:` near the top of this file) to `main`.
2. Straight away, tag that commit `vX.Y.Z` and push the tag. The Release workflow (`.github/workflows/release.yml`) builds `seoprocustom-X.Y.Z.zip` from the tag with `scripts/build-release.sh` (`.distignore` applied, everything inside a `seoprocustom/` folder), checks it with `scripts/preflight-release.sh` and publishes the GitHub release with it attached; in a public repository it also attaches signed build provenance, which `gh attestation verify` checks. Sites pick the latest release whose tag is a plain version number and the asset named exactly `seoprocustom-X.Y.Z.zip`, so never attach the WordPress.org zip. Full steps: `RELEASING.md`.
3. Sites offer the update when they next check (within 12 hours, or at once with **Check again** on the Updates screen).

Mark test builds as pre-releases on GitHub (or tag them with letters, such as `v1.2.0-rc1`): sites never offer those. Do not add an `Update URI` header to the plugin file in Git: WordPress.org rejects it. The build adds it to the GitHub zip only.

## Developers

A feature is a class in `includes/features/class-seoprocustom-{name}.php` that extends `SEOProCustom_Feature`, listed in `SEOProCustom_Setup::FEATURES`. It declares its settings in `settings()`, adds its hooks in `boot()` (returning early unless `self::enabled()`), and can import another plugin’s settings once in `migrate()` with `self::import_setting()`. Anything only this plugin needs goes in `SEOProCustom_Setup` (`includes/class-seoprocustom-setup.php`): features, settings tabs, header links, settings version, `MENU_PARENT` (its own top-level menu, if any, which then holds the settings screen as **Settings**) and its own helpers. Link to the settings screen with `SEOProCustom_Admin_Manager::page_url()` or `tab_url()`. A screen of the plugin's own shows the settings screen's header: call `SEOProCustom_Admin_Manager::enqueue_header()` on `admin_enqueue_scripts`, then print `<div class="wrap spc-wrap">`, `SEOProCustom_Admin_Manager::render_header()`, `<hr class="wp-header-end">` and the screen's content in `<div class="spc-main">`; sections go between the last two as the settings screen's tabs with `SEOProCustom_Admin_Page::sections_nav( array( 'overview' => array( 'label' => 'Overview', 'url' => $url ) ), 'overview' )`, and `SEOProCustom_Admin_Page::title_section( 'Section name' )` on the screen's `load-{hook}` action puts the section shown after the screen's name in the browser title, as the settings screen does for its tabs. `admin/css/seoprocustom-header.css` styles only those and the header, so the content keeps its styles. The other files in `includes/` and `admin/` are the starter’s core files: `STANDARDS.md` → Structure.

Filters:

- `seoprocustom_features`: register a feature class that extends `SEOProCustom_Feature`.
- `seoprocustom_customization_style_deps`: the style handles that a customisation's `.css` loads after (`site-design` by default; handles that are not registered are left out).
- `seoprocustom_settings_schema`: add or change settings. Each entry sets `type` (bool, int, text, url, lines, domains, select, multi, times or media, a picture from the Media Library stored as its attachment ID), `default`, `label`, `description` and either `tab` or `parent`; select and multi also take `options` (an array or a callable, which runs on every settings save, so keep it small: `STANDARDS.md` → Performance) and `open` to keep saved values that are not currently registered. A child setting can take `hidden` (true): it is not shown or searched, for wiring that code sets. A child setting with `group` set to `troubleshooting` is shown last, in a closed **Troubleshooting** section of the panel, for bypasses people need only when something is wrong (`STANDARDS.md` → Code rules); the section opens by itself when one of its settings differs from its default or matches a search. `reload` (true) makes the saved message ask to reload the page, for changes that show only after a page load. `network` (false) leaves a setting off the network screen (multisite), for one that only makes sense on each site, such as a list of the site's own posts or people; media fields and `hidden` wiring are left off already. A multi setting can take `locked` (values, or a callable returning them): choices that are always chosen, shown ticked with a lock, cannot be unticked and are never stored, so the feature itself treats them as chosen. A multi setting can take `ordered` (true) to keep its values in the chosen order, which people change by dragging. `replaces` (slug => name) shows which plugin a feature replaces; keep that list in the feature's `REPLACES` class constant and pass `self::REPLACES` (`STANDARDS.md` → Structure). Settings render and save automatically.
- `seoprocustom_admin_tabs`: add or reorder admin tabs. Each tab sets `label`, `group` (settings, discover or about), a `render` callback, an optional `capability`, an optional `preload` and an optional `network` (true: also on the network screen, multisite, where its callback runs with `is_network_admin()` true; settings tabs and Read Me have it); tabs the current user lacks the capability for are hidden. The screen draws the active tab with the other tabs of its group that preload (settings tabs and Read Me do), and switches between them without a reload (`SEOProCustom_Admin_Manager::page_tabs()`). Set `preload` to true only when the tab is cheap to draw and its script works while its panel is hidden. An optional `menu` (a name) gathers tabs: tabs of a group with the same `menu` show in the bar as one tab with that name, which opens the first of them, and while one of them is shown, they show as a second row of tabs under the bar (`SEOProCustom_Admin_Page::nav()`). An optional `wide` (true) lets the tab use the whole width of the screen (`spc-main--wide`), for a grid of cards.
- `seoprocustom_admin_script_deps` and `seoprocustom_admin_script_data`: the settings screen script’s dependencies (once for each tab drawn on the page) and the data it reads as `seoprocustomAdmin` (with the active tab; `seoprocustomAdmin.tab` follows the tab shown, `tabs` lists the tabs drawn, `titles` their browser titles, and `network` is true on the network screen).
- `seoprocustom_troubleshooting_open`: whether a setting's Troubleshooting section starts open (open, setting key), for a feature that fell back after an error.
- `seoprocustom_can_change_settings`: return false to stop the current user changing SEO Pro Custom’s settings (on top of `manage_options`).
- `seoprocustom_replaced_plugin_extras`: what a replaced plugin does on this site that SEO Pro Custom does not (plain names, plugin folder). The Plugins screen names them instead of saying the plugin can go.
- `seoprocustom_redundant_plugins`: plugin files the Plugins screen's **Redundant** view lists besides the plugins a setting replaces, such as plugins whose job WordPress now does. Every plugin made from the starter adds to the same view (WordPress 6.3 or later).
- `seoprocustom_replaces_link`: the link a setting's card shows while a plugin it replaces is active (`url` and `label`, plain text; plugin folder, plugin file, name). It defaults to Deactivate; return another step to take first, such as an import, or an empty value for no link.
- `seoprocustom_stored_active_plugins` and `seoprocustom_plugins_skipped`: for code that skips plugins on some requests, the active plugin files as stored and whether some are skipped on this request, so features still count those plugins as active.
- `wpallstars_github_plugins` (GitHub builds, shared updater): change which plugins update from GitHub releases (plugin file => `repo` as owner/repo, `asset_only`, `version`, `name`).
- `wpallstars_github_token` (GitHub builds, shared updater): GitHub token for a repository (token, owner/repo), for private repositories; defaults to the `WPALLSTARS_GITHUB_TOKEN` constant.
- `wpallstars_github_updater_enabled` and `wpallstars_github_updater_early` (GitHub builds, shared updater): whether it runs (false while Git Updater is active) and whether plugins also on WordPress.org take GitHub releases first.
- `wpallstars_github_updater_checks_in_cron` (GitHub builds, shared updater): return false to let update checks that fall due run on the admin screen being opened, as in core, instead of in WP-Cron.
- `wpallstars_report_products` (shared problem reports, `includes/wpallstars-reports/`): the plugins and themes that take problem reports (slug => `name`, `type` plugin or theme, `version`, `support`: a GitHub issues address or `mailto:address`). The plugin lists itself from `SEOProCustom_Setup::header_links()['support']`; `wpallstars_report_url( $slug )` links to its reports (`STANDARDS.md` → Problem reports).

Actions:

- `seoprocustom_admin_enqueue`: enqueue the plugin’s own admin styles and scripts on its settings screen, depending on `seoprocustom-admin`; it fires once for each tab drawn on the page, the active tab first. Its script can use `seoprocustomAdmin.api` (`post`, `speak`, `errorMessage`), and the `seoprocustom:tab-shown` jQuery event (tab slug) on `document` tells it when another tab is shown.
- `seoprocustom_setting_saved`: a setting was saved from the admin screen (setting key, value), or the network changed it for this site (multisite): then on the site's next admin, cron or WP-CLI request, as nobody, while `SEOProCustom_Network_Sites::syncing()` is true.
- `seoprocustom_settings_changed`: settings changed, however they were saved (the admin screen, presets, WP-CLI, `update_option()`) or by the network for this site, as above (old and new settings, as features read them). Use it rather than `update_option_seoprocustom_options`, which misses the network's changes.
- `seoprocustom_setting_panel`: print status at the top of a setting’s options panel (setting key, schema entry); wrap it in `<div class="spc-panel-note">`. On the network screen, `seoprocustom_network_setting_panel` fires instead, for notes about the whole network.
- `seoprocustom_settings_tab_after`: print a section after a settings tab’s cards (tab slug). On the network screen, `seoprocustom_network_settings_tab_after` fires instead.

Read a setting with `SEOProCustom_Settings::get( 'key' )`, never the option itself: on multisite it includes the settings the network applies to every site. Code that runs before the plugin loads (a must-use file) reads the network option's `enforced` values (`seoprocustom_network`: card => setting => value) over the site's own, as `SEOProCustom_Settings::all()` does.

## Uninstall

Deleting the plugin removes its settings (on multisite, every site's and the network's), its cached data, its problem reports (other plugins' and themes' stay), who hid lines of the Plugins screen notice about replaced plugins, and the cached GitHub releases.

## Changelog

### 0.1.0

- First version, made from WP Plugin Starter 1.0.56.
- Customisation loader: `customizations/*.php` with `Description:`, `Sites:`, `Requires:`, `Upstream:` and `Retire-When:` headers, an optional `.css` and `.js` each, and PHP errors reported and skipped. Loaded, skipped, retired and failed show in Site Health, on the settings screen and in `wp seoprocustom list`.
- Product request issue form, DCO check for pull requests, and rules for clients' AI assistants in `AGENTS.md`.

## Built with AI

SEO Pro Custom is built and maintained with [aidevops](https://aidevops.sh), the same developer's open-source AI harness for creating and managing anything online with AI, plugins like this one included. It is free on [GitHub](https://github.com/marcusquinn/aidevops).

Questions about using, changing or building on SEO Pro Custom: ask aidevops. Open this repository, or the site it runs on, with aidevops and ask; it reads the plugin's docs and code to answer, and can report a problem for you.

Made from [WP Plugin Starter](https://github.com/wpallstars/wp-plugin-starter-template-for-ai-coding), the wpallstars starter plugin. Its shared standards and the daily Starter sync keep this plugin up to date.

Works well with [SEO Pro Stack](https://github.com/wpallstars/seoprostack), the wpallstars base plugin for every site: it speeds WordPress up and keeps the admin organised, each job a switch you turn on.

## License

GPL-3.0-or-later (the full text is in `LICENSE`), with the additional terms in `ATTRIBUTION.txt` (GPL-3.0 section 7(b)): keep the copyright notices and the "Made from" credit.

Copying, renaming or adapting this plugin or part of it, by hand or with an AI assistant: read `ATTRIBUTION.txt` first. It says what every copy keeps, with a section for AI assistants.

Copyright (C) 2026 Marcus Quinn

Parts copyright (C) 2026 Marcus Quinn, from [WP Plugin Starter](https://github.com/wpallstars/wp-plugin-starter-template-for-ai-coding).

Parts copyright (C) 2026 Marcus Quinn, from [WP Plugin Starter](https://github.com/wpallstars/wp-plugin-starter-template-for-ai-coding).

<!-- aidevops:managed-readme:start -->
<!-- managed by aidevops; refresh with managed-readme-helper.sh sync -->
## Star History

![wpallstars/seoprocustom stars over time](docs/assets/star-history.svg)

## Built with aidevops

This project was created and is maintained with
[aidevops.sh](https://aidevops.sh).

[View wpallstars on GitHub](https://github.com/wpallstars) ·
[aidevops repository](https://github.com/marcusquinn/aidevops)
<!-- aidevops:managed-readme:end -->
