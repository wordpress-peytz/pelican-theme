/** @type {import('stylelint').Config} */

/**
 * stylelint.config.js
 *
 * Export custom config overrides.
 */
module.exports = {
  // Extend root config.
  ...( require( '@project/root-bundler/stylelint.config' ) || {} ),

  // Custom overrides.
  ...{
    // Any custom overrides go here...
  },
};
