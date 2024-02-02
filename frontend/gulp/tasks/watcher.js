import gulp from 'gulp';
import {files} from "./files.js";
import {css} from "./css.js";
import {javascript} from "./javascript.js";
import {images} from "./images.js";
import path from '../path.js';

const watcher = ()=>{
    gulp.watch(
        path.watch.files,
        {
            delay: 200,
            events: ['add', 'change'],
            interval: 100,
            usePolling: true,
        },
        files
    );
    gulp.watch(
        path.watch.scss,
        {
            delay:200,
            events:['add','change'],
            interval:100,
            usePolling:true,
        },
        css
    );
    gulp.watch(
        path.watch.js,
        {
            delay:200,
            events:['add','change'],
            interval:100,
            usePolling:true,
        },
        javascript
    );
    gulp.watch(
        path.watch.images,
        {
            delay:200,
            events:['add','change'],
            interval:100,
            usePolling:true,
        },
        images
    );
}

export {watcher}