import gulp from 'gulp';

import path from '../path.js';

const files = () => {
    return gulp.src(path.src.files)
        .pipe(gulp.dest(path.dest.files));
}
export {files}