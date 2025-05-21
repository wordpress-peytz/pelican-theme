/**
* External dependencies.
*/
import $ from 'jquery';

/**
* toggleSearch.
*
* @return {void}
*/
const toggleSearch = (): void => {
  'use strict';

  const bodyOverlay = $( '.body-overlay' );
  const hamburger = $( '.hamburger' );
  const navMobile = $( '.nav-mobile' );
  const searchToggleButton = $( '.header-search-toggle-button__button' );
  const searchForm = $( '.header-search-form' );
  const searchFormField = $(
    '.header-search-form input.wp-block-search__input'
  );

  searchForm.removeClass( 'header-search-form--is-open' );

  searchToggleButton.on( 'click', ( e ) => {
    e.preventDefault();

    let toOpen = true;

    if ( searchForm.hasClass( 'header-search-form--is-open' ) ) {
      toOpen = false;
    }

    // Remove class active from search icon
    searchToggleButton.removeClass( 'active' );

    // Remove class active from hamburger
    hamburger.removeClass( 'active' );

    // remove mobile menu
    if ( navMobile.hasClass( 'nav-mobile--open' ) ) {
      navMobile.removeClass( 'nav-mobile--open' );
    }

    // remove body overlay
    bodyOverlay.removeClass( 'body-overlay--is-active' );

    // remove body overlay
    bodyOverlay.removeClass( 'body-overlay--is-active' );

    // close search field
    searchForm.removeClass( 'header-search-form--is-open' );
    searchFormField.trigger( 'blur' );

    // Open if needed
    if ( toOpen ) {
      searchForm.toggleClass( 'header-search-form--is-open' );

      searchFormField.trigger( 'focus' );

      // Add class active to search icon
      searchToggleButton.addClass( 'active' );

      // add body overlay
      bodyOverlay.toggleClass( 'body-overlay--is-active' );

      // Close any open submenus
      $( '.menu__item--has-children > a' )
      .removeClass( 'menu__link--is-active' )
      .next()
      .removeClass( 'menu__sub-menu--is-visible' );
    }
  } );
};

export default toggleSearch;
