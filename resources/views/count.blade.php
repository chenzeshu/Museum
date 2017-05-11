@extends('layouts.app')

@section('content')
    <div class="uk-grid margin-top-30">
        <div class="uk-width-8-10 uk-container-center">
            <ul class="uk-breadcrumb">
                <li><a href="{{url('home')}}"><span class="uk-text-large uk-text-bold">文件夹目录总览</span></a></li>
            </ul>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="uk-alert" data-uk-alert>
                        <a href="" class="uk-alert-close uk-close"></a>
                        <p>{{$error}}</p>
                    </div>
                @endforeach
            @endif
                {{--文件夹总数--}}
                <div class="uk-block uk-block-muted">
                    <div class="uk-container">
                        <h3 class="uk-text-bold">文件夹数目</h3>
                        <div class="uk-grid uk-grid-match" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="uk-panel">
                                    <h3 class="uk-text-primary">{{$folder_count}}个</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <hr>
                {{--文件总数--}}
                <div class="uk-block uk-block-muted">
                    <div class="uk-container">
                        <h3 class="uk-text-bold">文件数目</h3>
                        <div class="uk-grid uk-grid-match" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="uk-panel">
                                    <h3 class="uk-text-primary">{{$file_count}}个</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <hr>
                {{--文件大小--}}
                <div class="uk-block uk-block-muted">
                    <div class="uk-container">
                        <h3 class="uk-text-bold">文件总体积</h3>
                        <div class="uk-grid uk-grid-match" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <div class="uk-panel">
                                    <h3 class="uk-text-primary">{{$file_size}}MB</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection
