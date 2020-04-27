<?php


namespace PluginCloud\Comment\Http\Controllers\Home;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PluginCloud\Comment\Models\Content;
use PluginCloud\Comment\Models\User;
use PluginCloud\Comment\Models\UserAd;

class ContentController extends BaseController
{
    public function index()
    {
        $contents = Content::where("parent_id", 0)->where("status", 1)->where("is_online", 1)
            ->orderBy("id", "DESC")->paginate(20, "*", "contentPage");

        $comments = Content::where("parent_id", "<>", 0)->where("status", 1)->where("is_online", 1)
            ->orderBy("id", "DESC")->paginate(20, "*", "commentPage");
        return view("comment.index", compact("contents", "comments"));
    }

    public function contents(Request $request)
    {
        $contents = Content::where("parent_id", 0)->where("status", 1)->where("is_online", 1)
            ->orderBy("id", "DESC")->paginate(20);
        return view("comment.content.contents", compact("contents"));
    }

    public function comments(Request $request)
    {
        $comments = Content::where("parent_id", "<>", 0)->where("status", 1)->where("is_online", 1)
            ->orderBy("id", "DESC")->paginate(20);
        return view("comment.content.comments", compact("comments"));
    }

    public function info(Request $request, int $id)
    {
        $info = Content::where("id", $id)->first();
        $user = $request->session()->get("comment_user");
        $publisher = User::where("id", $info->user_id)->first();
        $infoLeftAd = UserAd::where("user_id", $info->user_id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "info_left")->orderBy(DB::raw("rand()"))->first();

        $infoRightAd = UserAd::where("user_id", $info->user_id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "info_right")->orderBy(DB::raw("rand()"))->first();

        $infoTopAd = UserAd::where("user_id", $info->user_id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "info_top")->orderBy(DB::raw("rand()"))->first();

        $infoBottomAd = UserAd::where("user_id", $info->user_id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "info_bottom")->orderBy(DB::raw("rand()"))->first();

        $infoContentTopAd = UserAd::where("user_id", $info->user_id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "info_content_top")->orderBy(DB::raw("rand()"))->first();

        $infoContentBottomAd = UserAd::where("user_id", $info->user_id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "info_content_bottom")->orderBy(DB::raw("rand()"))->first();

        $infoUserTopAd = UserAd::where("user_id", $info->user_id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "info_user_top")->orderBy(DB::raw("rand()"))->first();

        $infoUserBottomAd = UserAd::where("user_id", $info->user_id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "info_user_bottom")->orderBy(DB::raw("rand()"))->first();

        $infoCommentsTopAd = UserAd::where("user_id", $info->user_id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "info_comments_top")->orderBy(DB::raw("rand()"))->first();

        $infoCommentsBottomAd = UserAd::where("user_id", $info->user_id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "info_comments_bottom")->orderBy(DB::raw("rand()"))->first();

        $comments = Content::where("parent_id", $info->id)->where("status", 1)->where("is_online", 1)
            ->orderBy("id", "DESC")->paginate(8);

        $userContents = Content::where("user_id", $info->user_id)->where("id", "<>", $info->id)
            ->where("parent_id", 0)->where("status", 1)->where("is_online", 1)
            ->orderBy(DB::raw("rand()"))->limit(2)->get();
        return view("comment.content.info", compact(
            "info", "user", "publisher", "comments", "userContents",
            "infoLeftAd", "infoRightAd", "infoTopAd", "infoBottomAd",
            "infoContentTopAd", "infoContentBottomAd", "infoUserTopAd",
            "infoUserBottomAd", "infoCommentsTopAd", "infoCommentsBottomAd"
        ));
    }

    public function publish(Request $request)
    {
        $submitUrl = route("comment.home.content.publishSubmit");
        return view("comment.content.publish", compact("submitUrl"));
    }

    public function publishSubmit(Request $request)
    {
        $request->validate([
            'title' => 'required|string|between:2,45',
            'sub_title' => 'nullable|string|between:5,30',
            'author' => 'nullable|string|between:5,20',
            'from_name' => 'nullable|string|between:2,20',
            'from_url' => 'nullable|string|between:5,180',
            'content' => 'required|string|min:10',
            'tags' => 'nullable|string|min:2',
            'keyword' => 'nullable|string|min:2',
            'description' => 'nullable|string|min:2',
        ], [
            'title.required' => '标题不能为空',
            'title.between' => '标题长度需在2-45个字符之间',
            'sub_title.between' => '副标题长度需在5-30个字符之间',
            'author.between' => '作者长度需在5-20个字符之间',
            'from_name.between' => '来源名称长度需在2-20个字符之间',
            'from_url.between' => '来源链接长度需在5-180个字符之间',
            'content.required' => '内容不能为空',
            'content.between' => '内容长度不能少于2个字符',
            'tags.between' => '标签长度不能少于2个字符',
            'keyword.between' => '关键字字符长度不能少于2个字符',
            'description.between' => '描述长度不能少于2个字符',
        ]);
        $parentId = 0;
        $keyword = $request->input("keyword");
        $description = $request->input("description");
        if ($request->filled("parent_id") && $request->input("parent_id") != "0") {
            $parentId = $request->input("parent_id");
            $info = Content::where("id", $request->input("parent_id"))->first();
            if (!$request->filled("keyword")) {
                $keyword = $info->keyword;
            }
            if (!$request->filled("description")) {
                $description = $info->description;
            }
        }
        $isOnline = 1;
        if ($request->filled("is_online")) {
            $isOnline = $request->input("is_online");
        }
        $user = $request->session()->get("comment_user");
        $result = Content::create([
            'parent_id' => $parentId,
            'user_id' => $user->id,
            'title' => $request->input("title"),
            'sub_title' => $request->input("sub_title"),
            'author' => $request->input("author"),
            'from_name' => $request->input("from_name"),
            'from_url' => $request->input("from_url"),
            'content' => $request->input("content"),
            'tags' => $request->input("tags"),
            'keyword' => $keyword,
            'description' => $description,
            'is_online' => $isOnline,
        ]);
        if ($result) {
            return back()->with("content_publish_ok", true);
        }
        return back()->withInput($request->all())->withErrors("发布失败");
    }

    public function edit(Request $request, int $id)
    {
        $info = Content::where("id", $id)->first();
        $submitUrl = route("comment.home.content.editSubmit");
        return view("comment.content.publish", compact("info", "submitUrl"));
    }

    public function editSubmit(Request $request)
    {
        $request->validate([
            'title' => 'required|string|between:2,45',
            'sub_title' => 'nullable|string|between:5,20',
            'author' => 'nullable|string|between:5,20',
            'from_name' => 'nullable|string|between:2,20',
            'from_url' => 'nullable|string|between:5,180',
            'content' => 'required|string|min:10',
            'tags' => 'nullable|string|min:2',
            'keyword' => 'nullable|string|min:2',
            'description' => 'nullable|string|min:2',
        ], [
            'title.required' => '标题不能为空',
            'title.between' => '标题长度需在2-45个字符之间',
            'sub_title.between' => '副标题长度需在5-30个字符之间',
            'author.between' => '作者长度需在5-20个字符之间',
            'from_name.between' => '来源名称长度需在2-20个字符之间',
            'from_url.between' => '来源链接长度需在5-180个字符之间',
            'content.required' => '内容不能为空',
            'content.between' => '内容长度不能少于2个字符',
            'tags.between' => '标签长度不能少于2个字符',
            'keyword.between' => '关键字字符长度不能少于2个字符',
            'description.between' => '描述长度不能少于2个字符',
        ]);
        $parentId = 0;
        if ($request->filled("parent_id")) {
            $parentId = $request->input("parent_id");
        }
        $user = $request->session()->get("comment_user");
        $result = Content::where("id", $request->input("id"))->update([
            'parent_id' => $parentId,
            'user_id' => $user->id,
            'title' => $request->input("title"),
            'sub_title' => $request->input("sub_title"),
            'author' => $request->input("author"),
            'from_name' => $request->input("from_name"),
            'from_url' => $request->input("from_url"),
            'content' => $request->input("content"),
            'tags' => $request->input("tags"),
            'keyword' => $request->input("keyword"),
            'description' => $request->input("description"),
            'is_online' => $request->input("is_online"),
        ]);
        if ($result) {
            return back()->with("content_edit_ok", true);
        }
        return back()->withInput($request->all())->withErrors("编辑失败");
    }

    public function search(Request $request)
    {
        return view("comment.content.search");
    }

    public function delete(Request $request, int $id)
    {
        $user = $request->session()->get("comment_user");
        $info = Content::where("id", $id)->where("user_id", $user->id)->first();
        $info->delete();
        if ($info->trashed()) {
            return back();
        }
        return back();
    }

    public function storeTemplate(Request $request)
    {

    }
}
