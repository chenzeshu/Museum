<?php

namespace App\Http\Controllers;


use App\File;
use App\Folder;
use App\Repositories\FilesRepository;
use App\Repositories\UploadRepository;
use APP\Utils\FileUtil;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File as Util;

class FilesController extends Controller
{
    protected $repo;
    protected $upload;

    function __construct(FilesRepository $repo, UploadRepository $upload)
    {
        $this->repo = $repo;
        $this->upload = $upload;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $folder = Folder::findOrFail(session('folder_id'));

        if(!empty($request->path)){
            //将临时文件转移到目标盘下
                //todo 确认文件夹是否存在，否则新建
                $this->upload->makeSureTempFolderExist('cangku/'.session('folder_id'));
                //todo 拿到持久化路径
                $aim_path = $this->repo->moveFile($request->path);
        }

        $folder->files()->create([
            'folder_name'=>$folder->name,
            'name'=>$request->name,
            'time'=>$request->time,
            'type'=>$request->type,
            'troupe'=>$request->troupe,
            'address'=>$request->address,
            'actor'=>$request->actor,
            'drama'=>$request->drama,
            'size'=>$request->size,
            'ext'=>$request->ext,
            'path'=>$aim_path,
            'remark'=>$request->remark,
        ]);

        return Redirect::back()->withErrors('新建成功!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = File::findOrFail($id);

        return view('files.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = File::findOrFail($id);
        //todo 假如存在旧文件，删除旧文件
        if(!empty($file->path)){
            Storage::delete($file->path);
        }
        //todo 拿到新文件持久化路径
        $aim_path = $this->repo->moveFile($request->path);

        $file->update([
            'name'=>$request->name,
            'time'=>$request->time,
            'type'=>$request->type,
            'troupe'=>$request->troupe,
            'address'=>$request->address,
            'actor'=>$request->actor,
            'drama'=>$request->drama,
            'ext'=>$request->ext,
            'size'=>$request->size,
            'path'=>$aim_path,
            'remark'=>$request->remark,
        ]);
        return Redirect::back()->withErrors('修改成功!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        $this->repo->deleteFile($file);
        return Redirect::back()->withErrors('删除成功!');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        return response()->download(storage_path('app/'.$file->path), $file->name.'.'.$file->ext);
    }

    public function search(Request $request)
    {
        $files = File::where('name', 'like', '%'.$request->name.'%');
        $count = $files->count();
        $files = $files->get();
        return view('files.search', compact('files'))->withErrors($count);
    }
}
