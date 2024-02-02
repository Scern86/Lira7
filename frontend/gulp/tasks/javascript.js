import gulp from 'gulp';
import plumber from 'gulp-plumber';     /* Отображение ошибок */
import rename from 'gulp-rename';       /* Изменение имени файла */
import uglify from 'gulp-uglify';       /* Сжатие JS файла */
import jsPath from '../path.js';

const javascript = () => {
    return gulp.src(jsPath.src.js)
        .pipe(plumber())
        .pipe(uglify())
        .pipe(rename({suffix:'.min'}))
        .pipe(gulp.dest(jsPath.dest.js));
}
export {javascript}