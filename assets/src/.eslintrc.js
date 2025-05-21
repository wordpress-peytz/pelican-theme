// Export custom config overrides.
module.exports = {
  // Extend root-bundler base config.
  ...( require( '@project/root-bundler/.eslintrc.js' ) || {} ),

  // Custom overrides.
  ...{
    // Any custom overrides go here...
  },
};
