// External dependencies.
import $ from 'jquery';
import { __ } from '@wordpress/i18n';

// Internal dependencies.
import handleMobileNavigationScroll from '../components/header/handle-mobile-navigation-scroll';
import headerStickyMenu from '../components/header/header-sticky-menu';
import removeBodyOverlay from '../components/header/remove-body-overlay';
import toggleMobileNavigation from '../components/header/toggle-mobile-navigation';
import toggleMobileSubMenu from '../components/header/toggle-mobile-sub-menu';
import toggleSearch from '../components/header/toggle-search';
import toggleSubMenu from '../components/header/toggle-sub-menu';
import heroVideoSettings from '../components/hero/hero-video-settings';
import handlers from '../basic/handlers';
import validationMessage from '../utils/validation-message-translations';

export const init = (): void => {
  /**
  * Wrap code in anonymous function and pass jQuery as an argument.
  * jQuery should be defined globally (`eslintrc` configuration).
  */
  ( () => {
    console.log( {
      msg: __( 'init.ts has loaded.', 'pelican' ),
    } );

    // Define default theme colors as empty object
    const pelicanSettings = window.pelicanSettings || {};

    console.log( {
      msg: __( 'pelicanSettings are loaded.', 'pelican' ),
      pelicanSettings,
    } );

    // Ensure that jQuery is loaded, before running the scripts that depend on it.
    if ( typeof $ === 'function' ) {
      console.log( {
        msg: 'jquery@' + $.fn.jquery + ' is loaded.',
        $,
        version: $.fn.jquery,
      } );

      // Run theme scripts
      handlers();
      handleMobileNavigationScroll();
      headerStickyMenu();
      removeBodyOverlay();
      toggleMobileNavigation();
      toggleMobileSubMenu();
      toggleSearch();
      toggleSubMenu();
      validationMessage();

      // Hero
      if ( $( '.hero.hero--with-video' ).length ) {
        heroVideoSettings();
      }
    }
  } )();
};

export default init;
