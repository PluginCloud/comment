<div class="header layui-bg-black">
    <div class="layui-row">
        <div class="layui-col-sm2 layui-col-md2 layui-col-lg2 layui-hide-xs">
            <div style="padding-top: 10px"></div>
        </div>
        <div class="layui-col-sm8 layui-col-md8 layui-col-lg8 layui-col-xs12">
            <div class="layui-row">
                <div class="layui-col-sm8 layui-col-md6 layui-col-lg9 layui-col-xs6">
                    <ul class="layui-nav" lay-filter="">
                        <li class="layui-nav-item @if(request()->route()->named("comment.home.content.index")) layui-this @endif">
                            <a href="{{ route("comment.home.content.index") }}">首页</a>
                        </li>
                        <li class="layui-nav-item @if(request()->route()->named("comment.home.content.contents")) layui-this @endif">
                            <a href="{{ route("comment.home.content.contents") }}">文章</a>
                        </li>
                        <li class="layui-nav-item layui-hide-xs @if(request()->route()->named("comment.home.content.comments")) layui-this @endif">
                            <a href="{{ route("comment.home.content.comments") }}">评论</a>
                        </li>
                    </ul>
                </div>
                <div class="layui-col-sm2 layui-col-md2 layui-col-lg1 layui-hide-xs">
                    <ul class="layui-nav" lay-filter="">
                        <li class="layui-nav-item @if(request()->route()->named("comment.home.content.search")) layui-this @endif">
                            <a href="{{ route("comment.home.content.search") }}">
                                <i class="layui-icon layui-icon-search"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="layui-col-sm2 layui-col-md4 layui-col-lg2 layui-col-xs6 right">
                    <ul class="layui-nav" lay-filter="">
                        @if(session()->has("comment_user"))
                            <li class="layui-nav-item @if(request()->route()->named("comment.home.user.center")) layui-this @endif">
                                <a href="{{ route("comment.home.user.center") }}">我的</a>
                            </li>
                            <li class="layui-nav-item @if(request()->route()->named("comment.home.user.logout")) layui-this @endif">
                                <a href="{{ route("comment.home.user.logout") }}">退出</a>
                            </li>
                        @else
                            <li class="layui-nav-item @if(request()->route()->named("comment.home.user.login")) layui-this @endif">
                                <a href="{{ route("comment.home.user.login") }}">登录</a></li>
                            <li class="layui-nav-item @if(request()->route()->named("comment.home.user.register")) layui-this @endif">
                                <a href="{{ route("comment.home.user.register") }}">注册</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="layui-col-sm2 layui-col-md2 layui-col-lg2 layui-hide-xs">
            <div style="padding-top: 10px"></div>
        </div>
    </div>
</div>
