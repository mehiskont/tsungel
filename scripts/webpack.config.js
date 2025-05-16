'use strict'

const webpack = require('webpack')
const autoprefixer = require('autoprefixer')
const AssetsPlugin = require('assets-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const FriendlyErrorsPlugin = require('friendly-errors-webpack-plugin')
const TerserPlugin = require('terser-webpack-plugin')
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin')
const path = require('path')
const fs = require('fs')
require('idempotent-babel-polyfill')

// Make sure any symlinks in the project folder are resolved:
// https://github.com/facebookincubator/create-react-app/issues/637
const appDirectory = fs.realpathSync(process.cwd())

function resolveApp (relativePath) {
  return path.resolve(appDirectory, relativePath)
}

const paths = {
  appSrc: resolveApp('scripts/src'),
  appBuild: resolveApp('build'),
  appIndexJs: resolveApp('scripts/src/index.js'),
  appNodeModules: resolveApp('node_modules')
}

const DEV = process.env.NODE_ENV === 'development'

module.exports = {
  mode: process.env.NODE_ENV,
  bail: !DEV,
  // We generate sourcemaps in production. This is slow but gives good results.
  // You can exclude the *.map files from the build during deployment.
  target: 'web',
  // devtool: DEV ? 'cheap-eval-source-map' : 'source-map',
  entry: [
    "idempotent-babel-polyfill",
    paths.appIndexJs
  ],
  performance: {
    hints: false,
    maxEntrypointSize: 400000,
    maxAssetSize: 100000
  },
  output: {
    path: paths.appBuild,
    publicPath: '/wp-content/themes/tsungel/build/', // CHANGE THIS TO YOUR THEME NAME
    filename: DEV ? 'bundle.js' : 'bundle.js?ver=[hash:8]'
  },
  module: {
    
    rules: [
      // Disable require.ensure as it's not a standard language feature.
      { parser: { requireEnsure: false } },
      {
        enforce: 'pre',
        test: /\.js$/,
        include: paths.appSrc,
        exclude: /(node_modules|bower_components)/,
        loader: 'eslint-loader',
        options: {
          fix: true
        }
      },
      // Transform ES6 with Babel
      {
        test: /\.js?$/,
        exclude: /(node_modules|bower_components)/,
        loader: 'babel-loader',
        include: paths.appSrc
      },
      {
        test: /\.(c|sa|sc)ss$/,
        use: [
          'style-loader',
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss', // https://webpack.js.org/guides/migrating/#complex-options
              plugins: () => [
                autoprefixer()
              ]
            }
          },
          {
            loader: 'sass-loader',
            options: {
              implementation: require('sass')
            }
          }
        ]
      },
      {
        test: /\.(gif|png|jpe?g|svg)$/i,
        use: [
          'file-loader',
          {
            loader: 'image-webpack-loader',
            query: {
                name: '[name].[ext]'
            }
          }
        ]
      },
      {
        test: /\.(woff(2)?|ttf|eot|otf)(\?v=\d+\.\d+\.\d+)?$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]'
              // outputPath: "fonts/"
            }
          }
        ]
      },
      // {
      //   // Exposes jQuery for use outside Webpack build
      //   test: require.resolve('jquery'),
      //   use: [{
      //     loader: 'expose-loader',
      //     options: 'jQuery'
      //   }, {
      //     loader: 'expose-loader',
      //     options: '$'
      //   }]
      // }
    ]
  },
  externals: {
    jquery: 'jQuery'
  },
  plugins: [
    !DEV && new CleanWebpackPlugin([paths.appBuild], { root: process.cwd() }),
    new MiniCssExtractPlugin({
      filename: DEV ? 'bundle.css' : 'bundle.css?ver=[hash:8]'
    }),
    new webpack.EnvironmentPlugin({
      NODE_ENV: 'development', // use 'development' unless process.env.NODE_ENV is defined
      DEBUG: true
    }),
    new AssetsPlugin({
      path: paths.appBuild,
      filename: 'assets.json'
    }),
    DEV &&
      new FriendlyErrorsPlugin({
        clearConsole: false
      }),
    DEV &&
      new BrowserSyncPlugin({
        notify: false,
        host: 'tsungel.test',
        port: 2666,
        open: true,
        logLevel: 'silent',
        files: ['**/*.php'],
        proxy: 'http://tsungel.test/'
      }),
    // Provides jQuery for other JS bundled with Webpack
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery'
    })
  ].filter(Boolean),
  optimization: {
    splitChunks: {
      chunks: 'async',
      minSize: 30000,
      maxSize: 0,
      minChunks: 1,
      maxAsyncRequests: 5,
      maxInitialRequests: 3,
      automaticNameDelimiter: '~',
      name: true,
      cacheGroups: {
        vendors: {
          test: /[\\/]node_modules[\\/]/,
          priority: -10
        },
        default: {
          minChunks: 2,
          priority: -20,
          reuseExistingChunk: true
        }
      }
    },
    minimizer: [
      new TerserPlugin({
        parallel: true,
        terserOptions: {
          ecma: 6,
          extractComments: 'all',
          compress: {
            drop_console: true,
          },
        },
      }),
      new OptimizeCSSAssetsPlugin({}),
    ]
  }
}
