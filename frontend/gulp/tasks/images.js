import gulp from 'gulp';

import path from '../path.js';

const images = () => {
    return gulp.src(path.src.images)
        .pipe(gulp.dest(path.dest.images));
}
export {images}