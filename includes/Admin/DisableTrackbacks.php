<?php

namespace Pelican\Theme\Admin;

class DisableTrackbacks {

	private array $post_types;

	public function __construct() {
		$this->post_types = [ 'post' ];
		add_action( 'init', [ $this, 'disable_trackbacks' ] );
	}

	public function disable_trackbacks(): void {
		foreach ( $this->post_types as $post_type ) {
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}

}

new DisableTrackbacks();
