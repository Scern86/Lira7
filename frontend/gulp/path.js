const srcFolder = './src';
const destFolder = '../public/assets';

export default {
    src:{
        files: srcFolder + '/files/**/*.*',
        images: srcFolder + '/images/**/*.*',
        fonts: srcFolder + '/fonts/**/*.*',
        svg: srcFolder + '/svg/*.svg',
        scss: srcFolder + '/scss/*.scss',
        js: srcFolder + '/js/**/*.js',
    },
    dest:{
        files: destFolder + '/files/',
        images: destFolder + '/images/',
        fonts: destFolder + '/fonts/',
        svg: destFolder + '/sprites/',
        scss: destFolder + '/css/',
        js: destFolder + '/js/',
    },
    watch:{
        files: srcFolder + '/files/**/*.*',
        images: srcFolder + '/images/**/*.*',
        fonts: srcFolder + '/fonts/**/*.*',
        svg: srcFolder + '/svg/*.svg',
        scss: srcFolder + '/scss/**/*.scss',
        js: srcFolder + '/js/**/*.js',
    },
    clean:destFolder,
    srcFolder:srcFolder,
    destFolder:destFolder,
}