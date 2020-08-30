const mix = require('laravel-mix');
const LiveReloadPlugin = require('webpack-livereload-plugin');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// ? chunks settings
// mix.webpackConfig({
//    output: {
//       publicPath: '/public/',
//       chunkFilename: 'js/[name].[contenthash].js',
//    }
// });

mix.webpackConfig({
  plugins: [
    new LiveReloadPlugin()
  ],
  module: {
    rules: [
      {
        test: /\.pug$/,
        oneOf: [
          {
            resourceQuery: /^\?vue/,
            use: ['pug-plain-loader']
          },
          {
            use: ['raw-loader', 'pug-plain-loader']
          }
        ]
      }
    ]
  }
});

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css');
