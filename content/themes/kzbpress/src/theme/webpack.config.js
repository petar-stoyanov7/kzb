const CopyPlugin = require('copy-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCSSExtractPlugin = require('mini-css-extract-plugin');

const path = require('path');
const isProduction = process.env.NODE_ENV === 'production';
const mode = isProduction ? 'production' : 'development';
const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const config = require('../config.json');
const postcssPlugins = require('@wordpress/postcss-plugins-preset');

const {
	hasCssnanoConfig,
	hasPostCSSConfig,
} = require('@wordpress/scripts/utils');

const cssLoaders = [
	{
		loader: MiniCSSExtractPlugin.loader,
	},
	{
		loader: require.resolve('css-loader'),
		options: {
			sourceMap: !isProduction,
			modules: {
				auto: true,
			},
		},
	},
	{
		loader: require.resolve('postcss-loader'),
		options: {
			// Provide a fallback configuration if there's not
			// one explicitly available in the project.
			...(!hasPostCSSConfig() && {
				postcssOptions: {
					ident: 'postcss',
					sourceMap: !isProduction,
					plugins: isProduction
						? [
							...postcssPlugins,
							require('cssnano')({
								// Provide a fallback configuration if there's not
								// one explicitly available in the project.
								...(!hasCssnanoConfig() && {
									preset: [
										'default',
										{
											discardComments: {
												removeAll: true,
											},
										},
									],
								}),
							}),
						]
						: postcssPlugins,
				},
			}),
		},
	},
];
module.exports = {
	...defaultConfig,
	entry: {
		...defaultConfig.entry,
		'js/app': `${__dirname}/js/app.js`,
		'js/admin': `${__dirname}/js/admin.js`,
		'css/style': `${__dirname}/scss/app.scss`,
		'css/editor': `${__dirname}/scss/editor.scss`,
	},
	output: {
		path: path.resolve(__dirname, '../../dist'),
		clean: true,
	},
	module: {
		rules: [
			{
				test: /\.(sc|sa)ss$/,
				use: [
					...cssLoaders,
					{
						loader: require.resolve('sass-loader'),
						options: {
							sourceMap: !isProduction,
							implementation: require('node-sass'),
						},
					},
				],
			},
		],
	},
	devServer: {
		...defaultConfig.devServer,
	},
	plugins: [
		...defaultConfig.plugins,
		new CopyPlugin({
			patterns: [
				{
					from: `${__dirname}/images/`,
					to: 'images/',
					noErrorOnMissing: true,
					globOptions: { dot: false },
				},
				{
					from: `${__dirname}/fonts/`,
					to: 'fonts/',
					noErrorOnMissing: true,
					globOptions: { dot: false },
				},
			],
		}),
		new BrowserSyncPlugin(
			{
				files: [
					`${__dirname}/../../*.php`,
					`${__dirname}/../../**/*.php`,
					`${__dirname}/js/*.js`,
					`${__dirname}/scss/*.scss`,
				],
				// logLevel: 'debug',
				// host: config.settings.browserSync.host,
				port: config.settings.browserSync.port,
				proxy: config.settings.browserSync.proxy,
				notify: true,
			},
			{
				injectChanges: true,
				reload: true,
			}
		),
		new CleanWebpackPlugin({
			protectWebpackAssets: false,
			cleanAfterEveryBuildPatterns: [
				'*.css',
				'*.map',
				'*.js',
				'css/*.js',
				'css/*.js.map',
			],
		}),
	],
};
