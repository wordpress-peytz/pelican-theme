// External dependencies.
import $ from 'jquery';

const removeBodyOverlay = (): void => {
  'use strict';

  const bodyOverlay = $( '.body-overlay' );
  const hamburger = $( '.hamburger' );
  const navMobile = $( '.nav-mobile' );
  const searchToggleButton = $( '.header-search-toggle-button__button' );
  const searchForm = $( '.header-search-form' );

  bodyOverlay.on( 'click', ( e ) => {
    e.preventDefault();

    // remove body overlay
    bodyOverlay.removeClass( 'body-overlay--is-active' );

    if ( searchForm.hasClass( 'header-search-form--is-open' ) ) {
      searchForm.removeClass( 'header-search-form--is-open' );
    }

    // Remove mobile menu
    if ( navMobile.hasClass( 'nav-mobile--open' ) ) {
      navMobile.removeClass( 'nav-mobile--open' );
      hamburger.removeClass( 'active' );
    }

    // Remove search button active state
    if ( searchToggleButton.hasClass( 'active' ) ) {
      searchToggleButton.removeClass( 'active' );
    }

    // Close any open submenus.
    $( '.menu__item--has-children > a' )
    .removeClass( 'menu__link--is-active' )
    .next()
    .removeClass( 'menu__sub-menu--is-visible' );
  } );
};

export default removeBodyOverlay;
