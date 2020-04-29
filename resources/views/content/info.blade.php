@extends("comment.layout.main")
@section("title", $info->title)
@section("keywords", $info->keyword)
@section("description", $info->description)
@php($is_show_site_name = true)

@section("header")
    <link rel="stylesheet" href="{{ asset("wang/wangeditor.css") }}">
@endsection

@section("content")
    <div class="layui-row">
        <div class="layui-col-sm8">
            <div class="layui-card fly-panel">
                @if(!is_null($infoTopAd))
                    <div class="layui-row">
                        <div class="layui-col-sm12 ads_content">
                            {!! $infoTopAd->content !!}
                        </div>
                    </div>
                @endif
                <div class="layui-card-header layui-hide-xs">
                    <div class="layui-row">
                        <div class="layui-col-sm12">
                        <span class="layui-breadcrumb" lay-separator="/">
                          <a href="{{ route("comment.home.content.index") }}">首页</a>
                          <a><cite>{{ $info->title }}</cite></a>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="layui-card-body">
                    @if(!is_null($infoContentTopAd))
                        <div class="layui-row">
                            <div class="layui-col-sm12 ads_content">
                                {!! $infoContentTopAd->content !!}
                            </div>
                        </div>
                    @endif
                    <div class="layui-row" style="height: 30px">
                        <div class="layui-col-sm12 layui-col-xs12">
                            <div class="info_title">{{ $info->title }}</div>
                        </div>
                    </div>
                    <div class="layui-row">
                        <div class="layui-col-sm11">
                            <div class="info_publish_time">发布于 {{ $info->created_at }}</div>
                        </div>
                        <div class="layui-col-sm1  layui-hide-xs">
                            @if(!is_null($user) && $info->user_id === $user->id)
                                <a href="{{ route("comment.home.content.edit", ['id' => $info->id]) }}" class="edit_content">编辑文章</a>
                            @endif
                        </div>
                    </div>
                    <div class="layui-row">
                        <div class="info_content">
                            {!! $info->content !!}
                        </div>
                    </div>
                    @if(!is_null($infoContentBottomAd))
                        <div class="layui-row">
                            <div class="layui-col-sm12 ads_content">
                                {!! $infoContentBottomAd->content !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if($comments->total() > 0)
                <div class="layui-card fly-panel">
                    <div class="layui-card-header">
                        <span>历史评论</span>
                        <a name="history_comments"></a>
                    </div>
                    <div class="layui-card-body">
                        @if(!is_null($infoCommentsTopAd))
                            <div class="layui-row">
                                <div class="layui-col-sm12 ads_content">
                                    {!! $infoCommentsTopAd->content !!}
                                </div>
                            </div>
                        @endif
                        <ul>
                            @foreach($comments as $comment)
                                <li class="center_content_item">
                                    <a href="{{ route("comment.home.content.info", ['id' => $comment->id]) }}"
                                       title="{{ $comment->title }} - {{ config("comment.site_name") }}">{{ $comment->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                        @if($comments->hasPages())
                            <div class="layui-card-footer">
                                {{ $comments->links("comment.layout.paginate", ["paginate" => $comments]) }}
                            </div>
                        @endif
                        @if(!is_null($infoCommentsBottomAd))
                            <div class="layui-row">
                                <div class="layui-col-sm12 ads_content">
                                    {!! $infoCommentsBottomAd->content !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="layui-col-sm4">
            <div class="layui-card fly-panel">
                <div class="layui-card-body">
                    <div class="center">
                        <button class="layui-btn layui-btn-primary" title="支持">
                            <i class="layui-icon layui-icon-praise"></i>
                            <span>支持</span>
                        </button>
                        <button class="layui-btn layui-btn-primary" title="反对">
                            <i class="layui-icon layui-icon-tread"></i>
                            <span>反对</span>
                        </button>
                        {{--<a class="layui-btn layui-btn-primary" title="评论">
                            <i class="layui-icon layui-icon-reply-fill"></i>
                            <span>评论</span>
                        </a>--}}
                        <button class="layui-btn layui-btn-primary" title="收藏">
                            <i class="layui-icon layui-icon-addition"></i>
                            <span>收藏</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="layui-card fly-panel">
                <div class="layui-card-header">作者信息</div>
                <div class="layui-card-body publisher_profile">
                    @if(!is_null($infoUserTopAd))
                        <div class="layui-row">
                            <div class="layui-col-sm12 ads_content">
                                {!! $infoUserTopAd->content !!}
                            </div>
                        </div>
                    @endif
                    <div class="layui-row">
                        <div class="layui-col-sm3 layui-col-xs4">
                            <div class="picture">
                                <img src="{{ asset($publisher->picture_url) }}" title="{{ $publisher->nickname }} - {{ config("comment.site_name") }}">
                            </div>
                        </div>
                        <div class="layui-col-sm6 layui-col-xs8">
                            <ul class="content_list">
                                <li class="content_item">{{ $publisher->nickname }}</li>
                                <li class="content_item">
                                    <a href="{{ route("comment.home.user.home", ['id' => $info->user_id]) }}"
                                       title="访问Ta的个人主页 - {{ config("comment.site_name") }}">访问Ta的个人主页</a>
                                </li>
                            </ul>
                        </div>
                        <div class="layui-col-sm2">
                            <button class="follow layui-btn layui-btn-warm">+ 关注 Ta</button>
                        </div>
                    </div>
                    <div class="layui-row">
                        <div class="layui-col-sm12 layui-col-xs12">
                            <ul class="list">
                                @foreach($userContents as $userContent)
                                    <li class="item item_ellipsis">
                                        <a href="{{ route("comment.home.content.info", ['id' => $userContent->id]) }}"
                                           title="{{ $userContent->title }} - {{ config("comment.site_name") }}">{{ $userContent->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @if(!is_null($infoUserBottomAd))
                        <div class="layui-row">
                            <div class="layui-col-sm12 ads_content">
                                {!! $infoUserBottomAd->content !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="layui-card layui-hide-xs">
                <div class="layui-card-header">
                    <span>发布评论</span>
                    <a name="publish_comment"></a>
                </div>
                <div class="layui-card-body">
                    <form class="layui-form" method="POST" action="{{ route("comment.home.content.publishSubmit") }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="parent_id" value="{{ $info->id }}">
                        <input type="hidden" name="title" id="title" value="{{ $info->title }}">
                        <div class="layui-form-item layui-form-text">
                            <textarea name="content" id="content" rows="10" placeholder="请输入评论内容" class="layui-textarea"></textarea>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn" lay-submit lay-filter="submit">立即提交</button>
                            <button type="button" class="layui-btn layui-btn-primary" id="saveTemplate">保存模板</button>
                            <button type="button" class="layui-btn layui-btn-primary" id="loadTemplate">加载模板</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(!is_null($infoBottomAd))
        <div class="layui-row">
            <div class="layui-col-sm12 ads_content">
                {!! $infoBottomAd->content !!}
            </div>
        </div>
    @endif
@endsection

@section("footer")
    <script>
        /*设置模块入口并加载后台公共模块*/
        layui.extend({
            wangeditor:'/wang/wangeditor.min',
        });
        layui.use(['form', 'element', "wangeditor"], function(){
            var $ = layui.$;
            var form = layui.form;
            var element = layui.element;
            var layer = layui.layer;

            var wang = layui.wangeditor('content');
            wang.create();

            //监听提交
            form.on('submit(submit)', function(data){
                return true;
            });
            $(document).on("click", '#saveTemplate', function(e){
                e.preventDefault();
                var data = $(this).parents("form").serializeArray();
                data = data.splice(2, data.length-1);
                localStorage.setItem("comment_content_template", JSON.stringify(data));
                layer.msg("模板保存成功");
                return true;
            });
            $(document).on('click', '#loadTemplate', function(e){
                e.preventDefault();
                var data = localStorage.getItem("comment_content_template");
                if (data !== null) {
                    data = JSON.parse(data);
                    for(var i = 0; i < data.length; i++) {
                        var selector = $("#"+data[i].name);
                        if (selector.prop("tagName") === "INPUT") {
                            $("#"+data[i].name).val(data[i].value);
                        }else if(selector.prop("tagName") === "TEXTAREA") {
                            wang.txt.$txt.html(data[i].value);
                        }
                    }
                    layer.msg("模板加载完成");
                }else {
                    layer.msg("暂无模板");
                }
                return true;
            });
        });
    </script>
@endsection
