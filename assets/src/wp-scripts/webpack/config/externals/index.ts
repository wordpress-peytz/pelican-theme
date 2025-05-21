/**
 * Internal dependencies.
 */
const path = require( 'path' );
const fs = require( 'fs' );

/**
 * externals
 */
/**
 * Note
 * =====
 * **Important note about wp-scripts and webpack externals**
 *
 * By default, wp-scripts will exctract a number of script dependencies,
 * if they are registered as dependencies for the block script.
 * Below is a list of default scripts.
 * For reference, please see the links below.
 *
 * [
 *   [ 'moment' => [ 'window', 'moment' ] ],
 *   [ '@babel/runtime/regenerator' => [ 'window', 'regeneratorRuntime' ] ],
 *   [ 'lodash', 'lodash-es' => [ 'window', 'lodash' ] ],
 *   [ 'jquery' => [ 'window', 'jQuery' ] ],
 *   [ 'react' => [ 'window', 'React' ] ],
 *   [ 'react-dom' => [ 'window', 'ReactDOM' ] ],
 *   [ '@wordpress/*' => [ 'window', 'wp.*' ] ]?.filter((script) => {
 *     // Note
 *     // wp-scripts will skip externalizing the following scripts, as they must be bundled.
 *     return ![
 *       '@wordpress/dataviews',
 *       '@wordpress/icons',
 *       '@wordpress/interface',
 *       '@wordpress/sync',
 *       '@wordpress/undo-manager',
 *     ]?.includes(script);
 *   }),
 * ];
 *
 * @see https://github.com/WordPress/gutenberg/tree/trunk/packages/dependency-extraction-webpack-plugin#dependency-extraction-webpack-plugin
 * @see https://github.com/WordPress/gutenberg/blob/trunk/packages/dependency-extraction-webpack-plugin/lib/util.js#L14-L61
 * @see https://xwp.co/javascript-dependencies-wordpress-blocks/
 * @see https://webpack.js.org/configuration/externals/
 *
 * Externals should be added in the `externals.json` file in this file directory.
 *
 * Swiper: Example of adding an external library.
 *
 * file: externals.json
 * ```json
 * {
 *     "swiper": "Swiper"
 * }
 * ```
 *
 * file: ResourcesManager.php
 * ```php
 * # css
 * wp_register_style( 'swiper', 'https://unpkg.com/swiper@11.0.7/swiper.min.css', [], '11.0.7' 'all' );
 * wp_register_style( 'project-swiper-style', 'path/to/project/swiper/style.css', [ 'swiper' ], '11.0.7' 'all' );
 * wp_enqueue_style( 'project-swiper-style' );
 *
 * # js
 * wp_register_script( 'swiper', 'https://unpkg.com/swiper@11.0.7/swiper.min.js', [], '11.0.7' true );
 * wp_register_script( 'project-swiper-script', 'path/to/project/swiper/script.js', [ 'swiper' ], '11.0.7' true );
 * wp_enqueue_script( 'project-swiper-script' );
 * ```
 *
 * file: project-swiper-script.ts
 * ```ts
 * import Swiper from 'swiper';
 *
 * document.addEventListener(
 *   'DOMContentLoaded',
 *   () => {
 *     // Store swiper instances.
 *     const swiperInstances: Swiper[] = [];
 *     document
 *       ?.querySelectorAll(
 *         String(
 *           // Reduce swiper instance targets to your custom target selectors (with a nested swiper container).
 *           Array?.from(['.custom-wrapper-selector', '.swiper'])?.join(' ')
 *         )
 *       )
 *       ?.forEach((target: HTMLElement) => {
 *         swiperInstances?.push(new Swiper(target, {}));
 *       });
 *
 *     // Output swiperInstances to console.
 *     console?.log(swiperInstances);
 *   },
 *   false
 * );
 * ```
 */

/**
 * getExternals.
 *
 * @param {string} externalsDirectory The path to the directory containing externals.json.
 * @return {Object} Returns modified externals object.
 */
const getExternals: object = function ( externalsDirectory: string ) {
  const externalsPath: string = path.resolve(
    externalsDirectory,
    'externals.json'
  );
  let jsonExternals: object = {};

  try {
    if ( fs.existsSync( externalsPath ) ) {
      jsonExternals = require( externalsPath );
    } else {
      console.warn( `Externals file not found at ${ externalsPath }` );
    }
  } catch ( error ) {
    console.error( 'Error loading externals:', error );
  }

  const externals: object = jsonExternals || {};

  return Object.fromEntries(
    new Map(
      Object.entries( externals ).map( ( external ) => {
        return [ `${ external[ 0 ] }`, `${ external[ 1 ] }` ];
      } )
    )
  );
};

module.exports = {
  getExternals,
};
