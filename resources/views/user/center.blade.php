@extends("comment.layout.main")
@section("title", "个人中心")
@php($is_show_site_name = true)
@section("content")
    <div class="layui-card fly-panel">
        <div class="layui-card-body">
            <div class="profile_picture">
                <a href="{{ config("comment.site_count_url") }}" target="_blank">
                    <img src="{{ url($user->picture) }}">
                </a>
            </div>
            <hr class="layui-bg-gray">
            <div class="layui-row profile fly-panel">
                <div class="layui-col-lg3 layui-col-xs3 item">
                    <span class="layui-hide-xs">用户名:</span>
                    <span style="color: #FFB800;">{{ $user->username }}</span>
                </div>
                <div class="layui-col-lg3 layui-col-xs3 item">
                    <span>内容数:</span>
                    <span>{{ $content_count }}</span>
                </div>
                <div class="layui-col-lg3 layui-col-xs3 item">
                    <span>评论数:</span>
                    <span>{{ $comment_count }}</span>
                </div>
                <div class="layui-col-lg3 layui-col-xs3 item">
                    <span>广告数:</span>
                    <span>{{ $ad_count }}</span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="layui-row action">
                <div class="layui-col-lg3 layui-col-xs3 item">
                    <a class="layui-btn layui-btn-primary" href="{{ route("comment.home.user.profile") }}">修改资料</a>
                </div>
                <div class="layui-col-lg3 layui-col-xs3 item">
                    <a class="layui-btn layui-btn-primary" href="{{ route("comment.home.user.password") }}">修改密码</a>
                </div>
                <div class="layui-col-lg3 layui-col-xs3 item">
                    <a class="layui-btn layui-btn-primary" href="{{ route("comment.home.content.publish") }}">发布内容</a>
                </div>
                <div class="layui-col-lg3 layui-col-xs3 item">
                    <a class="layui-btn layui-btn-primary" href="{{ route("comment.home.user_ad.publish") }}">发布广告</a>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-card fly-panel">
        <div class="layui-card-body">
            <div class="layui-collapse">
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">我的广告</h2>
                    <div class="layui-colla-content layui-show">
                        @foreach($ads as $ad)
                            <div class="center_content_item">
                                <div class="layui-row">
                                    <div class="layui-col-sm4 layui-col-xs3">
                                        <span class="title" style="@if($ad->is_online == 0) text-decoration: line-through;color: #FF5722; @endif">
                                            @if($ad->place_code == "info_left")
                                                详情左边
                                            @elseif($ad->place_code == "info_right")
                                                详情右边
                                            @elseif($ad->place_code == "info_top")
                                                详情顶部
                                            @elseif($ad->place_code == "info_bottom")
                                                详情底部
                                            @elseif($ad->place_code == "info_content_top")
                                                详情内容顶部
                                            @elseif($ad->place_code == "info_content_bottom")
                                                详情内容底部
                                            @elseif($ad->place_code == "info_user_top")
                                                详情用户顶部
                                            @elseif($ad->place_code == "info_user_bottom")
                                                详情用户底部
                                            @elseif($ad->place_code == "info_comments_top")
                                                详情评论顶部
                                            @elseif($ad->place_code == "info_comments_bottom")
                                                详情评论底部
                                            @elseif($ad->place_code == "user_home_user_top")
                                                个人主页用户顶部
                                            @elseif($ad->place_code == "user_home_user_bottom")
                                                个人主页用户底部
                                            @elseif($ad->place_code == "user_home_contents_top")
                                                个人主页内容顶部
                                            @elseif($ad->place_code == "user_home_contents_bottom")
                                                个人主页内容底部
                                            @else
                                                异常
                                            @endif
                                        </span>
                                    </div>
                                    <div class="layui-col-sm2 layui-col-xs5">{{ $ad->expire_at }}</div>
                                    <div class="layui-col-sm4 layui-hide-xs">{{ $ad->remark }}</div>
                                    <div class="layui-col-sm1 layui-col-xs2">
                                        <span class="edit">
                                            <a href="{{ route("comment.home.user_ad.edit", ['id' => $ad->id]) }}">编辑</a>
                                        </span>
                                    </div>
                                    <div class="layui-col-sm1 layui-col-xs2">
                                        <span class="edit">
                                            <a href="{{ route("comment.home.user_ad.delete", ['id' => $ad->id]) }}">删除</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($ads->hasPages())
                            {{ $ads->links("comment.layout.paginate") }}
                        @endif
                    </div>
                </div>
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">我的内容</h2>
                    <div class="layui-colla-content layui-show">
                        @foreach($contents as $content)
                            <div class="center_content_item">
                                <div class="layui-row">
                                    <div class="layui-col-sm10 layui-col-xs9">
                                        <span class="title">
                                            <a href="{{ route("comment.home.content.info", ['id' => $content->id]) }}"
                                               style="@if($content->is_online == 0) text-decoration: line-through;color: #FF5722; @endif">
                                                {{ $content->title }}
                                            </a>
                                        </span>
                                    </div>
                                    <div class="layui-col-sm1 layui-col-xs2">
                                        <span class="view">
                                            <a href="{{ route("comment.home.content.edit", ['id' => $content->id]) }}">编辑</a>
                                        </span>
                                    </div>
                                    <div class="layui-col-sm1 layui-col-xs1">
                                        <span class="edit">
                                            <a href="{{ route("comment.home.content.delete", ['id' => $content->id]) }}">删除</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($contents->hasPages())
                            {{ $contents->links("comment.layout.paginate") }}
                        @endif
                    </div>
                </div>
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">我的评论</h2>
                    <div class="layui-colla-content layui-show">
                        @foreach($comments as $comment)
                            <div class="center_content_item">
                                <div class="layui-row">
                                    <div class="layui-col-sm10 layui-col-xs9">
                                        <span class="title">
                                            <a href="{{ route("comment.home.content.info", ['id' => $comment->id]) }}"
                                               style="@if($comment->is_online == 0) text-decoration: line-through;color: #FF5722; @endif">
                                                {{ $comment->title }}
                                            </a>
                                        </span>
                                    </div>
                                    <div class="layui-col-sm1 layui-col-xs2">
                                        <span class="view">
                                            <a href="{{ route("comment.home.content.edit", ['id' => $comment->id]) }}">编辑</a>
                                        </span>
                                    </div>
                                    <div class="layui-col-sm1 layui-col-xs1">
                                        <span class="edit">
                                            <a href="{{ route("comment.home.content.delete", ['id' => $comment->id]) }}">删除</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($comments->hasPages())
                            {{ $comments->links("comment.layout.paginate") }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("footer")
    <script>
        layui.use(['element'], function(){
            var element = layui.element;
        });
    </script>
@endsection
