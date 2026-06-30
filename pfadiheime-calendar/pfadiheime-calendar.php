<?php
/**
 * Plugin Name:       Pfadiheim-Verzeichnis Kalender
 * Plugin URI:        https://pfadiheime.ch
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Diego Steiner &#x2F; Filou
 * License:           MIT
 * Text Domain:       pfadiheime-calendar
 *
 * @package           pfadiheime
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function pfadiheime_pfadiheime_calendar_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'pfadiheime_pfadiheime_calendar_block_init' );
