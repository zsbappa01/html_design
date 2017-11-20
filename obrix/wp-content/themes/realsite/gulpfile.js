var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass-variants', function() {
	gulp.src('./assets/scss/variants/*.scss')
		.pipe(sass({
			includePaths: ['./assets/scss'],
			errorLogToConsole: true
		}))
		.pipe(gulp.dest('./assets/css/variants'));
});

gulp.task('sass-primary', function() {
	gulp.src('./assets/scss/realsite.scss')
		.pipe(sass())
		.pipe(gulp.dest('./assets/css/'));
});

gulp.task('watch', function() {
    gulp.watch('./assets/scss/*.scss', ['sass-primary']);
    gulp.watch('./assets/scss/helpers/*.scss', ['sass-primary']);
});