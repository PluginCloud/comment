@extends("comment.layout.main")
@section("title", $user->nickname."的个人主页")
@php($is_show_site_name = true)
@section("content")
    <div class="layui-card fly-panel">
        <div class="layui-card-header">
            <div class="layui-row">
                <div class="layui-col-sm12">
                    <span class="layui-breadcrumb" lay-separator="/">
                      <a href="{{ route("comment.home.content.index") }}">首页</a>
                      <a><cite>{{ $user->nickname."的个人主页" }}</cite></a>
                    </span>
                </div>
            </div>
        </div>
        <div class="layui-card-body">
            @if(!is_null($userHomeUserTop))
                <div class="layui-row">
                    <div class="layui-col-sm12 ads_content">
                        {!! $userHomeUserTop->content !!}
                    </div>
                </div>
            @endif
            <div class="layui-row">
                <div class="layui-col-sm1 layui-col-xs4">
                    <div class="profile_picture">
                        <img src="{{ asset($user->picture_url) }}" title="{{ $user->nickname }} - {{ config("comment.site_name") }}">
                    </div>
                </div>
                <div class="layui-col-sm3 layui-col-xs8">
                    <ul class="content_list">
                        <li class="content_item">{{ $user->nickname }}</li>
                        <li class="content_item">
                            <span>已发布 {{ $contents->total() }} 篇内容</span>
                        </li>
                    </ul>
                </div>
                <div class="layui-col-sm8"></div>
            </div>
            @if(!is_null($userHomeUserBottom))
                <div class="layui-row">
                    <div class="layui-col-sm12 ads_content">
                        {!! $userHomeUserBottom->content !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="layui-card fly-panel background_color_none">
        <ul class="content_list">
            @foreach($contents as $content)
                <li class="item">
                    <h2 class="title item_ellipsis">
                        <a href="{{ route("comment.home.content.info", ["id" => $content->id]) }}"
                           title="{{ $content->title }} - {{ config("comment.site_name") }}">{{ $content->title }}</a>
                    </h2>
                    <div class="description layui-hide-xs">
                        {{ Illuminate\Support\Str::limit(strip_tags($content->content), 250,'...') }}
                    </div>
                    <div class="description layui-hide-sm layui-hide-lg">
                        {{ Illuminate\Support\Str::limit(strip_tags($content->content), 140,'...') }}
                    </div>
                    <div class="other_info layui-hide-xs">
                        <div class="layui-col-sm1">
                            <i class="icon layui-icon layui-icon-read"></i>
                            <span class="number">{{ $content->read_count }}</span>
                        </div>
                        <div class="layui-col-sm1">
                            <i class="icon layui-icon layui-icon-heart-fill"></i>
                            <span class="number">{{ $content->support_count }}</span>
                        </div>
                        <a class="layui-col-sm1" href="{{ route("comment.home.content.info", ['id' => $content->id]) }}#history_comments">
                            <i class="icon layui-icon layui-icon-reply-fill"></i>
                            <span class="number">{{ $content->comment_count }}</span>
                        </a>
                        <div class="layui-col-sm1">
                            <i class="icon layui-icon layui-icon-star-fill"></i>
                            <span class="number">{{ $content->collect_count }}</span>
                        </div>
                        <div class="right layui-col-sm4 layui-col-sm-offset4">
                            <i class="icon layui-icon layui-icon-time"></i>
                            <span class="number">{{ $content->created_at }}</span>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        @if($contents->hasPages())
            {{ $contents->links("comment.layout.paginate", ["paginate" => $contents]) }}
        @endif
        <div class="layui-card-body">
            @if(!is_null($userHomeContentsTop))
                <div class="layui-row">
                    <div class="layui-col-sm12 ads_content">
                        {!! $userHomeContentsTop->content !!}
                    </div>
                </div>
            @endif
            @if(!is_null($userHomeContentsBottom))
                <div class="layui-row">
                    <div class="layui-col-sm12 ads_content">
                        {!! $userHomeContentsBottom->content !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section("footer")
    <script>
        layui.use(['element'], function(){
            var element = layui.element;
        });
    </script>
@endsection
