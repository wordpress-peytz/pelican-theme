// Export custom prettier config overrides.
module.exports = {
  // Extend on @project/root-bundler base config.
  ...( require( '@project/root-bundler/.prettierrc.js' ) || {} ),

  // Custom overrides.
  ...{
    // Any custom overrides go here...
  },
};
