// webpack.config.js (Atmos Child Theme)
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

// Plugins.
const WebpackWatchedGlobEntries = require('webpack-watched-glob-entries-plugin');
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );
const autoprefixer = require('autoprefixer');
const RemoveFilesPlugin = require('remove-files-webpack-plugin');

// Utilities.
const path = require( 'path' );

module.exports = {
	...defaultConfig,
	...{	
	entry: WebpackWatchedGlobEntries.getEntries(
		[ 
			path.resolve(__dirname, 'src/scss/**/*.scss'),
		],
		{
		  ignore: '**/_*.scss' // Ignores SASS partials starting with underscore
		}
	),
    	module: {
			rules: [
				{
					test: /\.(sa|sc|c)ss$/,
					use: [
						{ loader: MiniCssExtractPlugin.loader },
						{ loader: 'css-loader',
							options: {
          						url: false, // Prevents Webpack from trying to process url() paths
							},
						},
						{
							loader: "postcss-loader",						
							options: {
								postcssOptions: {
									plugins: [ autoprefixer() ]
								}
							}
						},
						{ loader: 'sass-loader' },
					],
				},
			],
		},
		plugins: [
			...defaultConfig.plugins,
			
			// Removes the empty .js files Webpack generates when only compiling CSS
			new RemoveEmptyScriptsPlugin( {
				stage: RemoveEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS,
			} ),
			
			// Cleans up the assets directory, keeping only your main engine asset file
			new RemoveFilesPlugin({
				after: {
					test: [
						{
							folder: './assets/css',
							method: (absoluteItemPath) => {
								return new RegExp(/\.asset.php$/, 'm').test(absoluteItemPath);
							},
							recursive: true
						}
					],
					exclude: ['./assets/css/atmos-engine.asset.php'] 
				}
	        })
		],
		mode: 'development',
		devtool: false,
	},
};