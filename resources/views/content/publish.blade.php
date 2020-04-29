@extends("comment.layout.main")
@section("title", "发布内容")
@php($is_show_site_name = true)
@section("content")
    <link rel="stylesheet" href="{{ asset("wang/wangeditor.css") }}">
    <div class="layui-card fly-panel">
        <div class="layui-card-header">
            <div class="layui-row">
                <div class="layui-col-sm12">
                    <span class="layui-breadcrumb" lay-separator="/">
                      <a href="{{ route("comment.home.user.center") }}">个人中心</a>
                      <a><cite>发布内容</cite></a>
                    </span>
                </div>
            </div>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" method="POST" action="{{ $submitUrl }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $info->id ?? '' }}">
                <input type="hidden" name="parent_id" value="{{ $info->parent_id  ?? '0' }}">
                <div class="layui-collapse">
                    <div class="layui-colla-item">
                        <h2 class="layui-colla-title">内容</h2>
                        <div class="layui-colla-content layui-show">
                            @if ($errors->any())
                                <blockquote class="layui-elem-quote">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                        <hr>
                                    @endforeach
                                </blockquote>
                            @endif
                            @if (session()->has("content_publish_ok"))
                                <blockquote class="layui-elem-quote">
                                    发布成功
                                </blockquote>
                            @endif
                            @if (session()->has("content_edit_ok"))
                                <blockquote class="layui-elem-quote">
                                    更新成功
                                </blockquote>
                            @endif
                            <div class="layui-form-item">
                                <label class="layui-form-label">标题</label>
                                <div class="layui-input-block">
                                    <input type="text" name="title" required  lay-verify="required"
                                           placeholder="请输入标题" autocomplete="off" class="layui-input"
                                           value="{{ old("title", $info->title ?? '') }}">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">副标题</label>
                                <div class="layui-input-block">
                                    <input type="text" name="sub_title"
                                           placeholder="(可选)" autocomplete="off"class="layui-input"
                                           value="{{ old("sub_title", $info->sub_title ?? '') }}">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">作者</label>
                                <div class="layui-input-block">
                                    <input type="text" name="author"
                                           placeholder="(可选)" autocomplete="off" class="layui-input"
                                           value="{{ old("author", $info->author ?? '') }}">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">来源</label>
                                <div class="layui-input-block">
                                    <input type="text" name="from_name"
                                           placeholder="(可选)" autocomplete="off" class="layui-input"
                                           value="{{ old("from_name", $info->from_name ?? '') }}">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">来源链接</label>
                                <div class="layui-input-block">
                                    <input type="text" name="from_url"
                                           placeholder="(可选)" autocomplete="off" class="layui-input"
                                           value="{{ old("from_url", $info->from_url ?? '') }}">
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">内容</label>
                                <div class="layui-input-block">
                                    <textarea name="content" id="editor" rows="40"
                                              placeholder="请输入内容" class="layui-textarea">{{ old("content", $info->content ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">上线</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="is_online" value="1"
                                           title="是" @if((isset($info) && $info->is_online == "1") || !isset($info)) checked @endif>
                                    <input type="radio" name="is_online" value="0"
                                           title="否" @if((isset($info) && $info->is_online == "0")) checked @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-colla-item">
                        <h2 class="layui-colla-title">SEO</h2>
                        <div class="layui-colla-content">
                            <div class="layui-form-item">
                                <label class="layui-form-label">关键字</label>
                                <div class="layui-input-block">
                                    <input type="text" name="keyword"
                                           placeholder="(可选)" autocomplete="off" class="layui-input"
                                           value="{{ old("keyword", $info->keyword ?? '') }}">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">简介</label>
                                <div class="layui-input-block">
                                    <textarea name="description" class="layui-textarea" rows="10"
                                              placeholder="(可选)">{{ old("description", $info->description ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("footer")
    <script>
        /*设置模块入口并加载后台公共模块*/
        layui.extend({
            wangeditor:'/wang/wangeditor.min',
        });
        layui.use(['form', 'element', "wangeditor"], function(){
            var form = layui.form;
            var element = layui.element;

            var wang = layui.wangeditor('editor');
            wang.create();

            //监听提交
            form.on('submit(formDemo)', function(data){

            });
        });
    </script>
@endsection
