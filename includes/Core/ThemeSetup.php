<?php

namespace Pelican\Theme\Core;

use Pelican\Theme\Components\Breadcrumb;

class ThemeSetup {

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );
	}

	// Sets up the theme
	public function theme_setup(): void {
		load_theme_textdomain( THEMEDOMAIN, get_template_directory() . '/languages' );
		$this->theme_support();
		$this->setup_breadcrumb_settings();
	}

	public function theme_support(): void {
		add_theme_support( 'automatic_feed_links' );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'html5', [ 'search-form', 'comment-list', 'comment-form', 'gallery', 'caption' ] );
		add_theme_support( 'menus' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
	}

	public function setup_breadcrumb_settings(): void {
		Breadcrumb::set_breadcrumbs_class( 'breadcrumbs' );
		Breadcrumb::set_item_classes( [ 'breadcrumbs__item' ] );
		Breadcrumb::set_home_title( __( 'Home', THEMEDOMAIN ) );
	}

}

new ThemeSetup();
