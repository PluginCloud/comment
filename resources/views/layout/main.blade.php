<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title") @if(isset($is_show_site_name) && $is_show_site_name === true)- {{ config("comment.site_name") }} @endif </title>
    <meta name="keywords" content="@yield("keywords", "内容分享,内容创作,网赚,广告收入,".config("comment.site_name"))">
    <meta name="description" content="@yield("description", "一个简约的内容分享平台，通过发布内容和浏览点击广告可获得一定的收益")">
    <link rel="stylesheet" href="{{ asset("layui/css/layui.css") }}">
    <link rel="stylesheet" href="{{ asset("layui/css/layui.mobile.css") }}">
    <link rel="stylesheet" href="{{ asset("comment/css/app.css") }}">
    <script src="{{ asset("layui/layui.js") }}"></script>
    <script>
        layui.use("jquery", function () {
            window.scw$ = layui.$;
        });
    </script>
    @yield("header")
</head>
<body>
    <div class="header layui-bg-black">
        <div class="layui-row">
            <div class="layui-col-sm2 layui-col-md2 layui-col-lg2 layui-hide-xs">
                <div style="padding-top: 10px"></div>
            </div>
            <div class="layui-col-sm8 layui-col-md8 layui-col-lg8 layui-col-xs12">
                <div class="layui-row">
                    <div class="layui-col-sm8 layui-col-md6 layui-col-lg9 layui-col-xs4">
                        <ul class="layui-nav" lay-filter="">
                            <li class="layui-nav-item @if(request()->route()->named("comment.home.content.index")) layui-this @endif">
                                <a href="{{ route("comment.home.content.index") }}">首页</a>
                            </li>
                        </ul>
                    </div>
                    <div class="layui-col-sm2 layui-col-md2 layui-col-lg1 layui-hide-xs">
                        <ul class="layui-nav" lay-filter="">
                            <li class="layui-nav-item @if(request()->route()->named("comment.home.content.search")) layui-this @endif">
                                <a href="{{ route("comment.home.content.search") }}">
                                    <i class="layui-icon layui-icon-search"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="layui-col-sm2 layui-col-md4 layui-col-lg2 layui-col-xs8 right">
                        <ul class="layui-nav" lay-filter="">
                            @if(session()->has("comment_user"))
                                <li class="layui-nav-item @if(request()->route()->named("comment.home.user.center")) layui-this @endif">
                                    <a href="{{ route("comment.home.user.center") }}">我的</a>
                                </li>
                                <li class="layui-nav-item @if(request()->route()->named("comment.home.user.logout")) layui-this @endif">
                                    <a href="{{ route("comment.home.user.logout") }}">退出</a>
                                </li>
                            @else
                                <li class="layui-nav-item @if(request()->route()->named("comment.home.user.login")) layui-this @endif">
                                    <a href="{{ route("comment.home.user.login") }}">登录</a></li>
                                <li class="layui-nav-item @if(request()->route()->named("comment.home.user.register")) layui-this @endif">
                                    <a href="{{ route("comment.home.user.register") }}">注册</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm2 layui-col-md2 layui-col-lg2 layui-hide-xs">
                <div style="padding-top: 10px"></div>
            </div>
        </div>
    </div>
    <div class="layui-row">
        <div class="layui-col-sm2 left_layout layui-hide-xs">
            @include("comment.layout.left_layout")
        </div>
        <div class="layui-col-sm8 main_layout">
            @yield("content")
        </div>
        <div class="layui-col-sm2 right_layout layui-hide-xs">
            @include("comment.layout.right_layout")
        </div>
    </div>
    <div class="layui-row footer layui-bg-black">
        @include("comment.layout.footer")
    </div>
    @yield("footer")
    @include("comment.layout.footer_script")
</body>
</html>
