@extends("comment.layout.main")
@section("title", "更多评论")
@php($is_show_site_name = true)
@section("content")
    <div class="layui-row">
        <div class="layui-col-sm8">
            <div class="layui-card fly-panel">
                <div class="layui-card-header">
                    <div class="layui-row">
                        <div class="layui-col-sm12">
                            <span class="layui-breadcrumb" lay-separator="/">
                              <a href="{{ route("comment.home.content.index") }}">首页</a>
                              <a><cite>更多评论</cite></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="layui-card-body">
                    <ul class="content_list">
                        @foreach($comments as $content)
                            <li class="content_item">
                                <a href="{{ route("comment.home.content.info", ["id" => $content->id]) }}"
                                   title="{{ $content->title }} - {{ config("comment.site_name") }}">{{ $content->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{ $comments->links("comment.layout.paginate") }}
            </div>
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
