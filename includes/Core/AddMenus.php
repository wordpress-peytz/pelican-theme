<?php

namespace Pelican\Theme\Core;

class AddMenus {

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'register_navigation' ] );
	}

	public function register_navigation(): void {
		register_nav_menus(
			[
				'main-nav'        => __( 'Main Menu', THEMEDOMAIN ),
				'main-nav-mobile' => __( 'Mobile Menu', THEMEDOMAIN ),
			]
		);
	}

	public static function main_menu(): void {
		wp_nav_menu(
			[
				'container'       => false,
				'container_class' => '',
				'menu_class'      => 'menu',
				'theme_location'  => 'main-nav',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 2,
			]
		);
	}

	public static function main_menu_mobile(): void {
		wp_nav_menu(
			[
				'container'       => false,
				'container_class' => '',
				'menu_class'      => 'menu-mobile',
				'theme_location'  => 'main-nav-mobile',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 2,
			]
		);
	}

}

new AddMenus();
