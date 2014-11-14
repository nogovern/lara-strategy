var gulp = require('gulp'),  
    less = require('gulp-less'), // compiles less to CSS
    sass = require('gulp-sass'), // compiles sass to CSS
    minify = require('gulp-minify-css'), // minifies CSS
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'), // minifies JS
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    phpunit = require('gulp-phpunit');

var paths = {  
    'dev': {
        'less': './resources/assets/less/',
        'js': './resources/assets/js/',
        'vendor': './resources/assets/vendor/'
    },
    'production': {
        'css': './public/assets/css/',
        'js': './public/assets/js/'
    }
};

// CSS
gulp.task('css', function() {  
  return gulp.src(paths.dev.less+'app.less')
    .pipe(less())
    .pipe(gulp.dest(paths.production.css))
    .pipe(minify({keepSpecialComments:0}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.production.css));
});

// JS
gulp.task('js', function(){  
  return gulp.src([
      paths.dev.vendor+'jquery/dist/jquery.js',
      paths.dev.vendor+'jquery/dist/jquery-validate.js',
      paths.dev.vendor+'bootstrap/dist/js/bootstrap.js',
      paths.dev.js+'js'
    ])
    .pipe(concat('app.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(paths.production.js));
});

// PHP Unit
gulp.task('phpunit', function() {  
  var options = {debug: false, notify: true};
  return gulp.src('./tests/*.php')
    .pipe(phpunit('./vendor/bin/phpunit', options))

    .on('error', notify.onError({
      title: 'PHPUnit Failed',
      message: 'One or more tests failed.'
    }))

    .pipe(notify({
      title: 'PHPUnit Passed',
      message: 'All tests passed!'
    }));
});

// watch
gulp.task('watch', function() {  
  gulp.watch(paths.dev.less + '/*.less', ['css']);
  gulp.watch(paths.dev.js + '/*.js', ['js']);
  gulp.watch('./tests/*.php', ['phpunit']);
});

gulp.task('default', ['css', 'js', 'phpunit', 'watch']);
