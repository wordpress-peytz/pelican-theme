<?php

namespace Pelican\Theme\Helpers;

/**
 * File helper functions
 */
class FileHelpers {

	/**
	 * Define inflix based on development environment (set in PCO Mu plugin).
	 *
	 * @return string
	 */
	public static function get_inflix() {
		// default to using minified files.
		$inflix = '.min';

    // default to using development (non-minified) files, if they exist and the environment is local.
    $inflix = ( file_exists( get_theme_file_path() . '/assets/dist/css/base.css' ) ? '' : '.min' );

		return $inflix;
	}

}
