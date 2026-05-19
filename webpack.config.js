// webpack.config.js (Atmos Child Theme - Locked Assets Pass)
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

// Plugins
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );
const autoprefixer = require('autoprefixer');

// Utilities
const path = require( 'path' );

module.exports = {
	...defaultConfig,
	entry: {
		'atmos-engine': path.resolve(__dirname, 'src/scss/atmos-engine.scss'),
		'atmos-interactions': path.resolve(__dirname, 'src/scss/atmos-interactions.scss'),
	},
	output: {
		...defaultConfig.output,
		path: path.resolve(__dirname, 'assets/css'),
		filename: '[name].js',
		clean: true, // Dynamically scrubs out any stale artifacts on startup
	},
	module: {
		rules: [
			{
				test: /\.(sa|sc|c)ss$/,
				use: [
					{ loader: MiniCssExtractPlugin.loader },
					{ 
						loader: 'css-loader',
						options: { url: false } // Stops Webpack from breaking internal url() paths
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
		// The Enforcer: Catches the empty .js files and deletes them mid-extraction
		new RemoveEmptyScriptsPlugin({
			stage: RemoveEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS
		}),
		new MiniCssExtractPlugin({
			filename: '[name].css',
		}),
	],
	mode: 'development',
	devtool: false,
};