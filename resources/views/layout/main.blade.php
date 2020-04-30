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
    {{--<meta http-equiv="Content-Security-Policy" content="default-src 'self'">--}}
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
    @if(!is_null(config("feed.feeds")))
        @foreach(config("feed.feeds") as $feed)
            <link rel="alternate" href="{{ $feed['url'] }}" type="application/atom+xml" title="{{ $feed['title'] }}">
        @endforeach
    @endif
    <link rel="icon" href="{{ asset("favicon.ico") }}" type="image/x-icon" />
    <link rel="icon" sizes="192x192" href="{{ asset("icon.png") }}">
    <link rel="apple-touch-icon" href="{{ asset("icon.png") }}">
    <link rel="apple-touch-startup-image" href="{{ asset("icon.png") }}">
    <link rel="mask-icon" href="{{ asset("icon.svg") }}" color="blue">
    <meta name="apple-mobile-web-app-title" content="{{ config("comment.site_name") }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    @if(isset($user))
        <link rel="author" href="{{ $user->nickname }}">
        <link rel="publisher" href="{{ $user->nickname }}">
    @endif
    <meta itemprop="name" content="@yield("title")">
    <meta itemprop="description" content="@yield("description", config("comment.seo.description"))">
    <meta itemprop="image" content="{{ asset("icon.png") }}">
    <meta name="description" itemprop="description" content="@yield("description", config("comment.seo.description"))">
    <title>@yield("title") @if(isset($is_show_site_name) && $is_show_site_name === true) - {{ config("comment.site_name") }} @endif </title>
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
@include("comment.layout.nav")
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
