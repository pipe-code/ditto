const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const path = require('path');

module.exports = {
    entry: ['./js/main.js'],
    mode: 'development',
    output: {
        path: path.resolve(__dirname, 'js'),
        filename: 'main.bundle.js',
        publicPath: 'auto'
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/main.bundle.css'
        }),
    ],
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ],
            },
            {
                test: /\.(jpe?g|png|gif|woff|woff2|eot|ttf|svg)$/i,
                type: "asset"
            }
        ]
    }
}