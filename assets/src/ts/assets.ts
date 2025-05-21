// Used to dynamical import all static assets.
// Good for code-splitting huge files.
// Further documentation: https://peytzco.atlassian.net/wiki/spaces/WORDPRESS/pages/4062838785/Files+introduced+with+pnpm+and+wp-scripts#File%3A-assets%2Fsrc%2Fts%2Fassets.ts

/*
* @see https://webpack.js.org/guides/dependency-management/#requirecontext
* @see https://webpack.js.org/guides/code-splitting/
* @see https://eams.dev/post/require-context
*
* @param {__WebpackModuleApi.RequireContext} context
*/
const getModules = async ( context: __WebpackModuleApi.RequireContext ) => {
  return context.keys().map( context );
};

// fonts
// getModules(require.context('../fonts', true, /\.(woff(2)?|ttf|otf|eot|svg)$/));

// img
// getModules(require.context('../img', true, /\.(png|gif|jpe?g|svg)$/));

require.ensure( [], () => {
  // fonts
  const fontsContext = require.context(
    '../fonts',
    true,
    /\.(woff(2)?|ttf|otf|eot|svg)$/
  );
  const fontsModules = getModules( fontsContext );
  console.log( fontsModules.then( ( modules ) => modules ) );

  // img
  const imgContext = require.context(
    '../img',
    true,
    /\.(png|gif|jpe?g|svg)$/
  );
  const imgModules = getModules( imgContext );
  console.log( imgModules.then( ( modules ) => modules ) );
} );
