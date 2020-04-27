@extends("comment.layout.main")
@section("title", "修改资料")
@php($is_show_site_name = true)
@section("content")
    <div class="layui-card fly-panel">
        <div class="layui-card-header">
            <div class="layui-row">
                <div class="layui-col-sm12">
                    <span class="layui-breadcrumb" lay-separator="/">
                      <a href="{{ route("comment.home.user.center") }}">个人中心</a>
                      <a><cite>修改资料</cite></a>
                    </span>
                </div>
            </div>
        </div>
        <div class="layui-card-body">
            <div class="layui-row">
                <div class="layui-col-sm12">
                    <div class="layui-row">
                        <div class="layui-col-sm4">
                            @if ($errors->any())
                                <blockquote class="layui-elem-quote">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                        <hr>
                                    @endforeach
                                </blockquote>
                            @endif
                            @if (session("profile_update_ok"))
                                <blockquote class="layui-elem-quote">
                                    修改成功
                                </blockquote>
                            @endif
                            @if (session("profile_update_fail"))
                                <blockquote class="layui-elem-quote">
                                    修改失败
                                </blockquote>
                            @endif
                            <form class="layui-form layui-form-pane" method="POST" action="{{ route("comment.home.user.profileSubmit") }}">
                                {{ csrf_field() }}
                                <div class="layui-form-item center">
                                    <img src="{{ url($info->picture_url) }}" id="picture" style="width: 100px;border-radius: 50%;">
                                    <input type="hidden" name="picture_url" id="picture_url" value="{{ $info->picture_url }}">
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">用户名</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="username" required="" lay-verify="required" placeholder="请输入用户名"
                                               autocomplete="off" class="layui-input" value="{{ $info->username }}">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">必填</div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">昵称</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="nickname" required="" lay-verify="required" placeholder="请输入昵称"
                                               autocomplete="off" class="layui-input" value="{{ $info->nickname }}">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">必填</div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">邮箱</label>
                                    <div class="layui-input-inline">
                                        <input type="email" name="email" placeholder="请输入邮箱"
                                               autocomplete="off" class="layui-input" value="{{ $info->email }}">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">选填</div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">手机号码</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="mobile" placeholder="请输入手机号码"
                                               autocomplete="off" class="layui-input" value="{{ $info->mobile }}">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">选填</div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">性别</label>
                                    <div class="layui-input-inline">
                                        <input type="radio" name="sex" value="1" title="男" @if($info->sex == 1) checked @endif>
                                        <input type="radio" name="sex" value="2" title="女" @if($info->sex == 2) checked @endif>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">必填</div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">生日</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="birthday" placeholder="请输入生日"
                                               autocomplete="off" class="layui-input" value="{{ $info->birthday }}">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">选填</div>
                                </div>
                                <div class="layui-form-item">
                                    <button class="layui-btn" lay-submit="" lay-filter="formDemoPane">确认修改</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("footer")
    <script>
        layui.use(['form', 'upload', 'element'], function(){
            var $ = layui.$;
            var form = layui.form;
            var element = layui.element;
            //监听提交
            form.on('submit(formDemo)', function(data){
                return true;
            });
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#picture'
                ,url: '{{ route("comment.home.user.pictureUpload") }}'
                ,accept: "images"
                ,acceptMime: "image/*"
                ,size: 240
                ,field: "picture"
                ,headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"}
                ,done: function(res){
                    console.log(res)
                    $("#picture").prop("src", res.data.src);
                    $("#picture_url").val(res.data.key);
                }
                ,error: function(){
                    //请求异常回调
                }
            });
        });
    </script>
@endsection
