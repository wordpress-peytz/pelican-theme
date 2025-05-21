/**
 * entries
 */

/**
 * getEntries.
 *
 * @param {Object} entries
 *
 * @param          entriesDirectory
 * @return {Object} Returns modified entries object.
 */
const getEntries: object = function (entriesDirectory: string) {
  const path = require( 'path' );
  const fs = require( 'fs' );
  const entriesPath: string = path.resolve( entriesDirectory, 'entries.json' );
  let jsonEntries: object = {};

  try {
    if ( fs.existsSync( entriesPath ) ) {
      jsonEntries = require( entriesPath );
    } else {
      console.warn( `Entries file not found at ${ entriesPath }` );
    }
  } catch ( error ) {
    console.error( 'Error loading entries:', error );
  }

  const entries: object = jsonEntries || {};

  return Object.fromEntries(
    new Map(
      Object.entries( entries ).map( ( entry ) => {
        return [ `${ entry[ 0 ] }${ getInflix() }`, `${ entry[ 1 ] }` ];
      } )
    )
  );
};

/**
 * getInflix.
 *
 * @return {string} Returns inflix derived from the provided environment args.
 */
const getInflix = function () {
  // Declare constant for detecting the passed build environments.
  const isProd: boolean = process.env.NODE_ENV === 'production';
  return isProd ? '.min' : '';
};

// Declare default export.
module.exports = {
  getEntries,
};
