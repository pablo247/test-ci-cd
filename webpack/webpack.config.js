require('dotenv').config();
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const CSS_DIST_FILE = process.env.CSS_DIST_FILENAME;
const CSS_DIST_FOLDER = process.env.CSS_DIST_FOLDER;
const JS_DIST_FILE = process.env.JS_DIST_FILENAME;
const JS_DIST_FOLDER = process.env.JS_DIST_FOLDER;

module.exports = {
  entry: './index.js',
  output: {
    filename: JS_DIST_FILE,
    path: path.resolve(__dirname, JS_DIST_FOLDER),
  },
  mode: 'production',
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader
          },
          'css-loader',
          'sass-loader'
        ]
      }
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: CSS_DIST_FOLDER+CSS_DIST_FILE
    })
  ]
}
