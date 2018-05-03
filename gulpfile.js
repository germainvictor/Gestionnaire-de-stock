/*
 +----------------------+
 |      Gulp tasks      |
 +----------------------+
 */

const gulp = require('gulp');
const sass = require('gulp-sass');
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const plumber = require('gulp-plumber');
const sassGlob = require('gulp-sass-glob');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const imageminifier = require('gulp-imagemin-quiet');
const browserSync = require('browser-sync').create();
const config = require('./config.json');
const colors = require('colors/safe');
const del = require('del');

// Tasks as defined in config
const tasks = Object.keys(config.tasks);

// Defaults are simple tasks (html, fonts and resources)
const defaults = tasks.map(task => ({ [task]: {} }));

// And override complex tasks
Object.entries(Object.assign.apply(null, [...defaults, {

  script: {
    pipes: () => [
      sourcemaps.init(),
      babel({ presets: ['es2015'] }),
      concat('app.js'),
      uglify(),
      sourcemaps.write('.'),
    ],
  },

  style: {
    pipes: () => [
      sourcemaps.init(),
      sassGlob(),
      sass({ outputStyle: 'compressed' }),
      autoprefixer(config.tasks.style.prefixer),
      sourcemaps.write('.'),
    ],
  },

  image: {
    pipes: () => [
      imageminifier(),
    ],
  },

}])).forEach(([name, task]) => gulp.task(name, task.dependencies || [], () => {
  // Make a stream with src or config src
  let stream = gulp.src(task.src || config.tasks[name].src).pipe(plumber());
  // Stream each pipe
  if (task.pipes) stream = task.pipes().reduce((s, pipe) => s.pipe(pipe), stream);
  // To dest
  if (task.dest) stream = stream.pipe(gulp.dest(task.dest));
  else if (config.tasks[name]) stream = stream.pipe(gulp.dest(config.tasks[name].dest));
  // Reload browser
  if (!task.nosync) stream = stream.pipe(browserSync.stream());
  // Return stream if async
  return task.sync ? null : stream;
}));

// Watches changes
gulp.task('watch', () => {
  // Start web server
  browserSync.init({ server: config.server.directory, open: false });
  // Watch each task files
  Object.entries(config.tasks).forEach(([key, value]) => gulp.watch(value.src, [key]));
});

// Remove dist folder
gulp.task('clean', () => del('dist'));

// Only build
gulp.task('build', ['clean'], () => gulp.start(tasks));

// Trigger build & watch
gulp.task('start', tasks, () => gulp.start('watch'));

// Helpers
const border = [colors.rainbow('-'.repeat(process.stdout.columns)), ''];
const formatter = help => 'gulp ' + colors.green(help[0]) + '     ' + colors.gray('# ' + help[1]);
const printer = line => console.log(line);

// Print commands
gulp.task('default', () => setTimeout(() => [...border, ...[
  ['clean', 'remove dist folder'],
  ['build', 'clean & build assets'],
  ['start', 'build, watch and start server'],
].map(formatter), ...border.reverse()].forEach(printer)));
