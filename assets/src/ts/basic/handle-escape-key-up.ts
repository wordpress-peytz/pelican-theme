// External dependencies.
import $ from 'jquery';

export const handlerEscapeKeyUp = () => {
  const hamburger = $( '.hamburger' );
  const navMobile = $( '.nav-mobile' );
  const searchButton = $( '.header-search-toggle-button__button' );

  // Remove body-overlay if visible
  $( '.body-overlay' ).removeClass( 'body-overlay--is-active' );

  // Remove search if visible
  $( '.header-search-form' ).removeClass( 'header-search-form--is-open' );
  searchButton.removeClass( 'active' );
  $( '.header-search-form .wp-block-search__input' ).trigger( 'blur' );

  // Remove mobile menu
  if ( navMobile.hasClass( 'nav-mobile--open' ) ) {
    navMobile.removeClass( 'nav-mobile--open' );
    hamburger.removeClass( 'active' );
  }

  // Remove search button active state
  if ( searchButton.hasClass( 'active' ) ) {
    searchButton.removeClass( 'active' );
  }

  // Close any open submenus.
  $( '.menu__item--has-children > a' )
  .removeClass( 'menu__link--is-active' )
  .next()
  .removeClass( 'menu__sub-menu--is-visible' );
};

export default handlerEscapeKeyUp;
