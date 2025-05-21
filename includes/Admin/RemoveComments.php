<?php

namespace Pelican\Theme\Admin;

class RemoveComments {

	private array $post_types;

	public function __construct() {
		$this->post_types = [ 'page', 'post' ];

		add_action( 'admin_menu', [ $this, 'remove_comments_admin' ] );
		add_action( 'init', [ $this, 'remove_comments' ] );
		add_action( 'wp_before_admin_bar_render', [ $this, 'remove_admin_bar_comments' ] );
		add_filter( 'comments_open', [ $this, 'filter_comments_open' ], 99, 2 );
	}

	public function filter_comments_open( bool $comments_open, int $post_id ): bool {
		$post_type = get_post_type( $post_id );
		if ( ! in_array( $post_type, $this->post_types, true ) ) {
			return $comments_open;
		}

		return false;
	}

	public function remove_comments_admin(): void {
		remove_menu_page( 'edit-comments.php' );
	}

	public function remove_comments(): void {
		foreach ( $this->post_types as $post_type ) {
			remove_post_type_support( $post_type, 'comments' );
		}
	}

	public function remove_admin_bar_comments(): void {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'comments' );
	}

}

new RemoveComments();
