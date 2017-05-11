<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Repositories\FilesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class FoldersController extends Controller
{
    protected $files;

    function __construct(FilesRepository $files)
    {
        $this->files = $files;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = Folder::count();
        $folders = Folder::orderBy('id', 'desc')->withCount('files')->paginate(15);
        foreach ($folders as $k => $v){
            foreach ($v->files as $file){
                $v['size'] += $file['size'];
            }
            $v['size'] = ceil($v['size']);  //转换为MB
        }
        return view('home', compact('folders','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Folder::create([
           'name'=>$request->name,
            'desc'=>$request->desc
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
        session(['folder_id'=>$id]);
        $count = Folder::findOrFail($id)->files()->count();
        $files = Folder::findOrFail($id)->files()->orderBy('id','desdc')->paginate(15);
        return view('files.files', compact('files','count'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        Folder::findOrFail($id)->update([
           'name'=>$request->name,
            'desc'=>$request->desc
        ]);
        return back()->withErrors('修改成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder = Folder::findOrFail($id);
        $folder->files()->each(function ($file, $key){
           $this->files->deleteFile($file);
        });
        $folder->delete();
        return Redirect::back()->withErrors('删除成功!');;
    }
}
