<?php
/**
 * Template setup
 *
 * @package Pelican
 */

namespace Pelican\Theme\Markup;

class Template {

	public $post_classes = [];

	public function __construct() {
		add_action( 'wp', [ $this, 'setup_template' ], 10 );
	}

	public static function get_prefix(): string {
		return THEMEDOMAIN;
	}

	public static function get_key( string $key ): string {
		return sprintf( '%s_%s', self::get_prefix(), $key );
	}

	public function get_post_customizer_link(): string {
		global $pagenow;

		if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' ) {
			return '';
		}

		if ( $pagenow == 'post.php' ) {
			$page_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : '';
		}

		if ( ! empty( $page_id ) ) {
			$url = '?url=' . urlencode( get_permalink( $page_id ) );
		} else {
			$url = '';
		}

		$customizer_link = admin_url( 'customize.php' ) . $url;

		return $customizer_link;
	}

	public function setup_template(): void {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		// Setup post classes
		$this->setup_post_classes();

		add_action( THEMEDOMAIN . '_loop', [ $this, 'get_template_content' ], 10 );
		add_filter( THEMEDOMAIN . '_show_sidebar', [ $this, 'show_sidebar' ], 10 );
		add_filter( 'body_class', [ $this, 'body_classes' ], 15 );
		add_filter( THEMEDOMAIN . '_content_class', [ $this, 'content_classes' ], 15 );
	}

	private function setup_post_classes(): string {
		if ( is_archive() || is_search() || is_home() || get_post_type() == 'employee' ) {
			$layout               = 'archive';
			$this->post_classes[] = 'fullwidth';
		} elseif ( is_404() ) {
			$layout               = 'error404';
			$this->post_classes[] = 'fullwidth';
		} else {
			$layout               = get_post_meta( get_the_ID(), self::get_key( 'template' ), true );
			$layout               = empty( $layout ) ? 'fullwidth' : $layout; // Default to left sidebar
			$this->post_classes[] = $layout;

			if ( has_post_thumbnail() ) {
				$this->post_classes[] = 'has-post-thumbnail';
			}

			if ( is_page() && get_post_meta( get_the_ID(), '_' . THEMEDOMAIN . '_hero_settings_hide_hero', true ) ) {
				$this->post_classes[] = 'hero-hidden';
			}
		}

		$this->post_classes = apply_filters( THEMEDOMAIN . '_setup_post_classes', $this->post_classes, $layout );

		return $layout;
	}

	/**
	 * Loads content partial fitting the context
	 *
	 * @return void|false Void on success, false if the template does not exist.
	 */
	public function get_template_content() {
		return get_template_part( 'template-parts/content', $this->get_context() );
	}

	private function get_context(): string {

		if ( is_front_page() ) {
			$context = 'frontpage';
		} elseif ( is_home() ) {
			$context = 'archive';
		} elseif ( is_archive() || is_search() ) {
			$context = 'archive';
		} elseif ( is_page() ) {
			$context = 'page';
		} elseif ( is_singular() ) {
			$context = get_post_type();
		} else {
			$context = '';
		}

		return $context;
	}

	public function body_classes( array $classes ): array {
		return array_merge( $classes, $this->post_classes );
	}

	public function content_classes( string $class ): string {
		if ( is_archive() || is_search() || is_home() ) {
			$class .= ' content-wrapper--archive';
		}

		return $class;
	}

	public function show_sidebar( bool $show_sidebar ): bool {
		$classes = array_intersect( $this->post_classes, [ 'fullwidth', 'grid', 'archive' ] );

		if ( ! empty( $classes ) ) {
			return false;
		}

		return $show_sidebar;
	}

}

new Template();
