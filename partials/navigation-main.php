<?php
/**
 * This whole file needs a different html structure.
 * It's based on Foundation and I guess we need a another structure for whatever menu we'll be styling.
 */
?>

<?php do_action( THEMEDOMAIN . '_before_main_nav' ); ?>

<?php if ( has_nav_menu( 'main-nav' ) ) : ?>
	<nav class="<?php echo apply_filters( THEMEDOMAIN . '_menu_wrapper_class', 'menu-wrapper' ); ?>">

		<?php if ( has_nav_menu( 'main-nav' ) ) : ?>
			<?php Pelican\Theme\Core\Menus::main_menu(); ?>
		<?php endif; ?>

		<?php if ( has_nav_menu( 'main-nav-mobile' ) ) : ?>
			<button type="button" class="hamburger" aria-label="<?php _e( 'Menu', THEMEDOMAIN ); ?>" aria-expanded="false">
				<span class="hamburger__icon"></span>
			</button>
		<?php endif; ?>

	</nav>
<?php endif; ?>

<?php if ( ! get_theme_mod( THEMEDOMAIN . '_hide_search' ) ) : ?>
	<div class="<?php echo apply_filters( THEMEDOMAIN . '_header_search_class', 'header-search-toggle-button' ); ?>">

		<button type="button" class="header-search-toggle-button__button" aria-label="<?php _e( 'Toggle search', THEMEDOMAIN ); ?>">
			<span class="header-search-toggle-button__icon" aria-hidden="true"></span>
			<span class="header-search-toggle-button__text"><?php _e( 'Toggle search', THEMEDOMAIN ); ?></span>
		</button>

	</div>
<?php endif; ?>

<?php do_action( THEMEDOMAIN . '_after_main_nav' ); ?>
