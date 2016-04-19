'use strict';

var gulp = require('gulp'),
    notify = require('gulp-notify'),
    browserify  = require('browserify'),
    uglify  = require('gulp-uglify'),
    babelify = require('babelify'),
    source = require('vinyl-source-stream'),
    buffer = require('vinyl-buffer'),
    envify = require('loose-envify/custom');


gulp.task('js', function() {
    return browserify('./static/app/src/js/app.js', {debug: process.env.NODE_ENV != 'production'})
        .transform(babelify, {plugins: ["transform-react-jsx"], presets: ['es2015']})
        .transform(envify({
          NODE_ENV: process.env.NODE_ENV
        }))
        .bundle()
        .on('error', onError)
        .pipe(source('bundle.js'))
        .pipe(buffer())
        .pipe(uglify())
        .pipe(gulp.dest('static/app/build/'));
});

gulp.task('default', ['js'], function() {
  process.env.NODE_ENV = 'production';
  gulp.watch(['./static/app/src/js/**/*.*'], ['js']);
});

var onError = function(err) {
    console.log(err);
    notify
        .onError({
            title:    "Gulp",
            subtitle: "Failure!",
            message:  "Error: <%= error.stack %>",
            sound:    "Beep"
        })(err);

    this.emit('end');
};