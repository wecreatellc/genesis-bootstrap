var gulp = require('gulp');
var notify = require("gulp-notify");
var plumber = require('gulp-plumber');
var concat = require('gulp-concat');
var less = require('gulp-less');
var header = require('gulp-header');
var bust = require('gulp-buster');
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

    .pipe( bust() )                                  // pipe generated files into gulp-buster
    .pipe( gulp.dest('./cache') )  // output busters.json to theme css folder

    .pipe( notify('LESS Compiled') );
});


/**
 * Watchers
 */

gulp.task('watch', function() {

  gulp.watch( filesToWatch , ['default']);
});