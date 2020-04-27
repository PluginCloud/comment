@extends("comment.layout.main")
@section("title", $info->title)
@section("keywords", $info->keyword)
@section("description", $info->description)
@php($is_show_site_name = true)

@section("header")
    <link rel="stylesheet" href="{{ asset("wang/wangeditor.css") }}">
@endsection

@section("content")
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
                <div class="layui-col-sm11 layui-col-xs12">
                    <div class="info_title">{{ $info->title }}</div>
                </div>
                <div class="layui-col-sm1  layui-hide-xs">
                    @if(!is_null($user) && $info->user_id === $user->id)
                        <a href="{{ route("comment.home.content.edit", ['id' => $info->id]) }}" class="layui-btn">编辑<span class="layui-badge-dot"></span></a>
                    @endif
                </div>
            </div>
            <div class="layui-row">
                {!! $info->content !!}
            </div>
            @if(!is_null($infoContentBottomAd))
                <div class="layui-row">
                    <div class="layui-col-sm12 ads_content">
                        {!! $infoContentBottomAd->content !!}
                    </div>
                </div>
            @endif
        </div>
        <div class="info_other">
            <div class="tags">
                <span>标签：</span>
                <span>{{ $info->tags }}</span>
            </div>
            <div class="info_time layui-bg-cyan">
                <span>发布时间：</span>
                <span>{{ $info->created_at }}</span>
            </div>
        </div>
    </div>
    <div class="layui-card">
        <div class="layui-card-body publisher_profile">
            @if(!is_null($infoUserTopAd))
                <div class="layui-row">
                    <div class="layui-col-sm12 ads_content">
                        {!! $infoUserTopAd->content !!}
                    </div>
                </div>
            @endif
            <div class="layui-row">
                <div class="layui-col-sm1 layui-col-xs4">
                    <div class="picture">
                        <img src="{{ asset($publisher->picture_url) }}" title="{{ $publisher->nickname }} - {{ config("comment.site_name") }}">
                    </div>
                </div>
                <div class="layui-col-sm3 layui-col-xs8">
                    <ul class="content_list">
                        <li class="content_item">{{ $publisher->nickname }}</li>
                        <li class="content_item">
                            <a href="{{ route("comment.home.user.home", ['id' => $info->user_id]) }}"
                               title="访问Ta的个人主页 - {{ config("comment.site_name") }}">访问Ta的个人主页</a>
                        </li>
                    </ul>
                </div>
                <div class="layui-col-sm7 layui-col-sm-offset1 layui-col-xs12">
                    <ul class="content_list">
                        @foreach($userContents as $userContent)
                            <li class="content_item">
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
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="layui-collapse">
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">发布评论</h2>
                    <div class="layui-colla-content layui-show">
                        <form class="layui-form" method="POST" action="{{ route("comment.home.content.publishSubmit") }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="parent_id" value="{{ $info->id }}">
                            <div class="layui-form-item">
                                <label class="layui-form-label">标题</label>
                                <div class="layui-input-block">
                                    <input type="text" name="title" required  lay-verify="required" id="title"
                                           placeholder="请输入标题" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">副标题</label>
                                <div class="layui-input-block">
                                    <input type="text" name="sub_title" id="sub_title"
                                           placeholder="(可选)" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">内容</label>
                                <div class="layui-input-block">
                                    <textarea name="content" id="content" rows="10" placeholder="请输入内容" class="layui-textarea"></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">标签</label>
                                <div class="layui-input-block">
                                    <input type="text" name="tags" id="tags"
                                           placeholder="(可选)" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="submit">立即提交</button>
                                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                    <button type="button" class="layui-btn layui-btn-primary" id="saveTemplate">保存模板</button>
                                    <button type="button" class="layui-btn layui-btn-primary" id="loadTemplate">加载模板</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">历史评论</h2>
                    <div class="layui-colla-content layui-show">
                        <div class="layui-card">
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
                                @if(!is_null($infoCommentsBottomAd))
                                    <div class="layui-row">
                                        <div class="layui-col-sm12 ads_content">
                                            {!! $infoCommentsBottomAd->content !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if($comments->hasPages())
                                <div class="layui-card-footer">
                                    {{ $comments->links("comment.layout.paginate", ["paginate" => $comments]) }}
                                </div>
                            @endif
                        </div>
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
    </div>
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
