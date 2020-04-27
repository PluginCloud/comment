@extends("comment.layout.main")
@section("title", "搜索")
@php($is_show_site_name = true)
@section("content")
    <div class="layui-row">
        <div class="layui-col-sm12 layui-col-xs12 fly-panel search_panel">
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">搜索引擎</label>
                    <div class="layui-input-block">
                        <select name="search_type" lay-verify="required">
                            <option value=""></option>
                            <option value="https://www2.bing.com/search?q=">必应搜索</option>
                            <option value="https://www.baidu.com/s?wd=">百度搜索</option>
                            <option value="https://www.so.com/s?q=">360搜索</option>
                            <option value="https://www.google.com/search?q=">谷歌搜索</option>
                            {{--<option value="3">神马搜索</option>--}}

                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">关键字</label>
                    <div class="layui-input-block">
                        <input type="text" name="keyword" required  lay-verify="required" placeholder="请输入关键字" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo">立即搜索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("footer")
    <script>
        //Demo
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(formDemo)', function(data){
                var searchUrl = data.field.search_type+"site:{{ config("comment.domain") }} "+data.field.keyword;
                window.open(searchUrl);
                return false;
            });
        });
    </script>
@endsection
