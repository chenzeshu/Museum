<?php

namespace App\Http\Controllers;

use App\Repositories\UploadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    protected $repo;

    function __construct(UploadRepository $repo)
    {
        $this->repo = $repo;
    }

    public function uploadImage(Request $request)
    {
        $this->repo->makeSureTempFolderExist('wang');

        $image = $request->file('image');
        $path = Storage::putFile('public/wang',$image);
        $cut = substr($path,6);
        return env('APP_HTTP_URL').'/storage'.$cut;
    }

    public function moveFile()
    {
        //存到目标盘的映射文件夹"cangku"中

    }
}
