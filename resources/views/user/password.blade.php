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
                      <a><cite>修改密码</cite></a>
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
                            @if (session("password_update_ok"))
                                <blockquote class="layui-elem-quote">
                                    修改成功
                                </blockquote>
                            @endif
                            @if (session("password_update_fail"))
                                <blockquote class="layui-elem-quote">
                                    修改失败
                                </blockquote>
                            @endif
                            @if (session("old_password_error"))
                                <blockquote class="layui-elem-quote">
                                    旧密码错误
                                </blockquote>
                            @endif
                            <form class="layui-form layui-form-pane" method="POST" action="{{ route("comment.home.user.passwordSubmit") }}">
                                {{ csrf_field() }}
                                <div class="layui-form-item">
                                    <label class="layui-form-label">旧密码</label>
                                    <div class="layui-input-inline">
                                        <input type="password" name="old_password" required="" lay-verify="required" placeholder="请输入旧密码"
                                               autocomplete="off" class="layui-input" value="{{ old("old_password") }}">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">必填</div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">新密码</label>
                                    <div class="layui-input-inline">
                                        <input type="password" name="password" required="" lay-verify="required" placeholder="请输入新密码"
                                               autocomplete="off" class="layui-input" value="{{ old("password") }}">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">必填</div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">确认密码</label>
                                    <div class="layui-input-inline">
                                        <input type="password" name="password_confirmation" required="" lay-verify="required" placeholder="请输入确认密码"
                                               autocomplete="off" class="layui-input" value="{{ old("password_confirmation") }}">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">必填</div>
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
        layui.use(['form', 'element'], function(){
            var form = layui.form;
            var element = layui.element;
            //监听提交
            form.on('submit(formDemo)', function(data){
                return true;
            });
        });
    </script>
@endsection
