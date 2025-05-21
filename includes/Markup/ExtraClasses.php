<?php

namespace Pelican\Theme\Markup;

use stdClass;

/**
 * Hooks for better classes, primarily following BEM methodology
 */
class ExtraClasses {

	public function __construct() {

		// Header
		add_filter( 'get_custom_logo', [ $this, 'change_logo_class' ] );

		// Menus
		add_filter( 'nav_menu_css_class', [ $this, 'clean_li_classes' ], 10 );
		add_filter( 'nav_menu_item_id', '__return_empty_string' );
		add_filter( 'nav_menu_css_class', [ $this, 'change_li_modifier_classes' ], 10, 3 );
		add_filter( 'nav_menu_css_class', [ $this, 'add_li_class' ], 11, 3 );
		add_filter( 'nav_menu_link_attributes', [ $this, 'add_link_class' ], 10, 3 );
		add_filter( 'nav_menu_submenu_css_class', [ $this, 'change_sub_menu_class' ], 10, 3 );

		// Post pagination
		add_filter( 'next_posts_link_attributes', [ $this, 'next_posts_link_attributes' ] );
		add_filter( 'previous_posts_link_attributes', [ $this, 'previous_posts_link_attributes' ] );

		// Post links
		add_filter( 'next_post_link', [ $this, 'change_next_post_link' ] );
		add_filter( 'previous_post_link', [ $this, 'change_previous_post_link' ] );

		// Taxonomies
		add_filter( 'the_tags', [ $this, 'add_tag_link_class' ] );
		add_filter( 'the_category', [ $this, 'add_category_list_classes' ] );

		// Body
		add_filter( 'body_class', [ $this, 'body_classes' ] );
	}

	public function body_classes( array $classes ): array {
		global $post;

		if ( isset( $post ) && isset( $post->post_type ) ) {
			$classes[] = $post->post_type;
		}

		// Add taxonomy class to the body tag.
		if ( is_tax() ) {
			$classes[] = 'taxonomy';
		}

		return $classes;
	}

	// Change the custom logo html classes to match header-logo.php
	public function change_logo_class( string $html ): string {
		$html = str_replace( 'class="custom-logo-link"', 'class="logo__link"', $html );
		return str_replace( 'class="custom-logo"', 'class="logo__img"', $html );
	}

	// Remove menu list item classes that start with 'menu' or 'page'
	public function clean_li_classes( array $classes = [] ): array {
		foreach ( $classes as $key => $class ) {
			switch ( $class ) {
				case 'menu-item-has-children':
					$classes[ $key ] = 'has-children';
					break;

				case 'current-menu-item':
					$classes[ $key ] = 'current';
					break;

				case 'current-menu-parent':
				case 'current-menu-ancestor':
					$classes[ $key ] = 'current-ancestor';
					break;
			}
		}

		$classes = preg_grep( '/^current-menu|menu|page.*$/', $classes, PREG_GREP_INVERT );
		return array_unique( $classes );
	}

	/**
	 * Prepend the menu list item (li) class to variations (modifiers) like current-menu-item.
	 *
	 * @param string[] $classes   CSS classes applied to the item's `<li>` element.
	 * @param WP_Post  $menu_item Current menu item object.
	 * @param stdClass $args      An object of wp_nav_menu() arguments.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return string[] CSS classes applied to the menu item's `<li>` element.
	 */
	public function change_li_modifier_classes( array $classes, object $item, stdClass $args ): array {
		foreach ( $classes as &$class ) {
			$class = $args->menu_class . '__item--' . $class;
		}

		return $classes;
	}

	/**
	 * Add a menu list item (li) class based on menu location.
	 *
	 * @param string[] $classes   CSS classes applied to the menu item's `<li>` element.
	 * @param WP_Post  $menu_item The current menu item object.
	 * @param stdClass $args      An object of wp_nav_menu() arguments.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return string[] CSS classes applied to the menu item's `<li>` element.
	 */
	public function add_li_class( array $classes, object $item, stdClass $args ): array {
		if ( $item->menu_item_parent ) {
			array_unshift( $classes, $args->menu_class . '__sub-menu__item' );
		} else {
			array_unshift( $classes, $args->menu_class . '__item' );
		}

		return $classes;
	}

	/**
	 * Add a menu list item link (a) class based on menu location.
	 *
	 * @param array $atts
	 * @param WP_Post  $menu_item The current menu item object.
	 * @param stdClass $args      An object of wp_nav_menu() arguments.
	 */
	public function add_link_class( array $atts, object $item, stdClass $args ): array {
		if ( $item->menu_item_parent ) {
			$atts['class'] = $args->menu_class . '__sub-menu__link';
		} else {
			$atts['class'] = $args->menu_class . '__link';
		}
		return $atts;
	}

	/**
	 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
	 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
	 * @param int      $depth   Depth of menu item. Used for padding.
	 *
	 * @return array
	 */
	public function change_sub_menu_class( array $classes, object $args, int $depth ): array {
		return [ $args->menu_class . '__sub-menu' ];
	}

	// Custom posts navigation next link
	public function next_posts_link_attributes(): string {
		return 'class="pagination__link pagination__link--next"';
	}

	// Custom posts navigation previous link
	public function previous_posts_link_attributes(): string {
		return 'class="pagination__link pagination__link--previous"';
	}

	public function change_next_post_link( string $format ): string {
		return str_replace( 'href=', 'class="post-nav__link post-nav__link--next" href=', $format );
	}

	public function change_previous_post_link( string $format ): string {
		return str_replace( 'href=', 'class="post-nav__link post-nav__link--previous" href=', $format );
	}

	public function add_tag_link_class( string $html ): string {
		return str_replace( 'href=', 'class="tags__link" href=', $html );
	}

	public function add_category_list_classes( string $html ): string {
		$str = str_replace( 'class="post-categories"', 'class="categories__list"', $html );
		$str = str_replace( '<li>', '<li class="categories__item">', $str );
		$str = str_replace( '</li>', '<span>,</span></li>', $str );
		return str_replace( 'href=', 'class="categories__link" href=', $str );
	}

}

new ExtraClasses();
