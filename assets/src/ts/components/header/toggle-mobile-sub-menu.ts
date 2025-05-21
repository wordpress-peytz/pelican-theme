// External dependencies.
import $ from 'jquery';

/**
* @return {void}
*/
const toggleMobileSubMenu = (): void => {
  'use strict';

  const menuParent = $( '.menu-mobile__item--has-children' );

  if ( menuParent.hasClass( 'menu-mobile__item--current-ancestor' ) ) {
    $( '.menu-mobile__item--current-ancestor' ).addClass(
      'menu-mobile__item--has-children--is-active'
    );
  }

  menuParent.children( 'a' ).on( 'click', ( e ) => {
    e.preventDefault();

    const classActive = $( e.currentTarget )
    .parent()
    .hasClass( 'menu-mobile__item--has-children--is-active' );

    menuParent.removeClass( 'menu-mobile__item--has-children--is-active' );
    menuParent.children( '.menu-mobile__sub-menu' ).slideUp( 100 );

    if ( ! classActive ) {
      $( e.currentTarget )
      .parent()
      .addClass( 'menu-mobile__item--has-children--is-active' );
      $( '.menu-mobile__sub-menu', $( e.currentTarget ).parent() ).slideDown(
        100
      );
    }
  } );
};

export default toggleMobileSubMenu;
