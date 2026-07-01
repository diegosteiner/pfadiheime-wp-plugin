<?php
/**
 * Plugin Name:       Pfadiheime
 * Description:       Blocks for the Pfadiheim-Verzeichnis (calendar embed and more).
 * Version:           1.0.0
 * Requires PHP:      7.4
 * Author:            Diego Steiner
 * License:           MIT
 * Text Domain:       pfadiheime
 *
 * @package Pfadiheime
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

define( 'PFADIHEIME_VERSION', '1.0.0' );
define( 'PFADIHEIME_FILE', __FILE__ );
define( 'PFADIHEIME_DIR', plugin_dir_path( __FILE__ ) );

require_once PFADIHEIME_DIR . 'includes/calendar.php';

function pfadiheime_register_blocks() {
	foreach ( (array) glob( PFADIHEIME_DIR . 'build/*/block.json' ) as $metadata_file ) {
		register_block_type( dirname( $metadata_file ) );
	}

	// Shortcodes registered by feature modules.
	add_shortcode( 'pfadiheime_calendar', 'pfadiheime_calendar_shortcode' );
}
add_action( 'init', 'pfadiheime_register_blocks' );
