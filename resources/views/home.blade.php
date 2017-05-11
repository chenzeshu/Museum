@extends('layouts.app')

@section('content')
    <div class="uk-grid margin-top-30">
        <div class="uk-width-8-10 uk-container-center">
            <ul class="uk-breadcrumb">
                <li><a href="{{url('home')}}"><span class="uk-text-large uk-text-bold">文件夹目录总览</span></a>
                @include('folders._create')</li>
            </ul>
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
                    <th>文件夹编号</th>
                    <th>文件夹名称</th>
                    <th>文件夹描述</th>
                    <th>文件数量</th>
                    <th>总体积(MB)</th>
                    <th>创建时间</th>
                    <th colspan="2">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($folders as $folder)
                    <tr>
                        <td>{{$folder->id}}</td>
                        <td><a href="{{url('folders').'/'.$folder->id}}" class="uk-button"><i class="uk-icon-folder"></i> {{$folder->name}}</a></td>
                        <td width="600">{{$folder->desc}}</td>
                        <td>{{$folder->files_count}}</td>
                        <td>{{$folder->size}}</td>
                        <td>{{$folder->created_at}}</td>
                        <td>
                            {{--<a class="uk-button uk-button-primary" href="">修改</a>--}}
                            @include('folders._edit')
                            @include('folders._delete')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $folders->links() }}
        </div>
    </div>

@endsection
