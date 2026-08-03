/**
 * File: webpack.config.js
 */

const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );
const glob = require( 'glob' );
const path = require( 'path' );

// 1. Root main SCSS entries (Ignores root partials starting with '_')
const rootEntries = glob.sync( './src/scss/[^_]*.scss' ).reduce( ( acc, filePath ) => {
    const name = path.basename( filePath, '.scss' );
    acc[ name ] = filePath;
    return acc;
}, {} );

const fs = require( 'fs' );

// 2. Dynamic per-block entries (src/scss/blocks/**/*.scss -> assets/css/blocks/*.css)
const blockFiles = glob.sync( './src/scss/blocks/**/*.scss' );
const blockEntries = blockFiles.reduce( ( acc, filePath ) => {
    // 1. Skip backup/draft files
    if ( filePath.includes( '-SAVE-' ) || filePath.includes( '.bak' ) ) {
        return acc;
    }

    // 2. Skip deleted files
    if ( ! fs.existsSync( filePath ) ) {
        return acc;
    }

    const posixPath = filePath.replace( /\\/g, '/' );
    // Strip prefix updated to './src/scss/blocks/'
    const relativePath = posixPath.replace( './src/scss/blocks/', '' );
    const parts = relativePath.split( '/' );

    let blockName;
    if ( parts.length === 1 ) {
        // Standalone file in /blocks/ (e.g. '_button.scss' or 'columns_02-lumina.scss')
        blockName = path.basename( parts[0], '.scss' ).replace( /^_/, '' );
    } else {
        // Subfolder partial (e.g. 'columns/_01-core.scss')
        blockName = parts[0];
    }

    const key = `blocks/${ blockName }`;

    if ( ! acc[ key ] ) {
        acc[ key ] = [];
    }
    acc[ key ].push( filePath );
    return acc;
}, {} );

// 3. Combine Entry Points
const entryFiles = {
    ...rootEntries,
    ...blockEntries,
};

module.exports = {
    ...defaultConfig,
    entry: entryFiles,
    output: {
        ...defaultConfig.output,
        path: path.resolve( __dirname, 'assets/css' ),
        clean: true,
    },
    module: {
        ...defaultConfig.module,
        rules: [
            {
                test: /\.scss$/,
                enforce: 'pre',
                use: [
                    {
                        loader: path.resolve( __dirname, 'scss-use-loader.js' ),
                    },
                ],
            },
            ...defaultConfig.module.rules,
        ],
    },
    plugins: [
        ...defaultConfig.plugins,
        new DependencyExtractionWebpackPlugin(),
        new RemoveEmptyScriptsPlugin( {
            stage: RemoveEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS,
        } ),
    ],
};