<?php

namespace Pelican\Theme\Markup;

/**
 * Handles loading customization of pagination
 */
class Pagination {

	public function __construct() {
		add_filter( 'paginate_links_output', [ $this, 'custom_pagination_links_output' ], 10, 2 );
	}

	/**
	 * Changes the HTML output of paginated links for archives.
	 *
	 * @param string $output    HTML output.
	 * @param array  $args An array of arguments. See paginate_links() for information on accepted arguments.
	 */
	public function custom_pagination_links_output( $output, $args ): string {
		if ( $args['current'] == 1 ) {
			$prev   = '<span class="prev page-numbers">' . $args['prev_text'] . '</span>';
			$output = $prev . "\n" . $output;
		}

		if ( $args['total'] == $args['current'] ) {
			$next    = '<span class="next page-numbers">' . $args['next_text'] . '</span>';
			$output .= "\n" . $next;
		}

		return $output;
	}

}

new Pagination();
