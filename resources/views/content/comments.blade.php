@extends("comment.layout.main")
@section("title", "更多评论")
@php($is_show_site_name = true)
@section("content")
    <div class="layui-row">
        <div class="layui-col-sm12">
            <div class="layui-card fly-panel background_color_none">
                <ul class="content_list">
                    @foreach($comments as $content)
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
                                <a class="layui-col-sm2" href="{{ route("comment.home.user.home", ['id' => $content->user_id]) }}">
                                    <i class="icon layui-icon layui-icon-username"></i>
                                    <span class="number">{{ $content->user_nickname }}</span>
                                </a>
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
                                <div class="right layui-col-sm4 layui-col-sm-offset2">
                                    <i class="icon layui-icon layui-icon-time"></i>
                                    <span class="number">{{ $content->created_at }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
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
