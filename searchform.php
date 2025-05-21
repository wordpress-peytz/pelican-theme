<?php
/**
 * Displays the search form
 *
 * @link http://codex.wordpress.org/Function_Reference/get_search_form
 * @package WordPress
 *
 */

$search_args = [
	'blockName' => 'core/search',
	'attrs'     => [
		'showLabel'   => false,
		'placeholder' => __( 'Search', THEMEDOMAIN ),
		'buttonText'  => __( 'Search', THEMEDOMAIN ),
		'label'       => __( 'Search', THEMEDOMAIN ),
	],
];

$search_block = render_block( $search_args );

if ( $search_block ) :
	echo $search_block;
endif;
