var gulp = require('gulp');
var notify = require("gulp-notify");
var plumber = require('gulp-plumber');
var concat = require('gulp-concat');
var less = require('gulp-less');
var header = require('gulp-header');
//var path = require('path');

var filesToWatch = [
  './less/*.less',
  './less/*/*.less'
];

gulp.task('default', function() {

  gulp.run('compile-less');
});

gulp.task('compile-less', function() {

  var filesToCompile = [
    './less/site.less'
  ];

  var compiledStyleHeader =
      '/**' + "\n" +
      ' * This stylesheet is compiled from LESS files (../less/*.less). DO NOT' + "\n" +
      ' * edit this file directly. Instead edit the source LESS files and run ' + "\n" +
      ' * the accompanying GULP build process.' + "\n" +
      ' */' + "\n\n";

  gulp.src( filesToCompile )

    .pipe( plumber({ errorHandler: notify.onError("Error: <%= error.message %>") }) )

    .pipe( less({
      relativeUrls: true
    }) )

    .pipe( concat( 'style.compiled.css' ) )

    .pipe( header( compiledStyleHeader ) )

    .pipe( gulp.dest('./css') )

    .pipe( notify('LTBP Build Completed') );
});


/**
 * Watchers
 */

gulp.task('watch', function() {

  gulp.watch( filesToWatch , ['default']);
});