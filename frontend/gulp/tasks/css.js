import gulp from 'gulp';
import plumber from 'gulp-plumber';             /* Отображение ошибок */
import cssimport from 'gulp-cssimport';         /* Включение в файл из @import */
import * as dartSass from 'sass';/* Компиллятор SASS */
import gulpSass from 'gulp-sass';               /* Плагин SASS для Gulp */
const sass = gulpSass(dartSass);
import autoprefixer from 'gulp-autoprefixer';   /* Вендорные префиксы (moz-, ms-...) */
import shorthand from 'gulp-shorthand';         /* Укороченный синтаксис свойств */
import groupCssMediaQueries from 'gulp-group-css-media-queries';    /* Группировка @media запросов */
import rename from 'gulp-rename';               /* Изменение имени файла */
import csso from 'gulp-csso';                   /* Минификация CSS */

import path from '../path.js';

const css = () => {
    return gulp.src(path.src.scss)
        .pipe(plumber())
        .pipe(cssimport())
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(shorthand())
        .pipe(groupCssMediaQueries())
        /*.pipe(gulp.dest(path.dest.scss))*/
        .pipe(rename({suffix:'.min'}))
        .pipe(csso())
        .pipe(gulp.dest(path.dest.scss));
}

export {css}