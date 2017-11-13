// require gulp plugins
const gulp = require('gulp'),
      sass = require('gulp-sass'),
      csso = require('gulp-csso');
      sourceMap = require('gulp-sourcemaps'),      
      concat = require('gulp-concat'),
      uglify = require('gulp-uglify'),
      imagemin = require('gulp-imagemin');

// set path
const path = {
  css: {
    src: 'src/sass/*.css',
    dist: 'assets/css'
  },
  sass: {
    src: ['src/sass/*.css', 'src/sass/*.sass'],
    dist: 'assets/css'
  },
  ts: {
    src: ['src/ts/*.js', 'src/ts/*.ts'],
    dist: 'assets/js'
  },
  img: {
    src: ['src/assets/img/*.png', 'src/assets/img/*.jpg', 'src/assets/img/*.jpeg'],
    dist: 'assets/img'
  }
}

// gulp task for sass
gulp.task('css', function () {
  return gulp.src(path.sass.src)
    .pipe(sourceMap.init())
    .pipe(sass())
    .pipe(csso())
    .pipe(sourceMap.write())
    .pipe(gulp.dest(path.sass.dist));
});

// gulp task for sass
gulp.task('sass', function () {
  return gulp.src(path.sass.src)
    .pipe(sourceMap.init())
    .pipe(sass())
    .pipe(csso())
    .pipe(sourceMap.write())
    .pipe(gulp.dest(path.sass.dist));
});



// gulp task for ts
gulp.task('ts', function () {
  return gulp.src(path.ts.src)
    .pipe(sourceMap.init())
    .pipe(concat('index.js'))
    .pipe(uglify())
    .pipe(sourceMap.write())
    .pipe(gulp.dest(path.ts.dist));
});

// gulp task for img
gulp.task('img', function () {
  return gulp.src(path.img.src)
    .pipe(imagemin({
      progressive: true,
      interlaced: true
    }))
    .pipe(gulp.dest(path.img.dist));
});

// gulp task watch changes
gulp.task('watch', ['sass', 'ts'], function () {  
  gulp.watch(path.ts.src, ['ts']);
  gulp.watch(path.sass.src, ['sass']);
});

// gulp task for build
gulp.task("build", ["sass", "ts", "img"]);