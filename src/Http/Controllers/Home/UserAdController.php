<?php


namespace PluginCloud\Comment\Http\Controllers\Home;


use Illuminate\Http\Request;
use PluginCloud\Comment\Models\UserAd;

class UserAdController extends BaseController
{
    public function publish()
    {
        $submitUrl = route("comment.home.user_ad.publishSubmit");
        return view("comment.user_ad.publish", compact("submitUrl"));
    }

    public function publishSubmit(Request $request)
    {
        $user = $request->session()->get("comment_user");
        $result = UserAd::create([
            'user_id' => $user->id,
            'type' => 0,
            'place_code' => $request->input("place_code"),
            'content' => $request->input("content"),
            'expire_at' => $request->input("expire_at"),
            'remark' => $request->input("remark"),
            'is_online' => $request->input("is_online"),
        ]);
        if ($result) {
            return back()->withInput($request->all())->with("user_ad_publish_ok", true);
        }
        return back()->withInput($request->all())->withErrors("添加失败");
    }

    public function edit(Request $request, int $id)
    {
        $submitUrl = route("comment.home.user_ad.editSubmit");
        $info = UserAd::where("id", $id)->first();
        return view("comment.user_ad.publish", compact("submitUrl", "info"));
    }

    public function editSubmit(Request $request)
    {
        $user = $request->session()->get("comment_user");
        $result = UserAd::where("user_id", $user->id)->where("id", $request->input("id"))->update([
            'type' => 0,
            'place_code' => $request->input("place_code"),
            'content' => $request->input("content"),
            'expire_at' => $request->input("expire_at"),
            'remark' => $request->input("remark"),
            'is_online' => $request->input("is_online"),
        ]);
        if ($result) {
            return back()->withInput($request->all())->with("user_ad_edit_ok", true);
        }
        return back()->withInput($request->all())->withErrors("更新失败");
    }

    public function delete(Request $request, int $id)
    {
        $user = $request->session()->get("comment_user");
        $info = UserAd::where("id", $id)->where("user_id", $user->id)->first();
        $info->delete();
        if ($info->trashed()) {
            return back();
        }
        return back();
    }
}
