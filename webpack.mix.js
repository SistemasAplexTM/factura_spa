const mix = require('laravel-mix');

mix.webpackConfig({
  resolve: {
    alias: {
      "@" : path.resolve(__dirname, 'resources/js')
    }
  }
})

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');


// Login V1
// mix.scripts([
//   'resources/loginv1/vendor/jquery/jquery-3.2.1.min.js',
//   'resources/loginv1/vendor/bootstrap/js/popper.js',
//   'resources/loginv1/vendor/bootstrap/js/bootstrap.js',
//   'resources/loginv1/vendor/tilt/tilt.jquery.min.js',
//   'resources/loginv1/js/main.js'
// ], 'public/js/loginv1.js' );
//
// // mix.copyDirectory('resources/loginv1/images', 'public/images');
// // mix.copyDirectory('resources/loginv1/fonts', 'public/fonts');
// mix.styles([
//   'resources/loginv1/vendor/bootstrap/css/bootstrap.css',
//   'resources/loginv1/vendor/css-hamburgers/hamburgers.min.css',
//   'resources/loginv1/css/util.css',
//   'resources/loginv1/css/main.css',
// ], 'public/css/loginv1.css')
