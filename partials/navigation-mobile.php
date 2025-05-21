<?php if ( has_nav_menu( 'main-nav-mobile' ) ) : ?>
	<div class="nav-mobile">

		<div class="nav-mobile-inner">

			<?php do_action( THEMEDOMAIN . '_before_mobile_navigation' ); ?>

			<?php Pelican\Theme\Core\AddMenus::main_menu_mobile(); ?>

			<?php do_action( THEMEDOMAIN . '_after_mobile_navigation' ); ?>

		</div>

	</div>
<?php endif; ?>
