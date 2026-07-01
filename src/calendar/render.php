<?php
/**
 * Server-side render for the pfadiheime/calendar block.
 *
 * @package Pfadiheime
 *
 * @var array $attributes Block attributes.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$pfadiheime_html = pfadiheime_calendar_iframe( $attributes );

if ( '' !== $pfadiheime_html ) {
	printf( '<div %s>%s</div>', get_block_wrapper_attributes(), $pfadiheime_html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
