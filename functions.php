<?php
/**
* The main functions file for WordPress Theme Features
*
* @link http://codex.wordpress.org/Theme_Features
* @link http://codex.wordpress.org/Functions_File_Explained
*
* @package Pelican
*/

namespace Pelican\Theme;

// Theme domain for translations
if ( ! defined( 'THEMEDOMAIN' ) ) {
	define( 'THEMEDOMAIN', 'pelican' );
}

require_once __DIR__ . '/vendor/autoload.php';

// Load a class file while allowing for child theme overrides
function load_class_file( string $class_path ): void {
	$child_path  = get_stylesheet_directory() . '/includes/' . $class_path . '.php';
	$parent_path = get_template_directory() . '/includes/' . $class_path . '.php';

	if ( file_exists( $child_path ) ) {
		require_once $child_path;
	} elseif ( file_exists( $parent_path ) ) {
		require_once $parent_path;
	}
}

// Admin
load_class_file( 'Admin/DisableTrackbacks' );
load_class_file( 'Admin/RemoveComments' );

// Core
load_class_file( 'Core/AddMenus' );
load_class_file( 'Core/ChangeSingleAttachmentPage' );
load_class_file( 'Core/EnqueueAssets' );
load_class_file( 'Core/SearchEmptyFix' );
load_class_file( 'Core/Sidebars' );
load_class_file( 'Core/ThemeSetup' );
load_class_file( 'Core/Multisite' );
load_class_file( 'Core/PrettifyLoginPage' );
load_class_file( 'Core/YearShortcode' );

// Markup
load_class_file( 'Markup/Excerpt' );
load_class_file( 'Markup/ExtraClasses' );
load_class_file( 'Markup/Font' );
load_class_file( 'Markup/FunctionHooksBodyTop' );
load_class_file( 'Markup/FunctionHooksFooter' );
load_class_file( 'Markup/FunctionHooksHeader' );
load_class_file( 'Markup/FunctionHooksPrimary' );
load_class_file( 'Markup/Pagination' );
load_class_file( 'Markup/Partials' );
load_class_file( 'Markup/Template' );
