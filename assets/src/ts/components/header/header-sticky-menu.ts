// External dependencies.
import $ from 'jquery';

/**
* Plugin for sticky menu on scroll up.
* Based on https://osvaldas.info/examples/auto-hide-sticky-header/?reactive-plus.
*/
const headerStickyMenu = (): boolean | void => {
  'use strict';

  const elSelector = '.site-header';
  const elClassScroll = 'site-header--scrolling';
  const elClassScrollUp = 'site-header--scrolling-up';
  const elClassScrollDown = 'site-header--scrolling-down';
  const elClassScrollPastHeader = 'site-header--scrolling-past-header';
  const $element = $( elSelector );
  const $header = $( elSelector );
  let elHeaderHeight = 0;

  if ( $header ) {
    elHeaderHeight = $header.height();
  }

  if ( ! $element.length ) {
    return true;
  }

  const $window = $( window );

  let elHeight = 0;
  let elTop = 0;
  let wScrollCurrent = 0;
  let wScrollBefore = 0;
  let wScrollDiff = 0;
  let pageTop = 0;

  const headerHasAdminbar = (): void => {
    if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
      const adminbarHeight = $( '#wpadminbar' ).height();

      elTop = adminbarHeight;
      pageTop = adminbarHeight;
    }
  };

  $( () => {
    headerHasAdminbar();
  } );
  $( window ).on( 'resize', headerHasAdminbar );

  $element.toggleClass(
    'is-scrolling-over-post-content',
    $( '.hero' ).length > 0 &&
    $window.scrollTop() >
    $( '.hero' )?.offset()?.top + $( '.hero' )?.height() - elHeaderHeight
  );
  $element.toggleClass(
    'is-scrolling-over-post-content',
    $( '.post-header' ).length > 0 &&
    $window.scrollTop() >
    $( '.post-header' )?.offset()?.top +
    $( '.post-header' )?.height() -
    elHeaderHeight
  );

  $window.on( 'scroll', () => {
    elHeight = $element.outerHeight();
    wScrollCurrent = $window.scrollTop();
    wScrollDiff = wScrollBefore - wScrollCurrent; // scroll difference. Negative if scrolled down, positive if scrolled up
    elTop = parseInt( $element.css( 'top' ) ) + wScrollDiff; // current position plus scroll change

    $element.toggleClass( elClassScroll, wScrollCurrent > 0 ); // toggles scrolling classname
    $element.toggleClass(
      elClassScrollUp,
      wScrollCurrent > 0 && wScrollDiff > 0
    ); // toggles scrolling up classname
    $element.toggleClass( elClassScrollDown, wScrollDiff < 0 ); // toggles scrolling down classname
    $element.toggleClass(
      elClassScrollPastHeader,
      wScrollCurrent > elHeaderHeight
    ); // toggles scrolling past header classname
    $element.toggleClass(
      'is-scrolling-over-post-content',
      $( '.hero' ).length > 0 &&
      wScrollCurrent >
      $( '.hero' )?.offset()?.top + $( '.hero' )?.height() - elHeaderHeight
    );
    $element.toggleClass(
      'is-scrolling-over-post-content',
      $( '.post-header' ).length > 0 &&
      wScrollCurrent >
      $( '.post-header' )?.offset()?.top +
      $( '.post-header' )?.height() -
      elHeaderHeight
    );

    if ( wScrollDiff < 0 && wScrollCurrent > elHeaderHeight ) {
      if (
        $element.find( '.menu__sub-menu' ) &&
        $element.find( '.menu__sub-menu--is-visible' )
      ) {
        // remove body overlay
        $( '.body-overlay' ).removeClass( 'body-overlay--is-active' );
        // Close any open submenus.
        $( '.menu__item--has-children > a' )
        ?.removeClass( 'menu__link--is-active' )
        ?.next()
        ?.removeClass( 'menu__sub-menu--is-visible' );
      }
    }

    if ( wScrollCurrent <= 0 ) {
      $element.css( 'top', pageTop ); // scrolled to the very top; element sticks to the top
    } else if ( wScrollDiff > 0 ) {
      $element.css( 'top', elTop > pageTop ? pageTop : elTop ); // scrolled up; element slides in
    } else if ( wScrollDiff < 0 ) {
      $element.css( 'top', Math.abs( elTop ) > elHeight ? -elHeight : elTop ); // scrolled down; element slides out
    }

    wScrollBefore = wScrollCurrent;
  } );
};

export default headerStickyMenu;
