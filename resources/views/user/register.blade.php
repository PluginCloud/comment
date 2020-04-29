@extends("comment.layout.main")
@section("title", "用户注册")
@php($is_show_site_name = true)
@section("content")
    <div class="layui-card fly-panel">
        <div class="layui-card-body">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <li>
                        <a href="{{ route("comment.home.user.login") }}">登录</a>
                    </li>
                    <li class="layui-this">注册</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-card">
                            <div class="layui-card-body">
                                @if(config("comment.enable_register"))
                                    @if ($errors->any())
                                        <blockquote class="layui-elem-quote">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                                <hr>
                                            @endforeach
                                        </blockquote>
                                    @endif
                                    @if (session("register_success"))
                                        <blockquote class="layui-elem-quote">
                                            注册成功，3秒后跳转至登录页面，<a href="{{ route("comment.home.user.login") }}">直接跳转</a>
                                        </blockquote>
                                        <script>
                                            setTimeout(function () {
                                                window.location.href = "{{ route("comment.home.user.login") }}"
                                            }, 3000)
                                        </script>
                                    @endif
                                    <form class="layui-form layui-form-pane" action="{{ route("comment.home.user.registerSubmit") }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">用户名</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="username" required="" lay-verify="required" placeholder="请输入用户名"
                                                       autocomplete="off" class="layui-input" value="{{ old("username") }}">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">字母和数字的结合，长度3-9</div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">昵称</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="nickname" required="" lay-verify="required" placeholder="请输入用户名"
                                                       autocomplete="off" class="layui-input" value="{{ old("nickname") }}">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">任意字符，2-15个字符</div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">密码</label>
                                            <div class="layui-input-inline">
                                                <input type="password" name="password" required="" lay-verify="required" placeholder="请输入密码"
                                                       autocomplete="off" class="layui-input" value="{{ old("password") }}">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">任意字符，6-15个字符</div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">确认密码</label>
                                            <div class="layui-input-inline">
                                                <input type="password" name="password_confirmation" required="" lay-verify="required" placeholder="请输入确认密码"
                                                       autocomplete="off" class="layui-input" value="{{ old("password_confirmation") }}">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux"></div>
                                        </div>
                                        <div class="layui-form-item">
                                            <div class="layui-input-inline" style="width: 130px;">
                                                <input type="checkbox" name="read_service" title="我已阅读并同意" lay-skin="primary">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">《<a href="">用户服务条款</a>》</div>
                                        </div>
                                        <div class="layui-form-item">
                                            <button class="layui-btn" lay-submit="" lay-filter="formDemoPane">注册</button>
                                        </div>
                                    </form>
                                @else
                                    <div class="center">网站管理员未开启网站注册功能...</div>
                                @endif
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
