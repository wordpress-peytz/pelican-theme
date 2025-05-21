<?php

namespace Pelican\Theme\Markup;

/**
 * To control Excerpts
 */
class Excerpt {

	public function __construct() {
		add_filter( 'excerpt_more', [ $this, 'new_excerpt_more' ] );
	}

	// The “more” link displayed after a trimmed excerpt
	public function new_excerpt_more( string $more ): string {
		return '...';
	}

}

new Excerpt();
