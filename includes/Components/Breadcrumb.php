<?php

namespace Pelican\Theme\Components;

/**
 * Methods to get and display breadcrumbs markup
 */
class Breadcrumb {

	public static array $item_classes       = [];
	public static string $breadcrumbs_class = '';
	public static string $home_title        = '';
	public static string $custom_taxonomy   = '';

	// Start breadcrumbs
	public static function start(): string {
		return sprintf( '<ul class="%s">', self::$breadcrumbs_class );
	}

	// End breadcrumbs
	public static function end(): string {
		return '</ul>';
	}

	// Get breadcrumb home
	public static function home(): string {
		return sprintf( '<li class="%1$s %2$s__item--home"><a class="%2$s__link" href="%3$s">%4$s</a></li>', implode( ' ', self::$item_classes ), self::$breadcrumbs_class, get_home_url(), self::$home_title );
	}

	/**
	 * Get breadcrumb item
	 */
	public static function item( string $title ): string {
		return sprintf( '<li class="%s">%s</li>', implode( ' ', self::$item_classes ), $title );
	}

	/**
	 * Get breadcrumb category item
	 */
	public static function item_cat( string $title ): string {
		self::$item_classes = [
			'breadcrumbs__item',
			self::$breadcrumbs_class . '__item--cat',
		];

		return self::item( $title );
	}

	/**
	 * Get breadcrumb current item
	 */
	public static function item_current( string $title ): string {
		self::$item_classes = [
			'breadcrumbs__item',
			self::$breadcrumbs_class . '__item--current',
		];

		return self::item( $title );
	}

	/**
	 * Get breadcrumb custom post type item
	 */
	public static function item_cpt( string $post_type ): string {
		$post_type_object = get_post_type_object( $post_type );

		return sprintf(
			'<li class="%1$s %2$s__item--post-type %2$s__item--post-type-%3$s">
				<a class="%2$s__link" href="%4$s">%5$s</a>
			</li>',
			implode( ' ', self::$item_classes ),
			self::$breadcrumbs_class,
			$post_type,
			get_post_type_archive_link( $post_type ),
			$post_type_object->labels->name
		);
	}

	/**
	 * Get breadcrumb parent item
	 */
	public static function item_parent( object $post ): string {
		return sprintf(
			'<li class="%1$s %2$s__item--parent-page %2$s__item--parent-page-%3$s">
				<a class="%2$s__link" href="%4$s">%5$s</a>
			</li>',
			implode( ' ', self::$item_classes ),
			self::$breadcrumbs_class,
			$post,
			get_permalink( $post ),
			get_the_title( $post )
		);
	}

	/**
	 * Get breadcrumb link item
	 */
	public static function item_link( string $title, string $link ): string {
		return sprintf(
			'<li class="%1$s %2$s__item--parent">
				<a class="%2$s__link" href="%4$s">%3$s</a>
			</li>',
			self::$item_classes,
			self::$breadcrumbs_class,
			$title,
			$link
		);
	}

	/**
	 * Display breadcrumbs
	 */
	public static function display(): void {
		global $post;

		// Do not display on the homepage
		if ( is_front_page() ) {
			return;
		}

		$breadcrumb  = self::start();
		$breadcrumb .= self::home();

		if ( is_archive() && ! is_tax() && ! is_category() && ! is_tag() ) {
			$breadcrumb .= self::item_current( post_type_archive_title( '', false ) );
		}

		if ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {
			$post_type = get_post_type();

			if ( $post_type != 'post' ) {
				$breadcrumb .= self::item_cpt( $post_type );
			}

			$breadcrumb .= self::item_current( get_queried_object()->name );
		}

		if ( is_home() ) {
			$breadcrumb .= self::item_current( get_queried_object()->post_title );
		}

		if ( is_single() ) {
			$post_type = get_post_type();

			if ( $post_type != 'post' ) {
				$breadcrumb .= self::item_cpt( $post_type );
			}

			// @TODO This needs tidying up
			// Get primary post category
			$primary_category = PrimaryCategory::get_primary_category_no_fallback( $post->ID );

			if ( $primary_category ) {
				$category = $primary_category;
			} else {
				// Get post category info
				$categories = get_the_category();

				if ( ! empty( $categories ) ) {
					$categorie_values = array_values( $categories );
					$category         = end( $categorie_values ); // Get last category post is in
				}
			}

			if ( ! empty( $category ) ) {
				// Get parent any categories and create array
				$get_cat_parents = rtrim( get_category_parents( $category->term_id, true, ',' ), ',' );
				$cat_parents     = explode( ',', $get_cat_parents );

				// Loop through parent categories and store in variable $cat_display
				$cat_display = '';
				foreach ( $cat_parents as $parents ) {
					$breadcrumb .= self::item_cat( $parents );
				}
			}

			// @TODO Find a nicer / cleaner implementation for custom taxonomies
			// Could use a filter to hook in and add custom taxonomies
			$custom_taxonomy = 'inspiration-category';
			$taxonomy_exists = taxonomy_exists( $custom_taxonomy );
			if ( empty( $category ) && ! empty( $custom_taxonomy ) && $taxonomy_exists ) {
				$taxonomy_terms = get_the_terms( get_the_ID(), $custom_taxonomy );

				if ( $taxonomy_terms ) {
					$cat_id   = $taxonomy_terms[0]->term_id;
					$cat_link = get_term_link( $taxonomy_terms[0]->term_id, $custom_taxonomy );
					$cat_name = $taxonomy_terms[0]->name;
				}
			}

			// Check if the post is in a category
			if ( ! empty( $category ) ) {
				// echo $cat_display;
				// $breadcrumb .= self::item_current( get_the_title() );
			} elseif ( ! empty( $cat_id ) ) { // Else if post is in a custom taxonomy
				$breadcrumb .= self::item_link( $cat_name, $cat_link );
			}

			$breadcrumb .= self::item_current( get_the_title() );
		}

		if ( is_category() ) {
			$breadcrumb .= self::item_current( single_cat_title( '', false ) );
		}

		if ( is_page() ) {
			if ( $post->post_parent ) {
				$ancestors = array_reverse( get_post_ancestors( $post->ID ) ); // If child page, get parents

				foreach ( $ancestors as $ancestor ) {
					$breadcrumb .= self::item_parent( $ancestor );
				}
			}

			$breadcrumb .= self::item_current( get_the_title() );
		}

		if ( is_tag() ) {
			$term_id       = get_query_var( 'tag_id' );
			$taxonomy      = 'post_tag';
			$args          = 'include=' . $term_id;
			$terms         = get_terms( $taxonomy, $args );
			$get_term_id   = $terms[0]->term_id;
			$get_term_slug = $terms[0]->slug;
			$get_term_name = $terms[0]->name;

			$breadcrumb .= self::item_current( $get_term_name );
		}

		if ( is_day() ) {
			$title       = get_the_time( 'Y' ) . ' Archives';
			$link        = get_year_link( get_the_time( 'Y' ) );
			$breadcrumb .= self::item_link( $title, $link );

			$title       = get_the_time( 'M' ) . ' Archives';
			$link        = get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) );
			$breadcrumb .= self::item_link( $title, $link );

			$title       = get_the_time( 'jS' ) . ' ' . get_the_time( 'M' );
			$breadcrumb .= self::item_current( $title );
		}

		if ( is_month() ) {
			$title       = get_the_time( 'Y' ) . ' Archives';
			$link        = get_year_link( get_the_time( 'Y' ) );
			$breadcrumb .= self::item_link( $title, $link );

			$title       = get_the_time( 'M' ) . ' Archives';
			$breadcrumb .= self::item_current( $title );
		}

		if ( is_year() ) {
			$title       = get_the_time( 'Y' ) . ' Archives';
			$breadcrumb .= self::item_current( $title );
		}

		if ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );

			$title       = 'Author: ' . $userdata->display_name;
			$breadcrumb .= self::item_current( $title );
		}

		if ( get_query_var( 'paged' ) ) {
			$title       = __( 'Page', THEMEDOMAIN ) . ' ' . get_query_var( 'paged' );
			$breadcrumb .= self::item_current( $title );
		}

		if ( is_search() ) {
			$title       = 'Search results for: ' . get_search_query();
			$breadcrumb .= self::item_current( $title );
		}

		if ( is_404() ) {
			$breadcrumb .= self::item_current( '404' );
		}

		$breadcrumb .= self::end();

		echo $breadcrumb;
	}

	public static function get_item_classes(): array {
		return self::$item_classes;
	}

	public static function set_item_classes( array $item_classes ): void {
		self::$item_classes = $item_classes;
	}

	public static function get_breadcrumbs_class(): string {
		return self::$breadcrumbs_class;
	}

	public static function set_breadcrumbs_class( string $breadcrumbs_class ): void {
		self::$breadcrumbs_class = $breadcrumbs_class;
	}

	public static function get_home_title(): string {
		return self::$home_title;
	}

	public static function set_home_title( string $home_title ): void {
		self::$home_title = $home_title;
	}

	public static function get_custom_taxonomy(): string {
		return self::$custom_taxonomy;
	}

	public static function set_custom_taxonomy( string $custom_taxonomy ): void {
		self::$custom_taxonomy = $custom_taxonomy;
	}

}
