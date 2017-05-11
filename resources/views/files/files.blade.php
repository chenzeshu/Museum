@extends('layouts.app')

@section('content')

    <div class="uk-grid margin-top-30">
        <div class="uk-width-8-10 uk-container-center">

            <ul class="uk-breadcrumb" style="float:left">
                <li><a href="{{url('home')}}">文件目录总览</a></li>
                <li><a href="#">文件夹名：【@if($count){{$files[0]->name}}@else 本文件夹无内容 @endif】</a></li>
            </ul>
            <div style="float:left;margin-top:-8px">@include('files._create')</div>
            <br>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="uk-alert" data-uk-alert>
                        <a href="" class="uk-alert-close uk-close"></a>
                        <p>{{$error}}</p>
                    </div>
                @endforeach
            @endif
            <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                <thead>
                <tr>
                    <th>文件名称</th>
                    <th>拍摄时间</th>
                    <th>剧种</th>
                    <th>剧团</th>
                    <th>演出地点</th>
                    <th>主要演员</th>
                    <th>剧名</th>
                    <th>文件大小</th>
                    <th>格式</th>
                    <th>备注</th>
                    <th colspan="3">操作</th>
                </tr>
                </thead>
                <tbody>
                @if($files)
                @foreach($files as $file)
                    <tr>
                        <td><i class="uk-icon-file-movie-o"></i>　{{$file->name}}</td>
                        <td>{{$file->time}}</td>
                        <td>{{$file->type}}</td>
                        <td>{{$file->troupe}}</td>
                        <td>{{$file->address}}</td>
                        <td>{{$file->actor}}</td>
                        <td>{{$file->drama}}</td>
                        <td>{{$file->size}}</td>
                        <td>{{$file->ext}}</td>
                        <td>@include('files._remark')</td>
                        <td>
                            <a class="uk-button" href="{{route('files.download',$file->id)}}">下载</a>
                            <a class="uk-button uk-button-primary" href="{{route('files.edit',$file->id)}}">修改</a>
                            {{--<button class="uk-button uk-button-danger" href="#">删除</button>--}}
                            @include('files._delete')
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>

            {{ $files->links() }}
        </div>
    </div>

@endsection
