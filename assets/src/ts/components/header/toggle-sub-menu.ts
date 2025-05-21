// External dependencies.
import $ from 'jquery';

// Toggle submenus in the main menu.
const toggleSubMenu = (): void => {
  'use strict';

  const bodyOverlay = $( '.body-overlay' );
  const searchToggleButton = $( '.header-search-toggle-button__button' );
  const searchForm = $( '.header-search-form' );

  $(
    '.menu__item--has-children > a, .menu-secondary__item--has-children > a'
  ).on( 'click', ( e ) => {
    e.preventDefault();

    const self = $( e.currentTarget );

    let toOpen = true;

    // If this submenu is already open we just need to close any open submenus.
    if ( $( self ).hasClass( 'menu__link--is-active' ) ) {
      toOpen = false;
    }

    // Close any open submenus
    $(
      '.menu__item--has-children > a, .menu-secondary__item--has-children > a'
    )
    .removeClass( 'menu__link--is-active' )
    .next()
    .removeClass( 'menu__sub-menu--is-visible' );

    // remove body overlay
    bodyOverlay.removeClass( 'body-overlay--is-active' );
    $( '.menu-secondary__item--has-children' ).toggleClass(
      'menu-secondary__item--has-children--is-active'
    );

    // Open if needed
    if ( toOpen ) {
      $( self ).toggleClass( 'menu__link--is-active' );
      $( self ).next().toggleClass( 'menu__sub-menu--is-visible' );

      // add body overlay
      bodyOverlay.toggleClass( 'body-overlay--is-active' );

      // close search field
      searchForm.removeClass( 'header-search-form--is-open' );
      searchToggleButton.removeClass( 'active' );
    }
  } );
};

export default toggleSubMenu;
