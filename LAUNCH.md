# SEO Pro Custom launch state

Version: 0.1.0

In development; no release yet. The repository has been public since
10 November 2026 (the owner's decision) and is a GitHub template repository:
clients make their own private copy with **Use this template**. Renamed from
`seoprostackcustom` (SEO Pro Stack Custom) the same day, before any release;
GitHub redirects the old address.

It will be listed on wpallstars.com as a free plugin, with its purpose
explained (owner, 10 November 2026).

## Public launch checks

Still to do: follow `DEVELOPMENT.md` → At public launch (branch protection,
CodeQL, secret scanning, Scorecard). Codacy, CodeFactor and SonarCloud are
not connected yet: quality onboarding found no project for this repository
on any of them, and SonarCloud needs an organisation admin to import it.
`SYNC_PAT` is needed once `main` is protected (`DEVELOPMENT.md` → Services
setup, step 4). Update this file with what is on.

## Before 1.0

Tick these off; `scripts/preflight-release.sh` checks most of them (Starter
leftovers lists what is still the starter's).

- [ ] Description: the `Description:` header and `readme.txt`'s short
  description (150 characters at most) say what this plugin does, not the
  starter's.
- [ ] `README.md` and `readme.txt` open with this plugin's own offering (what
  it does, for whom, why it differs), then getting started and a guide. Both
  keep the starter's credit, the line starting `Made from`.
- [ ] `README.md` keeps its ending: Built with AI, License, then
  `managed-readme-helper.sh sync`. (`readme.txt` has its Built with AI
  credit in the description and ends with its changelog and upgrade notice.)
- [ ] `readme.txt`: under 10 KB, up to 5 tags, Tested up to the latest
  WordPress, FAQ, an External services section for every service the plugin
  contacts, one Screenshots caption per screenshot.
- [ ] Banner and icon: in `.wordpress-org/banner.svg` replace the headline and
  tagline, and replace the starter's plug on the stack with this plugin's own
  mark (the same in `.wordpress-org/icon.svg`); run `scripts/build-banner.sh`
  and check the icon reads at 128 px.
- [ ] Screenshots of this plugin in `.wordpress-org/screenshot-N.png`
  (`scripts/build-banner.sh` makes the View details copies).
- [ ] `AGENTS.md` describes this plugin; `DESIGN.md` and search keywords, if
  the plugin has them, are current.
- [ ] Version 1.0.0 everywhere: `Version:`, the version constant, `Stable tag:`,
  `README.md`'s Version line and the three changelogs.
- [ ] `scripts/sync-core.sh --check` lists no differences from the starter.
- [ ] Checks pass: `scripts/lint.sh`, `scripts/preflight-release.sh` (no
  errors; each warning understood), `scripts/smoke-test.sh`,
  `scripts/plugin-check.sh` (no errors on either zip).
- [ ] The owner has seen it on a test site (`scripts/preview-site.sh`) and
  approved the banner, icon and screenshots.
- [ ] WordPress.org: if the Plugin Name gives another slug, ask for this
  plugin's slug in the submission notes.
- [ ] After the release: `scripts/update-test.sh`.

## At public launch

First follow `DEVELOPMENT.md` → Secrets in history, then
`DEVELOPMENT.md` → At public launch. Update this file with what is on.

## WordPress.org

Not submitted. Follow `RELEASING.md` → WordPress.org when the owner says,
and record the submission here.
