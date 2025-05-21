// External dependencies.
import $ from 'jquery';

// Stop scroll of main body when swiping on mobile navigation.
const handleMobileNavigationScroll = (): boolean | void => {
  'use strict';

  const navMobile = $( 'nav-mobile' )?.first();
  let overflow: boolean | number = false;

  $( window ).on( 'load resize', () => {
    overflow = navMobile?.[ 0 ]?.scrollHeight - $( '#fixed' )?.height();
  } );

  navMobile?.on( 'touchmove', () => {
    if ( overflow ) {
      return true;
    }

    return false;
  } );
};

export default handleMobileNavigationScroll;
