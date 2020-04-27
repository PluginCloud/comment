@extends("comment.layout.main")
@section("title", config("comment.site_name"))
@php($is_show_site_name = false)
@section("content")
    <div class="layui-row">
        <div class="layui-col-sm8 layui-col-xs12">
            <div class="layui-card fly-panel">
                <div class="layui-card-body">
                    <ul class="content_list">
                        @foreach($contents as $content)
                            <li class="content_item layui-hide-xs">
                                <a href="{{ route("comment.home.content.info", ["id" => $content->id]) }}"
                                   title="{{ $content->title }} - {{ config("comment.site_name") }}">{{ $content->title }}</a>
                            </li>
                            <li class="content_item content_item_ellipsis layui-hide-lg layui-hide-md layui-hide-sm">
                                <a href="{{ route("comment.home.content.info", ["id" => $content->id]) }}"
                                   title="{{ $content->title }} - {{ config("comment.site_name") }}">{{ $content->title }}</a>
                            </li>
                        @endforeach
                        @if($contents->hasPages())
                            <li class="content_item">
                                <a href="{{ route("comment.home.content.contents") }}"
                                   title="更多内容 - {{ config("comment.site_name") }}">查看更多精彩内容 >></a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="layui-col-sm4 layui-col-xs12">
            <div class="layui-card fly-panel">
                <div class="layui-card-body">
                    <ul class="content_list">
                        @foreach($comments as $comment)
                            <li class="content_item layui-hide-xs">
                                <a href="{{ route("comment.home.content.info", ["id" => $comment->id]) }}"
                                   title="{{ $comment->title }} - {{ config("comment.site_name") }}">{{ $comment->title }}</a>
                            </li>
                            <li class="content_item content_item_ellipsis layui-hide-lg layui-hide-md layui-hide-sm">
                                <a href="{{ route("comment.home.content.info", ["id" => $comment->id]) }}"
                                   title="{{ $comment->title }} - {{ config("comment.site_name") }}">{{ $comment->title }}</a>
                            </li>
                        @endforeach
                        @if($comments->hasPages())
                                <li class="content_item">
                                    <a href="{{ route("comment.home.content.comments") }}"
                                       title="更多评论 - {{ config("comment.site_name") }}">查看更多精彩评论 >></a>
                                </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
