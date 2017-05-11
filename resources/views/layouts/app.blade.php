<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/uikit.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/uikit.gradient.min.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/uikit.almost-flat.min.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdn.bootcss.com/uikit/2.27.2/css/components/form-select.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/uikit/2.27.1/css/components/form-file.gradient.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/uikit/2.27.2/css/components/datepicker.gradient.min.css">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('js/wang/css/wangEditor.min.css')}}">
    <style>
        .wangEditor-container{
            min-height:400px;
            border-radius: 3px;
        }
        .wangEditor-txt{
            min-height:300px;
        }
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>

<div id="app">
    <nav class="uk-navbar">
        <!-- Branding Image -->
        <a class="uk-navbar-brand margin-left-100" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        @if (!Auth::guest())
        <!--left side-->
        <ul class="uk-navbar-nav margin-left-100">
            <li>
                <a href="{{url('home')}}">文件夹目录</a>
            </li>

            <li><a href="{{url('count')}}">资源统计</a></li>

            <div class="uk-navbar-content uk-hidden-small">
                <form class="uk-form uk-margin-remove uk-display-inline-block" action="{{route('files.search')}}" method="post">
                    {{csrf_field()}}
                    <input type="text" name="name" placeholder="查找文件">
                    <button class="uk-button uk-button-primary">查找</button>
                </form>
            </div>
        </ul>
        @endif
        <!--right side-->

        <div class="uk-navbar-content uk-navbar-flip  uk-hidden-small  margin-right-100">
            <ul class="uk-navbar-nav">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">登陆</a></li>
                    {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                @else
                    <li class="uk-parent" data-uk-dropdown>
                        <a href="">{{ Auth::user()->name }}</a>

                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                <li class="uk-nav-header">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        注销
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </li>
                @endif
            </ul>
        </div>
    </nav>

    @yield('content')

    <!-- Scripts -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ URL::asset('js/aetherupload.js') }}"></script>
    {{--<script src="http://s1.bdstatic.com/r/www/cache/ecom/etpl/3-2-0/etpl.js"></script>   UEditor--}}
    <script src="{{asset('js/uikit.min.js')}}"></script>
    <script src="https://cdn.bootcss.com/uikit/2.27.2/js/components/form-select.min.js"></script>
    <script src="https://cdn.bootcss.com/uikit/2.27.2/js/components/datepicker.min.js"></script>
    @yield('customerJS')
    @yield('customerEditJS')
</div>
</body>
</html>
