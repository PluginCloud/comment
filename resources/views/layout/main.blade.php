<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="@yield("keywords", config("comment.seo.keywords").",".config("comment.site_name"))">
    <meta name="description" content="@yield("description", config("comment.seo.description"))">
    <base href="{{ config("comment.base_url") }}">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
    <meta name="application-name" content="{{ config("comment.site_name") }}">
    <meta name="theme-color" content="#4285f4">
    <meta name="robots" content="index,follow">
    <meta name="google" content="nositelinkssearchbox">
    <meta name="google" content="notranslate">
    <!-- 验证网址所有权 -->
    {{--<meta name="google-site-verification" content="verification_token"><!-- Google Search Console -->
    <meta name="yandex-verification" content="verification_token"><!-- Yandex Webmasters -->
    <meta name="msvalidate.01" content="verification_token"><!-- Bing Webmaster Center -->
    <meta name="alexaVerifyID" content="verification_token"><!-- Alexa Console -->
    <meta name="p:domain_verify" content="code from pinterest"><!-- Pinterest Console -->
    <meta name="norton-safeweb-site-verification" content="norton code"><!-- Norton Safe Web -->--}}
    <meta name="generator" content="program">
    <meta name="subject" content="@yield("description", config("comment.seo.description"))">
    <meta name="rating" content="General">
    <meta name="referrer" content="no-referrer">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-dns-prefetch-control" content="off">
    <link rel="self" type="application/atom+xml" href="{{ public_path("/atom.xml") }}">
    <!-- Feeds -->
    {{--<link rel="alternate" href="https://feeds.feedburner.com/example" type="application/rss+xml" title="RSS">
    <link rel="alternate" href="https://example.com/feed.atom" type="application/atom+xml" title="Atom 0.3">--}}
    <link rel="icon" sizes="192x192" href="{{ public_path("icon.png") }}">
    <link rel="apple-touch-icon" href="{{ public_path("icon.png") }}">
    <link rel="apple-touch-startup-image" href="{{ public_path("icon.png") }}">
    <link rel="mask-icon" href="{{ public_path("icon.svg") }}" color="blue">
    <meta name="apple-mobile-web-app-title" content="{{ config("comment.site_name") }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    @if(isset($user))
    <link rel="author" href="{{ $user->nickname }}">
    <link rel="publisher" href="{{ $user->nickname }}">
    @endif
    <meta itemprop="name" content="@yield("title")">
    <meta itemprop="description" content="@yield("description", config("comment.seo.description"))">
    <meta itemprop="image" content="{{ public_path("icon.png") }}">
    <meta name="description" itemprop="description" content="@yield("description", config("comment.seo.description"))">
    <title>@yield("title") @if(isset($is_show_site_name) && $is_show_site_name === true)- {{ config("comment.site_name") }} @endif </title>
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
