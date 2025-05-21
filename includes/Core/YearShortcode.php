<?php

namespace Pelican\Theme\Core;

/**
 * Shortcode for current year
 */
class YearShortcode {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'current_year', [ $this, 'current_year_shortcode' ] );
	}

	public function current_year_shortcode() {
		return gmdate( 'Y' );
	}

}

new YearShortcode();
