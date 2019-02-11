import gulp from 'gulp';
import sass from 'gulp-sass';
import babel from 'gulp-babel';
import concat from 'gulp-concat';
import uglify from 'gulp-uglify';
import rename from 'gulp-rename';
import cleanCSS from 'gulp-clean-css';
import merge from 'merge2';
import request from 'request';
import buffer from 'gulp-buffer';
import favicons from 'gulp-favicons';

import del from 'del';

var env = require('gulp-env');

env({
  file: '.env',
  type: 'ini',
});

const paths = {
  styles: {
    main :{
        src: 'theme/css/main.scss',
        dest: 'web/dist/'
    },
    select2 : {
        src: 'theme/css/select2.scss',
        dest: 'widgets/select2/assets/css/'
    },
  },
  scripts: {
    main:{
      src: [
        'node_modules/jquery/dist/jquery.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'node_modules/infinite-scroll/dist/infinite-scroll.pkgd.js',
        'node_modules/spectrum-colorpicker/spectrum.js',
        'theme/src/*.js'
      ],
      dest: 'web/dist/'
    },
    select2:{
      src: 'node_modules/select2/dist/js/**/*',
      dest: 'widgets/select2/assets/js/'
    }

  },
  watchCSS: {
    src: 'theme/css/*.scss'
  }

};

/*
 * For small tasks you can export arrow functions
 */
export const clean = () => del([ 'dist' ]);

/*
 * You can also declare named functions and export them as tasks
 */
export function cssmain() {
  return gulp.src(paths.styles.main.src)
    .pipe(sass())
    .pipe(cleanCSS())
    .pipe(concat('main.min.css'))
    // pass in options to the stream
    .pipe(rename({
      basename: 'main',
      suffix: '.min'
    }))
    .pipe(gulp.dest(paths.styles.main.dest));
}

export function cssselect2() {
  return gulp.src(paths.styles.select2.src)
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(concat('main.min.css'))
    // pass in options to the stream
    .pipe(rename({
      basename: 'select2',
      suffix: '.min'
    }))
    .pipe(gulp.dest(paths.styles.select2.dest))
    .pipe(sass({outputStyle: 'expanded'}))
    .pipe(rename({
      basename: 'select2',
      suffix: ''
    }))
    .pipe(gulp.dest(paths.styles.select2.dest))
    ;
}

export function scripts() {

  return gulp.src(paths.scripts.main.src, { sourcemaps: true })
  .pipe(buffer())
  .pipe(concat('main.min.js'))
  .pipe(uglify())
  .pipe(gulp.dest(paths.scripts.main.dest));


}

export function cloneSelect2js() {

  return gulp.src(paths.scripts.select2.src).pipe(gulp.dest(paths.scripts.select2.dest));

}

export function select2js() {

  return gulp.src(paths.scripts.src, { sourcemaps: true })
  .pipe(buffer())
  .pipe(concat('main.min.js'))
  .pipe(uglify())
  .pipe(gulp.dest(paths.scripts.dest));

}


 /*
  * You could even use `export as` to rename exported tasks
  */
export function watch() {
  gulp.watch(paths.scripts.main.src, scripts);
  gulp.watch(paths.watchCSS.src, cssmain );
}


// Generate favicons
export function genFavicon() {
  return gulp.src("theme/img/logotipo.*")
    .pipe(favicons({
        appName: process.env.app_name,
        appShortName: process.env.app_name,
        appDescription: process.env.app_description,
        developerName: "Protocolli Creativi",
        developerURL: "https://protocollicreativi.it",
        background: "#2a2b34",
        path: "img/",
        url: process.env.favicon_url,
        display: "standalone",
        orientation: "portrait",
        scope: "/",
        start_url: process.env.favicon_starturl,
        version: 1.0,
        logging: false,
        html: "theme/favicon.html",
        pipeHTML: true,
        replace: true
  }))
  .pipe(gulp.dest("web/img/"));
}

export function moveHtmlFavicon() {
  return gulp.src("web/img/theme/favicon.html")
    .pipe(gulp.dest("views/layouts/"));
}

export function cleanHtmlFavicon() {
  return del([ "web/img/theme/" ]);
}

export function moveLogo() {
  return gulp.src("theme/img/*")
    .pipe(gulp.dest("web/img/"));
}



const build = gulp.series(clean, gulp.parallel(cssmain, cssselect2, scripts, cloneSelect2js, genFavicon, moveLogo), moveHtmlFavicon, cleanHtmlFavicon);
/*
 * Export a default task
 */
export default build;
