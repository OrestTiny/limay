const gulp = require("gulp"),
  strip = require("gulp-strip-comments"),
  babel = require("gulp-babel"),
  sass = require("gulp-sass")(require("sass")),
  autoprefixer = require("autoprefixer"),
  size = require("gulp-size"),
  notify = require("gulp-notify"),
  uglify = require("gulp-uglify"), // minify file
  rename = require("gulp-rename"),
  cleanCSS = require("gulp-clean-css"), // remove all comments
  plumber = require("gulp-plumber"), // intercepts errors
  postCSS = require("gulp-postcss"),
  mqpacker = require("css-mqpacker"),
  sortCSSmq = require("sort-css-media-queries"),
  debug = require("gulp-debug");

const domain = 'limay';

const path = {
  scss: {
    src: [
      `./themes/${domain}/assets/scss/*.scss`,
      `!./themes/${domain}/assets/scss/gutenberg.scss`,
    ],
    dest: `./themes/${domain}/assets/css`,
  },
  scss_gutenberg: {
    src: [`./themes/${domain}/assets/scss/gutenberg.scss`],
    dest: `./themes/${domain}/assets/css`,
  },
  scss_inner: {
    src: [`./themes/${domain}/assets/scss/**/*.scss`, `!./${domain}/assets/scss/*.scss`],
    dest: `./themes/${domain}/assets/css`,
  },
  scss_widgets: {
    src: [`./themes/${domain}/widgets/**/*.scss`],
    dest: `./themes/${domain}/widgets/`,
  },
  js_widgets: {
    src: [`./themes/${domain}/widgets/**/*.js`, `!./themes/${domain}/widgets/**/*.min.js`],
    dest: `./themes/${domain}/widgets/`,
  },
  js: {
    src: [
      `./themes/${domain}/assets/js/**/*.js`,
      `!./themes/${domain}/assets/js/**/*.min.js`,
      `!./themes/${domain}/assets/js/lib{,/**}/*.js`,
    ],
    dest: "./themes/limay/assets/js",
  },
};

const options = {
  mqpacker: { sort: sortCSSmq.desktopFirst },
  size: { title: "Size" },
  rename: { suffix: ".min" },
  cleanCss: {
    level: { 2: { specialComments: 0, restructureRules: true } },
    compatibility: "ie8",
  },
  autoprefixer: ["last 2 version", "> 2%", "ie 6"],
  debug: { title: "Focus:" },
  babel: { presets: ["@babel/env"] },
  sass: { outputStyle: "compressed", includePaths: ["node_modules"] },
  onError: function (err) {
    this.emit("end");
    return notify().write(err);
  },
};

gulp.task("scripts", function () {
  return gulp
    .src(path.js.src)
    .pipe(debug(options.debug))
    .pipe(babel(options.babel))
    .pipe(uglify())
    .pipe(rename(options.rename))
    .pipe(strip())
    .pipe(gulp.dest(path.js.dest))
    .pipe(size(options.size));
});

gulp.task('js_widgets', function () {
  return gulp
    .src(path.js_widgets.src)
    .pipe(debug(options.debug))
    .pipe(babel(options.babel))
    .pipe(uglify())
    .pipe(strip())
    .pipe(rename(options.rename))
    .pipe(gulp.dest(path.js_widgets.dest))
    .pipe(size(options.size));
});

gulp.task("scss", function () {
  return gulp
    .src(path.scss.src)
    .pipe(debug(options.debug))
    .pipe(sass(options.sass).on("error", options.onError))
    .pipe(cleanCSS(options.cleanCss))
    .pipe(
      postCSS([autoprefixer(options.autoprefixer), mqpacker(options.mqpacker)])
    )
    .pipe(rename({ ...options.rename, dirname: "" }))
    .pipe(gulp.dest(path.scss.dest))
    .pipe(size(options.size));
});

gulp.task("scss_inner", function () {
  return gulp
    .src(path.scss_inner.src)
    .pipe(debug(options.debug))
    .pipe(sass(options.sass).on("error", options.onError))
    .pipe(cleanCSS(options.cleanCss))
    .pipe(
      postCSS([autoprefixer(options.autoprefixer), mqpacker(options.mqpacker)])
    )
    .pipe(rename({ ...options.rename, dirname: "" }))
    .pipe(gulp.dest(path.scss_inner.dest))
    .pipe(size(options.size));
});

gulp.task('scss_widgets', function () {
  return gulp
    .src(path.scss_widgets.src)
    .pipe(debug(options.debug))
    .pipe(sass(options.sass).on('error', options.onError))
    .pipe(cleanCSS(options.cleanCss))
    .pipe(postCSS([autoprefixer(options.autoprefixer), mqpacker(options.mqpacker)]))
    .pipe(rename({ ...options.rename }))
    .pipe(gulp.dest(path.scss_widgets.dest))
    .pipe(size(options.size));
});

gulp.task("scss_gutenberg", function () {
  return gulp
    .src(path.scss_gutenberg.src)
    .pipe(debug(options.debug))
    .pipe(sass(options.sass).on("error", options.onError))
    .pipe(cleanCSS(options.cleanCss))
    .pipe(
      postCSS([autoprefixer(options.autoprefixer), mqpacker(options.mqpacker)])
    )
    .pipe(rename({ ...options.rename, dirname: "" }))
    .pipe(gulp.dest(path.scss.dest))
    .pipe(size(options.size));
});

gulp.task("watch", async () => {
  gulp.watch(path.scss.src, gulp.series("scss"));
  gulp.watch(path.scss_gutenberg.src, gulp.series("scss_gutenberg"));
  gulp.watch(path.scss_inner.src, gulp.series("scss_inner"));
  gulp.watch(path.scss_widgets.src, gulp.series('scss_widgets'));
  gulp.watch(path.js.src, gulp.series("scripts"));
  gulp.watch(path.js_widgets.src, gulp.series('js_widgets'));
});

gulp.task("default", gulp.series("watch"));
