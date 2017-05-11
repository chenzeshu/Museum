<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/8
 * Time: 18:54
 */

namespace App\Repositories;


use Illuminate\Support\Facades\Storage;

class FilesRepository
{
    /**
     *  传入的是上传后的临时文件名
     */
    public function moveFile($name)
    {
        //todo 拿到临时文件路径
        $temp_path = "temp/".date('Ym',time())."/".$name;  //  temp/201705/foo.bar
        //todo  转移文件并删除源文件
        $aim_folder = 'public/cangku/'.session('folder_id');
        $aim_path = $aim_folder.'/'.$name;
        Storage::move($temp_path, $aim_path);
        return $aim_path;
    }

    public function deleteFile($file)
    {
        //todo 删除文件
        if($file->path){
            Storage::delete($file->path);
        }
        //todo 删除持久化信息
        $re = $file->delete();

        if($re){
            return 'success';
        }else{
            return 'error';
        }
    }
}