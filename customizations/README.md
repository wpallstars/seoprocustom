# Customisations

Your site's own changes live here, one file per change. SEO Pro Custom loads
each `*.php` file in this folder on `init` (priority 0), so hook `init` or
later, not `plugins_loaded`.

## File header

Each file starts with a comment header:

```php
<?php
/**
 * Description: What this does and why.
 * Sites:       all
 * Requires:    plugin-folder >= 1.2.3, theme-stylesheet
 * Upstream:    https://github.com/owner/repo/issues/123
 * Retire-When: plugin-folder >= 1.4.0
 */
```

| Header | Meaning |
|---|---|
| `Description:` | What the file does and why. |
| `Sites:` | `all` (the default), or comma-separated blog IDs or hosts (multisite). |
| `Requires:` | Plugin folders or theme stylesheets, each with an optional version test (`>=`, `<=`, `>`, `<`, `==`, `!=`). All must be active and match, or the file is **skipped**. `never` is never met. |
| `Upstream:` | The address of the request that would make this file unnecessary. |
| `Retire-When:` | The same syntax as `Requires:`. When met, upstream now does the job: the file is **retired** (not loaded) and can be deleted. |

## Style and script

`{name}.css` and `{name}.js` next to `{name}.php` load on the front end when
the PHP file is loaded: styles after the theme's (the child theme's
`site-design` handle), both versioned by file time.

## States

`wp seoprocustom list` and Tools → Site Health show each file as:

- **loaded**: it ran.
- **skipped**: not for this site, or a requirement is not met.
- **retired**: upstream now does this; delete the file.
- **failed**: a PHP error. The file is skipped and the site keeps working.

`example.php` is switched off with `Requires: never`; copy it as a start.
