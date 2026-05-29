const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' ); // Explicitly require this
const glob = require( 'glob' );
const path = require( 'path' );

// 1. DYNAMIC ENTRY
const entryFiles = glob.sync('./src/scss/*.scss').reduce((acc, filePath) => {
    const name = path.basename(filePath, '.scss');
    acc[name] = filePath;
    return acc;
}, {});

module.exports = {
    ...defaultConfig,
    entry: entryFiles,
    output: {
        ...defaultConfig.output,
        path: path.resolve(__dirname, 'assets/css'),
        clean: true,
    },
    plugins: [
        ...defaultConfig.plugins,
        // 2. FORCE ASSET GENERATION: Explicitly add the plugin back in
        new DependencyExtractionWebpackPlugin(), 
        new RemoveEmptyScriptsPlugin({
            stage: RemoveEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS
        }),
    ],
};