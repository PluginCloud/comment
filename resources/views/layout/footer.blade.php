<div class="layui-col-sm2 layui-hide-xs">
    <div style="margin-top: 100px"></div>
</div>
<div class="layui-col-sm8 layui-col-xs12">
    <div class="layui-row">
        {{--<div class="layui-col-sm3 layui-col-xs3">
            <h3 class="center">常见问题</h3>
            <ul class="center footer_ul">
                <li>
                    <a href="">如何发布内容</a>
                </li>
                <li>
                    <a href="">广告收入是什么</a>
                </li>
                <li>
                    <a href="">账号相关</a>
                </li>
            </ul>
        </div>
        <div class="layui-col-sm3 layui-col-xs3">
            <h3 class="center">关于我们</h3>
            <ul class="center footer_ul">
                <li>
                    <a href="">关于{{ config("comment.site_name") }}</a>
                </li>
                <li>
                    <a href="">联系我们</a>
                </li>
                <li>
                    <a href="">免责声明</a>
                </li>
            </ul>
        </div>--}}
        <div class="layui-col-sm3 layui-col-xs3 layui-col-sm-offset6 layui-col-xs-offset6">
            <h3 class="center">订阅</h3>
            <ul class="center footer_ul">
                <li>
                    <a href="{{ public_path("sitemap.xml") }}">网站地图</a>
                </li>
                @if(!is_null(config("feed.feeds")))
                    @foreach(config("feed.feeds") as $feed)
                        <li>
                            <a href="{{ $feed['url'] }}">{{ $feed['title'] }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="layui-col-sm3 layui-col-xs3">
            <h3 class="center">友情链接</h3>
            <ul class="center footer_ul">
                <li>
                    <a href="http://vip.myfirstgroup.xyz">无她影院</a>
                </li>
                <li>
                    <a href="https://www.baidu.com">百度一下</a>
                </li>
                <li>
                    <a href="https://www.google.com">谷歌搜索</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="layui-col-sm2 layui-hide-xs">
    <div style="margin-top: 100px"></div>
</div>
