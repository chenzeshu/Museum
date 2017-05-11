<?php

namespace App\Http\Controllers;

use App\File;
use App\Folder;
use Illuminate\Http\Request;

class CountController extends Controller
{
    public function index()
    {
        $folder_count = Folder::count();
        $file_count = File::count();
        $file_size = File::pluck('size')->sum();
        return view('count',compact('folder_count', 'file_count','file_size'));
    }
}
