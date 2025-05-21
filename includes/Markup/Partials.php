<?php

namespace Pelican\Theme\Markup;

/**
 * Loads partials when needed
 */
class Partials {

	public function __construct() {
		add_action( 'wp', [ $this, 'load_template_partials' ], 10 );
	}

	/**
	 * Load template partials on defined hooks
	 */
	public function load_template_partials(): void {

		// On archive pages
		if ( is_archive() || is_search() || is_home() ) {
			add_action( THEMEDOMAIN . '_primary_content_top', [ $this, 'get_archive_header' ] );
			add_action( THEMEDOMAIN . '_primary_content_top', [ $this, 'get_archive_hero' ] );
			add_action( THEMEDOMAIN . '_primary_content_bottom', [ $this, 'get_archive_footer' ], 5 );
			add_action( THEMEDOMAIN . '_archive_footer', [ $this, 'get_post_pagination' ], 10 );
		}

		// On search page
		if ( is_search() ) {
			add_action( THEMEDOMAIN . '_after_archive_header', [ $this, 'get_search_form' ], 10 );
		}

		// On all singular views except pages, where we use hero.
		if ( is_singular() && ! is_front_page() && ! is_page() ) {
			add_action( THEMEDOMAIN . '_before_article_content', [ $this, 'get_post_primary_category' ], 5 );
			add_action( THEMEDOMAIN . '_before_article_content', [ $this, 'get_post_title' ], 10 );
			add_action( THEMEDOMAIN . '_before_article_content', [ $this, 'get_post_excerpt' ], 15 );
			add_action( THEMEDOMAIN . '_before_article_content', [ $this, 'get_post_metadata' ], 20 );
			add_action( THEMEDOMAIN . '_before_article_content', [ $this, 'get_featured_image' ], 25 );
			add_action( THEMEDOMAIN . '_before_article_content', [ $this, 'get_post_featured_caption' ], 30 );
		}

		// On pages.
		if ( is_page() ) {
			add_action( THEMEDOMAIN . '_before_article_content', [ $this, 'get_hero' ], 10 );
		}
	}

	/**
	 * Loads the breadcrumb partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_breadcrumb() {
		return get_template_part( 'partials/breadcrumb' );
	}

	/**
	 * Loads the post title partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_post_title() {
		return get_template_part( 'partials/post', 'title' );
	}

	/**
	 * Loads the post hero partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_hero() {
		return get_template_part( 'partials/page', 'hero' );
	}

	/**
	 * Loads the post excerpt partial
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_post_excerpt() {
		return get_template_part( 'partials/post', 'excerpt' );
	}

	/**
	 * Loads the post featured-caption partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_post_featured_caption() {
		return get_template_part( 'partials/post', 'featured-caption' );
	}

	/**
	 * Loads the post metadata partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_post_metadata() {
		return get_template_part( 'partials/post', 'metadata' );
	}

	/**
	 * Loads the post primary-category partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_post_primary_category() {
		return get_template_part( 'partials/post', 'primary-category' );
	}

	/**
	 * Loads the post terms partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_post_terms() {
		return get_template_part( 'partials/post', 'terms' );
	}

	/**
	 * Loads the post featured partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_featured_image() {
		return get_template_part( 'partials/post', 'featured' );
	}

	/**
	 * Loads the post pagination partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_post_pagination() {
		return get_template_part( 'partials/post', 'pagination' );
	}

	/**
	 * Loads the archive header partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_archive_header() {
		return get_template_part( 'partials/archive', 'header' );
	}

	/**
	 * Loads the archive hero partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_archive_hero() {
		return get_template_part( 'partials/archive', 'hero' );
	}

	/**
	 * Loads the archive footer partial
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_archive_footer() {
		return get_template_part( 'partials/archive', 'footer' );
	}

	/**
	 * Loads the searchform
	 *
	 * @return void
	 */
	public function get_search_form() {
		\get_search_form();
	}

}

new Partials();
