=== Pfadiheime ===
Contributors: diegosteiner
Tags: calendar, iframe, embed, calendar, blocks
Requires at least: 6.1
Tested up to: 6.5
Requires PHP: 7.4
Stable tag: 1.0.0
License: MIT

Gutenberg blocks for the Pfadiheim-Verzeichnis. Ships with a calendar embed block; more blocks can be added.

== Description ==

This plugin provides Gutenberg blocks for the Pfadiheim-Verzeichnis. Each block
lives in its own folder under `build/` and is auto-registered.

= Calendar block =

Embeds a calendar as an iframe. Each calendar is identified by an ID that is
inserted into a URL template. Place it with the "Calendar" block or the
`[pfadiheime_calendar]` shortcode, and control the iframe width/height.

== Configuration ==

The URL template is read from the `PFADIHEIME_CALENDAR_TEMPLATE_URL` environment
variable. When unset, it defaults to:

`https://pfadiheime.ch/{locale}/cottages/{id}/occupancies/calendar`

`{id}` is replaced with the calendar ID and `{locale}` with the two-letter site
language (e.g. `de`).

= Calendar shortcode =

`[pfadiheime_calendar id="123" width="100%" height="600"]`

* `id` — the calendar ID (required).
* `width` — CSS width, e.g. `100%` or `800`. Default `100%`.
* `height` — CSS height, e.g. `600` or `75vh`. Default `600`.

== Adding a new block ==

Create a folder under `src/<block-name>/` with its own `block.json` (and a
`render.php` for dynamic blocks). Run `npm run build`; the plugin auto-registers
every block found in `build/`. Note: `build/` is generated (not committed), so
run `npm install && npm run build` after checkout.

== Changelog ==

= 1.0.0 =
* Initial release: Pfadiheime plugin with the "Calendar" block and shortcode.
