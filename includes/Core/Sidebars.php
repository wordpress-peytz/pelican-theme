<?php

namespace Pelican\Theme\Core;

class Sidebars {

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'sidebars' ] );
	}

	// Sets up the theme
	public function sidebars(): void {
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				[
					'name'          => 'Footer Widget Area',
					'id'            => 'footer-widget-area',
					'description'   => 'Widgets in this area will be shown in the footer.',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				]
			);
		}
	}

}

new Sidebars();
