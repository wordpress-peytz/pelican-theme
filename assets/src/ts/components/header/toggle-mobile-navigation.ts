// External dependencies.
import $ from 'jquery';

// Toggle the mobile navigation on hamburger click.
const toggleMobileNavigation = (): void => {
  'use strict';

  const bodyOverlay = $( '.body-overlay' );
  const hamburger = $( '.hamburger' );
  const navMobile = $( '.nav-mobile' );
  const searchToggleButton = $( '.header-search-toggle-button__button' );
  const searchForm = $( '.header-search-form' );
  const searchFormField = $(
    '.header-search-form input.wp-block-search__input'
  );

  hamburger.on( 'click', () => {
    navMobile.toggleClass( 'nav-mobile--open' );
    hamburger.toggleClass( 'active' );

    // Remove / add body overlay
    if ( navMobile.hasClass( 'nav-mobile--open' ) ) {
      hamburger.attr( 'aria-expanded', 'true' );
      bodyOverlay.addClass( 'body-overlay--is-active' );
    } else {
      hamburger.attr( 'aria-expanded', 'false' );
      bodyOverlay.removeClass( 'body-overlay--is-active' );
    }

    // Remove search if visible
    searchForm.removeClass( 'header-search-form--is-open' );
    searchToggleButton.removeClass( 'active' );
    searchFormField.trigger( 'blur' );
  } );

  hamburger.on( 'mousedown', ( e ) => {
    e.preventDefault();
  } );
};

export default toggleMobileNavigation;
