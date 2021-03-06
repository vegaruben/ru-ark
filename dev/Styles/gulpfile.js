var gulp = require('gulp'), 
    sass = require('gulp-ruby-sass') 
    notify = require("gulp-notify") 
    bower = require('gulp-bower'),
	cleanCss = require('gulp-clean-css'),
	combineMq = require('gulp-combine-mq'),
	rename = require('gulp-rename'),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat')
	;
	

var config = {
     sassPath: './src/scss',
     bowerDir: './bower_components' ,
     nodejsDir: './node_modules' 
}

gulp.task('bower', function() { 
    return bower()
         .pipe(gulp.dest(config.bowerDir)) 
});

gulp.task('icons', function() { 
    return gulp.src(config.bowerDir + '/fontawesome/fonts/**.*') 
        .pipe(gulp.dest('../public/assets/fonts')); 
});

gulp.task('css', function() { 
    return gulp.src(config.sassPath + '/style.scss')
         .pipe(sass({
             style: 'compressed',
             loadPath: [
                 './src/sass',
                 config.nodejsDir + '/bootstrap/scss',
                 config.bowerDir + '/fontawesome/scss',
             ]
         }) 
            .on("error", notify.onError(function (error) {
                 return "Error: " + error.message;
             })))		
		//.pipe(rename('style.css'))
		//.pipe(gulp.dest('../public/assets/css'))
		.pipe(cleanCss())
        .pipe(rename({suffix: '.min'}))
         .pipe(gulp.dest('../public/assets/css')); 
});

gulp.task('scripts', function () {
    gulp.src(['node_modules/bootstrap/dist/js/bootstrap.min.js', 'node_modules/jquery/dist/jquery.min.js', 'node_modules/tether/dist/js/tether.min.js','./src/js/**/*.js'])
        .pipe(concat('main.js'))
        .pipe(gulp.dest('../public/assets/js'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest('../public/assets/js'))
        .pipe(notify({ message: 'Scripts task complete' }));
});

// Rerun the task when a file changes
 gulp.task('watch', function() {
     gulp.watch(config.sassPath + '/**/*.scss', ['css']); 
});

  gulp.task('default', ['bower', 'icons', 'css', 'scripts']);
