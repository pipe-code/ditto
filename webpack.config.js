const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: './js/main.js',
    output: {
        path: __dirname + '/js',
        filename: 'main.bundle.js'
    },

    module: {
        rules: [
            {
                test: /\.scss$/,
                loader: [
                    {loader: MiniCssExtractPlugin.loader},
                    {loader: 'css-loader'},
                    {loader: 'sass-loader'}
                ]
            },
            {
                test: /\.(jpe?g|png|gif|woff|woff2|eot|ttf|svg)(\?[a-z0-9=.]+)?$/,
                loader: 'url-loader?limit=100000'
            }
        ]
    },

    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/main.bundle.css'
        })
    ]
}