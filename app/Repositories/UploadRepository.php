<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/8
 * Time: 9:50
 */

namespace App\Repositories;


use Illuminate\Support\Facades\Storage;

class UploadRepository
{
    /**
     * @param $name
     * 路径为public下的文件夹
     */
    public function makeSureTempFolderExist($name)
    {
        if(!Storage::files('public/'.$name)){
            Storage::makeDirectory('public/'.$name);
        }
    }
}