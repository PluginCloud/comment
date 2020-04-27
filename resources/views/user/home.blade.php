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
    <div class="layui-card fly-panel">
        <div class="layui-card-body">
            @if(!is_null($userHomeContentsTop))
                <div class="layui-row">
                    <div class="layui-col-sm12 ads_content">
                        {!! $userHomeContentsTop->content !!}
                    </div>
                </div>
            @endif
            @foreach($contents as $content)
                <div class="center_content_item">
                    <div class="layui-row">
                        <div class="layui-col-sm10 layui-col-xs12">
                            <span class="title">
                                <a href="{{ route("comment.home.content.info", ['id' => $content->id]) }}"
                                   style="@if($content->is_online == 0) text-decoration: line-through;color: #FF5722; @endif">
                                    {{ $content->title }}
                                </a>
                            </span>
                        </div>
                        <div class="layui-col-sm2 layui-hide-xs">
                            <span class="view">
                                {{ $content->created_at }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
            @if(!is_null($userHomeContentsBottom))
                <div class="layui-row">
                    <div class="layui-col-sm12 ads_content">
                        {!! $userHomeContentsBottom->content !!}
                    </div>
                </div>
            @endif
            @if($contents->hasPages())
                {{ $contents->links("comment.layout.paginate", ["paginate" => $contents]) }}
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
