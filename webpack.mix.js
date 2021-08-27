const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    // .postCss('resources/css/app.css', 'public/css', [
    //     //
    // ])
    .purgeCss()

    // .extract(['vue', 'jquery'])
    .webpackConfig({
        output: { chunkFilename: 'js/[name].[contenthash].js' },
        resolve: {
            alias: {
                vue$: 'vue/dist/vue.runtime.js',
                '@': path.resolve('resouces/js'),
            }
        }
    });

// const mix = require('laravel-mix');
// require('laravel-mix-svelte');

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .svelte({
//         dev: !mix.inProduction()
//     })
//     .webpackConfig({
//         output: { chunkFilename: 'js/[name]. js? id = [chunkhash]' },
//     })
//     .version();
