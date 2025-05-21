// Declare constant for detecting the passed build environments.
// const isProd: boolean = process.env.NODE_ENV === 'production';

/**
 * External dependencies
 */
// const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');

/**
 * Internal dependencies
 */
// const { getEntries } = require( './entries/index.ts' );
// const { getExternals } = require( './externals/index.ts' );
// const DebuggingInfo = require( './plugins/debugging-info/index' );
const defaultConfig: WebpackConfiguration = require( '@wordpress/scripts/config/webpack.config.js' );

/**
 * Base Configuration
 * @param subfolderPath
 * @param relativeOutputPath
 */
const baseConfigFunction = (
  subfolderPath: string = __dirname,
  relativeOutputPath: string = '../dist'
): WebpackConfiguration => {
  const isProd: boolean = process.env.NODE_ENV === 'production';
  const path = require('path');
  const { getEntries } = require( './entries/index.ts' );
  const { getExternals } = require( './externals/index.ts' );
  return {
    mode: isProd ? 'production' : 'development',
    entry: {
      ...getEntries( subfolderPath ), // Load entries based on the passed subfolderPath
    },
    output: {
      path: path.resolve( process.cwd(), relativeOutputPath ),
      chunkFilename: ( pathData ) =>
        `js/chunks/${ pathData.chunk.id ? pathData.chunk.id : '' }.js`,
    },
    module: {
      rules: [
        // Fonts
        {
          test: /\.(woff|woff2|eot|ttf|otf|svg)$/i,
          type: 'asset/resource',
          generator: { filename: '[path][name][ext]' },
          include: [ path.resolve( process.cwd(), 'fonts' ) ],
          exclude: [
            path.resolve( process.cwd(), 'icons' ),
            path.resolve( process.cwd(), 'img' ),
          ],
        },
        // Images
        {
          test: /\.(bmp|png|jpe?g|gif|webp|svg)$/i,
          type: 'asset/resource',
          generator: { filename: '[path][name][ext]' },
          include: [ path.resolve( process.cwd(), 'img' ) ],
          exclude: [
            path.resolve( process.cwd(), 'icons' ),
            path.resolve( process.cwd(), 'fonts' ),
          ],
        },
        // TypeScript
        {
          test: /\.(ts|tsx)$/i,
          use: 'ts-loader',
          include: [
            path.resolve( process.cwd(), 'wp-scripts' ),
            path.resolve( process.cwd(), 'ts' ),
            path.resolve( process.cwd(), 'typescript' ),
            path.resolve( process.cwd(), 'react' ),
          ],
          exclude: [ path.resolve( process.cwd(), 'js' ) ],
        },
      ],
    },
    optimization: {
      minimize: isProd,
      minimizer: [
        new TerserPlugin( {
          parallel: true,
          terserOptions: {
            output: { comments: /translators:/i },
            compress: {
              passes: 2,
              drop_console: isProd,
            },
            mangle: { reserved: [ '__', '_n', '_nx', '_x' ] },
          },
          extractComments: isProd,
        } ),
      ],
    },
    plugins: [],
    resolve: {
      extensions: [ '.js', '.jsx', '.ts', '.tsx' ],
    },
    externalsType: 'window',
    externals: {
      ...getExternals( subfolderPath ), // Load externals based on the passed subfolderPath
    },
    watchOptions: {
      ignored: [ '**/dist/**/*' ],
    },
  };
};

const baseConfig: WebpackConfiguration = baseConfigFunction();

// Custom subfolder config
const subfolderConfig: WebpackConfiguration = {
  module: {
    rules: [
      // Add or override rules here if necessary, e.g. custom loaders
    ],
  },
  plugins: [
    // Add or override plugins here if necessary
  ],
};

/**
 * Merge base config with subfolder config
 */
module.exports = {
  ...defaultConfig,
  ...baseConfig,
  ...subfolderConfig,
  module: {
    ...defaultConfig.module,
    ...baseConfig.module,
    rules: [
      ...( defaultConfig.module?.rules || [] ),
      ...( baseConfig.module?.rules || [] ),
      ...( subfolderConfig.module?.rules || [] ),
    ],
  },
  plugins: [
    ...( defaultConfig.plugins || [] ),
    ...( baseConfig.plugins || [] ),
    ...( subfolderConfig.plugins || [] ),
  ],
};
