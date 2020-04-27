@extends("comment.layout.main")
@section("title", "用户登录")
@php($is_show_site_name = true)
@section("content")
    <div class="layui-card fly-panel">
        <div class="layui-card-body">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <li class="layui-this">登录</li>
                    <li>
                        <a href="{{ route("comment.home.user.register") }}">注册</a>
                    </li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-card">
                            <div class="layui-card-body">
                                @if ($errors->any())
                                    <blockquote class="layui-elem-quote">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                            <hr>
                                        @endforeach
                                    </blockquote>
                                @endif
                                @if (session("login_success"))
                                    <blockquote class="layui-elem-quote">
                                        登录成功，3秒后跳转至个人中心页面，<a href="{{ route("comment.home.user.center") }}">直接跳转</a>
                                    </blockquote>
                                    <script>
                                        setTimeout(function () {
                                            window.location.href = "{{ route("comment.home.user.center") }}"
                                        }, 3000)
                                    </script>
                                @endif
                                <form class="layui-form layui-form-pane" action="{{ route("comment.home.user.loginSubmit") }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">用户名</label>
                                        <div class="layui-input-inline">
                                            <input type="text" name="username" required="" lay-verify="required" placeholder="请输入用户名"
                                                   autocomplete="off" class="layui-input" value="{{ old("username") }}">
                                        </div>
                                        <div class="layui-form-mid layui-word-aux">辅助文字</div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">密码</label>
                                        <div class="layui-input-inline">
                                            <input type="password" name="password" required="" lay-verify="required" placeholder="请输入密码"
                                                   autocomplete="off" class="layui-input" value="{{ old("password") }}">
                                        </div>
                                        <div class="layui-form-mid layui-word-aux">辅助文字</div>
                                    </div>
                                    <div class="layui-form-item">
                                        <button class="layui-btn" lay-submit="" lay-filter="formDemoPane">登录</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("footer")
    <script>
        layui.use('form', function(){
            var form = layui.form;
        });
    </script>
@endsection
