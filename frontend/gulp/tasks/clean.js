import {deleteAsync} from 'del';      /* Удаление файлов и директорий */

import path from '../path.js';

const clean = async () => {
    return await deleteAsync(path.clean, {force: true});
}
export {clean}