<?php

namespace Pelican\Theme\Core;

class SearchEmptyFix {

	public function __construct() {
		add_filter( 'request', [ $this, 'search_filter' ] );
	}

	// Avoids returning random page if empty search string
	public function search_filter( array $query_vars ): array {
		if ( ! is_admin() ) {
			if ( isset( $query_vars['s'] ) && $query_vars['s'] == '' ) {
				$query_vars['s'] = ' ';
			}
		}

		return $query_vars;
	}

}

new SearchEmptyFix();
