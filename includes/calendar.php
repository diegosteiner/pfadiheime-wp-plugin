<?php
/**
 * Calendar block: iframe rendering shared by the block (render.php) and shortcode.
 *
 * @package Pfadiheime
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const PFADIHEIME_CALENDAR_DEFAULT_TEMPLATE = 'https://pfadiheime.ch/{locale}/cottages/{id}/occupancies/calendar?months={months}&utm=wp';
const PFADIHEIME_CALENDAR_LOCALES = array( 'de', 'fr', 'it' );

/**
 * URL template, from the PFADIHEIME_CALENDAR_TEMPLATE_URL env var or the default.
 *
 * @return string
 */
function pfadiheime_calendar_template() {
	$env = getenv( 'PFADIHEIME_CALENDAR_TEMPLATE_URL' );

	return ( is_string( $env ) && '' !== $env ) ? $env : PFADIHEIME_CALENDAR_DEFAULT_TEMPLATE;
}

/**
 * Build the iframe URL by inserting the locale, ID and month count into the template.
 *
 * @param string $id     Calendar ID.
 * @param string $locale Locale (de, fr or it); invalid values fall back to de.
 * @param int    $months Number of months to display.
 * @return string Full URL, or '' when no ID is given.
 */
function pfadiheime_calendar_build_url( $id, $locale = 'de', $months = 12 ) {
	$id = sanitize_text_field( $id );
	if ( '' === $id ) {
		return '';
	}

	$locale = in_array( $locale, PFADIHEIME_CALENDAR_LOCALES, true ) ? $locale : 'de';

	return strtr(
		pfadiheime_calendar_template(),
		array(
			'{locale}' => $locale,
			'{id}'     => rawurlencode( $id ),
			'{months}' => (string) max( 1, absint( $months ) ),
		)
	);
}

/**
 * Normalize a CSS length. Bare numbers become pixels; invalid values fall back.
 *
 * @param string $value    Raw value, e.g. "100%", "600", "75vh".
 * @param string $fallback Value used when $value is not a valid length.
 * @return string
 */
function pfadiheime_calendar_dimension( $value, $fallback ) {
	$value = trim( (string) $value );

	if ( preg_match( '/^\d+(\.\d+)?(px|%|em|rem|vh|vw)?$/', $value ) ) {
		return is_numeric( $value ) ? $value . 'px' : $value;
	}

	return $fallback;
}

/**
 * Render the calendar iframe markup.
 *
 * @param array $atts Accepts `id`, `locale`, `width`, `height`, `months`.
 * @return string The markup, or '' when there is nothing to render.
 */
function pfadiheime_calendar_iframe( $atts ) {
	$atts = shortcode_atts(
		array(
			'id'     => '',
			'locale' => 'de',
			'width'  => '100%',
			'height' => '600',
			'months' => 12,
		),
		is_array( $atts ) ? $atts : array()
	);

	$url = pfadiheime_calendar_build_url( $atts['id'], $atts['locale'], $atts['months'] );
	if ( '' === $url ) {
		return '';
	}

	return sprintf(
		'<div class="pfadiheime-calendar"><iframe src="%s" style="width:%s;height:%s;border:0;" loading="lazy" title="%s" allowtransparency="true"  seamless="seamless"></iframe></div>',
		esc_url( $url ),
		esc_attr( pfadiheime_calendar_dimension( $atts['width'], '100%' ) ),
		esc_attr( pfadiheime_calendar_dimension( $atts['height'], '600px' ) ),
		esc_attr__( 'Calendar', 'pfadiheime' )
	);
}

/**
 * Shortcode: [pfadiheime_calendar id="123" width="100%" height="600"].
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function pfadiheime_calendar_shortcode( $atts ) {
	return pfadiheime_calendar_iframe( $atts );
}
