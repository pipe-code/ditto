const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: './js/main.js',
    output: {
        path: __dirname + '/js',
        filename: 'main.min.js'
    },

    module: {
        rules: [{
            test: /\.scss$/,
            loader: [
                {loader: MiniCssExtractPlugin.loader},
                {loader: 'css-loader'},
                {loader: 'sass-loader'}
            ]
        }]
    },

    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/main.css'
        })
    ],

    watch: true
}