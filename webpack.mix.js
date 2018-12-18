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
mix.scripts([
  'resources/loginv1/vendor/jquery/jquery-3.2.1.min.js',
  'resources/loginv1/vendor/bootstrap/js/popper.js',
  'resources/loginv1/vendor/bootstrap/js/bootstrap.js',
  'resources/loginv1/vendor/tilt/tilt.jquery.min.js',
  'resources/loginv1/js/main.js'
], 'public/js/loginv1.js' );

mix.copyDirectory('resources/loginv1/images', 'public/images');
mix.copyDirectory('resources/loginv1/fonts', 'public/fonts');
mix.styles([
  'resources/loginv1/vendor/bootstrap/css/bootstrap.css',
  'resources/loginv1/vendor/css-hamburgers/hamburgers.min.css',
  'resources/loginv1/css/util.css',
  'resources/loginv1/css/main.css',
], 'public/css/loginv1.css')

// Login
// mix.scripts([
//   'resources/login/vendor/jquery/jquery-3.2.1.min.js',
//   'resources/login/vendor/bootstrap/js/popper.js',
//   'resources/login/vendor/bootstrap/js/bootstrap.js',
//   'resources/login/js/main.js'
// ], 'public/js/login.js' );
//
// mix.styles([
//   'resources/login/vendor/bootstrap/css/bootstrap.css',
//   'resources/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css',
//   'resources/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css',
//   'resources/login/vendor/animate/animate.css',
//   'resources/login/vendor/animsition/css/animsition.min.css',
//   'resources/login/vendor/select2/select2.min.css',
//   'resources/login/vendor/daterangepicker/daterangepicker.css',
//   'resources/login/css/util.css',
//   'resources/login/css/main.css',
// ], 'public/css/login.css')

// mix.copyDirectory('resources/login/images', 'public/images');
// mix.copyDirectory('resources/login/fonts', 'public/fonts');
