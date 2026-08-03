/**
 * File: scss-use-loader.js
 * Description: Pre-loader to expand wildcard globbing for Sass @use statements.
 *              Ignores commented-out @use statements.
 */
const glob = require( 'glob' );
const path = require( 'path' );

module.exports = function ( source ) {
    const resourceDir = path.dirname( this.resourcePath );

    // Matches un-commented @use "path/to/*" [as *];
    return source.replace(
        /^(?!\s*\/\/)\s*@use\s+["']([^"']*\*[^"']*)["'](?:\s+as\s+([^;]+))?\s*;/gm,
        ( match, importPath, asClause ) => {
            const absPattern = path.resolve( resourceDir, importPath );
            let searchPattern = path
                .relative( process.cwd(), absPattern )
                .replace( /\\/g, '/' );

            if ( ! searchPattern.endsWith( '.scss' ) && ! searchPattern.endsWith( '/*' ) ) {
                searchPattern += '.scss';
            }

            const files = glob.sync( searchPattern );

            if ( ! files || files.length === 0 ) {
                return match;
            }

            // Watch folder for runtime file additions
            const folderPath = path.dirname( absPattern );
            this.addContextDependency( folderPath );

            return files
                .map( ( filePath ) => {
                    const absFilePath = path.resolve( process.cwd(), filePath );
                    this.addDependency( absFilePath );

                    let relPath = path
                        .relative( resourceDir, absFilePath )
                        .replace( /\\/g, '/' );

                    if ( ! relPath.startsWith( '.' ) ) {
                        relPath = './' + relPath;
                    }

                    const asString = asClause ? ` as ${ asClause.trim() }` : '';
                    return `@use "${ relPath }"${ asString };`;
                } )
                .join( '\n' );
        }
    );
};