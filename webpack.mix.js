const mix = require('laravel-mix');
mix.options({
  postCss: [
    require('autoprefixer')
  ],
  processCssUrls: false
});
mix.sass('resources/sass/style.scss', 'public/css').sass('resources/sass/print.scss', 'public/css');
mix.browserSync('localhost/ukfashionshop');