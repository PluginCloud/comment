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
                      <a><cite>发布广告</cite></a>
                    </span>
                </div>
            </div>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" method="POST" action="{{ $submitUrl }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $info->id ?? '' }}">
                <div class="layui-collapse">
                    <div class="layui-colla-item">
                        <h2 class="layui-colla-title">发布广告</h2>
                        <div class="layui-colla-content layui-show">
                            @if ($errors->any())
                                <blockquote class="layui-elem-quote">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                        <hr>
                                    @endforeach
                                </blockquote>
                            @endif
                            @if (session()->has("user_ad_publish_ok"))
                                <blockquote class="layui-elem-quote">
                                    发布成功
                                </blockquote>
                            @endif
                            @if (session()->has("user_ad_edit_ok"))
                                <blockquote class="layui-elem-quote">
                                    更新成功
                                </blockquote>
                            @endif
                            <div class="layui-form-item">
                                <label class="layui-form-label">位置</label>
                                <div class="layui-input-block">
                                    <select name="place_code" lay-verify="required">
                                        <option value="">请选择</option>
                                        <option value="info_left" @if(isset($info) && $info->place_code == "info_left") selected @endif>详情左边</option>
                                        <option value="info_right" @if(isset($info) && $info->place_code == "info_right") selected @endif>详情右边</option>
                                        <option value="info_top" @if(isset($info) && $info->place_code == "info_top") selected @endif>详情顶部</option>
                                        <option value="info_bottom" @if(isset($info) && $info->place_code == "info_bottom") selected @endif>详情底部</option>
                                        <option value="info_content_top" @if(isset($info) && $info->place_code == "info_content_top") selected @endif>详情内容顶部</option>
                                        <option value="info_content_bottom" @if(isset($info) && $info->place_code == "info_content_bottom") selected @endif>详情内容底部</option>
                                        <option value="info_user_top" @if(isset($info) && $info->place_code == "info_user_top") selected @endif>详情用户顶部</option>
                                        <option value="info_user_bottom" @if(isset($info) && $info->place_code == "info_user_bottom") selected @endif>详情用户底部</option>
                                        <option value="info_comments_top" @if(isset($info) && $info->place_code == "info_comments_top") selected @endif>详情评论顶部</option>
                                        <option value="info_comments_bottom" @if(isset($info) && $info->place_code == "info_comments_bottom") selected @endif>详情评论底部</option>
                                        <option value="user_home_user_top" @if(isset($info) && $info->place_code == "user_home_user_top") selected @endif>个人主页用户顶部</option>
                                        <option value="user_home_user_bottom" @if(isset($info) && $info->place_code == "user_home_user_bottom") selected @endif>个人主页用户底部</option>
                                        <option value="user_home_contents_top" @if(isset($info) && $info->place_code == "user_home_contents_top") selected @endif>个人主页内容顶部</option>
                                        <option value="user_home_contents_bottom" @if(isset($info) && $info->place_code == "user_home_contents_bottom") selected @endif>个人主页内容底部</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">代码</label>
                                <div class="layui-input-block">
                                    <textarea name="content" id="editor" rows="20"
                                              placeholder="请输入内容" class="layui-textarea">{{ $info->content ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">到期时间</label>
                                <div class="layui-input-block">
                                    <input type="text" name="expire_at" class="layui-input" id="expire_at" value="{{ $info->expire_at ?? '' }}">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">备注</label>
                                <div class="layui-input-block">
                                    <textarea name="remark" rows="10"
                                              placeholder="(可选)" class="layui-textarea">{{ $info->remark ?? '' }}</textarea>
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
        layui.use(['form', 'element', "wangeditor", "laydate"], function(){
            var form = layui.form;
            var element = layui.element;
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#expire_at' //指定元素
            });

            var wang = layui.wangeditor('editor');
            wang.config.jsFilter = false;
            wang.config.legalTags = 'p,h1,h2,h3,h4,h5,h6,blockquote,table,ul,ol,pre,script';
            wang.create();

            //监听提交
            form.on('submit(formDemo)', function(data){

            });
        });
    </script>
@endsection
