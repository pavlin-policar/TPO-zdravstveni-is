var elixir = require('laravel-elixir');

var gulp = require('gulp');
var notify = require('gulp-notify');
var phpspec = require('gulp-phpspec');
var shell = require('gulp-shell');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/**
 * Run phpspec once, notify on error.
 */
gulp.task('phpspec', function() {
    gulp.src('spec/**/**.php')
        .pipe(shell('clear'))
        .pipe(phpspec('', { debug: true }))
        .on('error', notify.onError({
            title: 'Phpspec tests failed!',
            message: 'Tests failed while running tests'
        }));
});

/**
 * Run phpspec on any change to the selected folders. Please don't put ALL here, since it run slowly
 * due to the amount of files in the "vendor/" and "node_modules/" directories.
 */
gulp.task('phpspec-watch', function() {
    gulp.watch([
        'spec/**/*.php',
        'app/**/*.php',
        'config/**/*.php'
    ], ['phpspec']);
});

gulp.task('spec', ['phpspec', 'phpspec-watch']);


