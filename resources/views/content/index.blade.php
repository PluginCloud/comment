@extends("comment.layout.main")
@section("title", config("comment.site_name"))
@php($is_show_site_name = false)
@section("content")
    <div class="layui-row">
        <div class="layui-col-sm8 layui-col-xs12">
            <div class="layui-card fly-panel background_color_none">
                <div class="layui-card-body">
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
                                    <div class="layui-col-sm2">
                                        <i class="icon layui-icon layui-icon-username"></i>
                                        <span class="number">{{ $content->user_nickname }}</span>
                                    </div>
                                    <div class="layui-col-sm1">
                                        <i class="icon layui-icon layui-icon-heart-fill"></i>
                                        <span class="number">{{ $content->support_count }}</span>
                                    </div>
                                    <div class="layui-col-sm1">
                                        <i class="icon layui-icon layui-icon-reply-fill"></i>
                                        <span class="number">{{ $content->comment_count }}</span>
                                    </div>
                                    <div class="layui-col-sm1">
                                        <i class="icon layui-icon layui-icon-star-fill"></i>
                                        <span class="number">{{ $content->collect_count }}</span>
                                    </div>
                                    <div class="right layui-col-sm4 layui-col-sm-offset2">
                                        <i class="icon layui-icon layui-icon-time"></i>
                                        <span class="number">{{ $content->created_at }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @if($contents->hasPages())
                            <li class="more center">
                                <a href="{{ route("comment.home.content.contents") }}"
                                   title="查看更多 - {{ config("comment.site_name") }}">查看更多 >></a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="layui-col-sm4 layui-col-xs12">
            <div class="layui-card fly-panel">
                <div class="layui-card-header">
                    <h3>推荐作者</h3>
                </div>
                <div class="layui-card-body">
                    <ul class="user_list">
                        @foreach($users as $user)
                            <li class="item">
                                <div class="layui-row">
                                    <div class="layui-col-sm3 layui-col-xs3">
                                        <a href="{{ route("comment.home.user.home", ["id" => $user->id]) }}"
                                           title="{{ $user->nickname }} - {{ config("comment.site_name") }}">
                                            <img src="{{ url($user->picture_url) }}" class="picture"
                                                 alt="{{ $user->nickname }} - {{ config("comment.site_name") }}">
                                        </a>
                                    </div>
                                    <div class="layui-col-sm6 layui-col-xs6">
                                        <div class="info">
                                            <a href="{{ route("comment.home.user.home", ["id" => $user->id]) }}"
                                               title="{{ $user->nickname }} - {{ config("comment.site_name") }}">
                                                <h4 class="nickname">{{ $user->nickname }}</h4>
                                            </a>
                                            <div class="desc">
                                                <span>写 {{ $user->content_count }} 篇文章，发布 {{ $user->comment_count }} 评论</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-col-sm2 layui-col-xs2">
                                        <button class="follow layui-btn layui-btn-warm layui-hide-xs">+ 关注 Ta</button>
                                        <button class="follow layui-btn layui-btn-warm layui-btn-sm layui-hide-sm layui-hide-lg">+ 关注 Ta</button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @if($users->hasPages())
                            <li class="item right">
                                <a href="{{ route("comment.home.content.comments") }}"
                                   title="查看更多 - {{ config("comment.site_name") }}">查看更多 >></a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            {{--<div class="layui-card fly-panel">
                <div class="layui-card-header">
                    <h3>推荐文集</h3>
                </div>
                <div class="layui-card-body">
                    <ul class="content_list">
                        @foreach($collects as $collect)
                            <li class="content_item layui-hide-xs">
                                <a href="{{ route("comment.home.content.info", ["id" => $collect->id]) }}"
                                   title="{{ $collect->name }} - {{ config("comment.site_name") }}">{{ $collect->name }}</a>
                            </li>
                            <li class="content_item content_item_ellipsis layui-hide-lg layui-hide-md layui-hide-sm">
                                <a href="{{ route("comment.home.content.info", ["id" => $collect->id]) }}"
                                   title="{{ $collect->name }} - {{ config("comment.site_name") }}">{{ $collect->name }}</a>
                            </li>
                        @endforeach
                        @if($collects->hasPages())
                            <li class="item right">
                                <a href="{{ route("comment.home.content.comments") }}"
                                   title="查看更多 - {{ config("comment.site_name") }}">查看更多 >></a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>--}}
        </div>
    </div>
@endsection
