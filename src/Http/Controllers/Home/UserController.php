<?php


namespace PluginCloud\Comment\Http\Controllers\Home;


use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PluginCloud\Comment\Models\Content;
use PluginCloud\Comment\Models\User;
use PluginCloud\Comment\Models\UserAd;

class UserController extends BaseController
{
    public function login()
    {
        return view("comment.user.login");
    }

    public function register()
    {
        return view("comment.user.register");
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'username' => 'required|alpha_num|between:3,9',
            'password' => 'required',
        ], [
            'username.required' => '邮箱不能为空',
            'username.alpha_num' => '用户名格式错误',
            'username.between' => '用户名格式错误',
            'password.required' => '密码不能为空',
        ]);
        $info = User::where("username", $request->input("username"))->first();
        if (is_null($info)) {
            return redirect()->back()->withInput($request->all())->withErrors("该账号不存在");
        }else{
            if (Hash::check($request->input("password"), $info->password)) {
                $user = new \stdClass();
                $user->id = $info->id;
                $user->username = $info->username;
                $user->nickname = $info->nickname;
                $user->picture = $info->picture_url;
                $request->session()->put("comment_user", $user);
                return redirect()->route("comment.home.user.center");
            }else {
                return redirect()->back()->withInput($request->all())->withErrors("密码错误");
            }
        }
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'username' => 'required|alpha_num|between:3,9',
            'nickname' => 'required|string|between:2,15',
            'password' => 'required|string|between:6,15|confirmed',
            'read_service' => 'required|accepted',
        ], [
            'username.required' => '用户名不能为空',
            'username.alpha_num' => '用户名格式错误',
            'username.between' => '用户名格式错误',
            'nickname.required' => '昵称不能为空',
            'nickname.string' => '昵称格式错误',
            'nickname.between' => '昵称格式错误',
            'password.required' => '密码不能为空',
            'password.string' => '密码格式错误',
            'password.between' => '密码格式错误',
            'password.confirmed' => '确认密码不一致',
            'read_service.required' => '请勾选阅读服务条款',
            'read_service.accepted' => '请勾选阅读服务条款',
        ]);
        $info = User::where("username", $request->input("username"))->first();
        if (!is_null($info)) {
            return redirect()->back()->withInput($request->all())->withErrors("用户已被注册");
        }else{
            $result = User::create([
                "username" => $request->input("username"),
                "nickname" => $request->input("nickname"),
                "password" => bcrypt($request->input("password")),
                "picture_url" => "/image/default_picture.jpeg"
            ]);
            if ($result) {
                return redirect()->back()->withInput($request->all())->with("register_success", "ok");
            }else {
                return redirect()->back()->withInput($request->all())->withErrors("注册失败");
            }
        }
    }

    public function center(Request $request)
    {
        $user = $request->session()->get("comment_user");
        $content_count = Content::where("user_id", $user->id)->where("parent_id", 0)->count();
        $comment_count = Content::where("user_id", $user->id)->where("parent_id", "<>", 0)->count();
        $contents = Content::where("user_id", $user->id)->where("parent_id", 0)
            ->orderBy("id", "DESC")->paginate(8,'*', "contentPage");
        $comments = Content::where("user_id", $user->id)->where("parent_id", "<>", 0)
            ->orderBy("id", "DESC")->paginate(8,'*', "commentPage");
        $ad_count = UserAd::where("user_id", $user->id)->count();
        $ads = UserAd::where("user_id", $user->id)->orderBy("id", "DESC")->paginate(8, '*', "adPage");
        return view(
            "comment.user.center", compact(
                "user", "content_count", "comment_count", "ad_count", "ads", "contents", "comments"
            ));
    }

    public function logout(Request $request)
    {
        $request->session()->forget("comment_user");
        return redirect()->back();
    }

    public function profile(Request $request)
    {
        $user = $request->session()->get("comment_user");
        $info = User::where("id", $user->id)->first();
        return view("comment.user.profile", compact("info"));
    }

    public function profileSubmit(Request $request)
    {
        $request->validate([
            'username' => 'required|alpha_num|between:3,9',
            'nickname' => 'required|string|between:2,15',
            'email' => 'nullable|email',
            'mobile' => 'nullable|string',
            'sex' => 'required|integer',
            'birthday' => 'nullable|date'
        ], [
            'username.required' => '用户名不能为空',
            'username.alpha_num' => '用户名格式错误，必须是数字或者字母',
            'username.between' => '用户名长度错误，字符长度为3-9个字符',
            'nickname.required' => '昵称不能为空',
            'nickname.string' => '昵称格式错误',
            'nickname.between' => '昵称长度必须在2-15个字符之间',
            'email.email' => '邮箱格式错误',
            'mobile.string' => '手机号码格式错误',
            'sex.required' => '性别不能为空',
            'sex.integer' => '性别格式错误',
            'birthday.date' => '生日格式错误',
        ]);
        $user = $request->session()->get("comment_user");
        $result = User::where("id", $user->id)->update([
            'picture_url' => $request->input("picture_url"),
            'username' => $request->input("username"),
            'nickname' => $request->input("nickname"),
            'email' => $request->input("email"),
            'mobile' => $request->input("mobile"),
            'sex' => $request->input("sex"),
            'birthday' => $request->input("birthday"),
        ]);
        if ($result) {
            $userSession = new \stdClass();
            $userSession->id = $user->id;
            $userSession->username = $request->input("username");
            $userSession->nickname = $request->input("nickname");
            $userSession->picture = $request->input("picture_url");
            $request->session()->put("comment_user", $userSession);
            return back()->with("profile_update_ok", true);
        }
        return back()->withInput($request->all())->with("profile_update_fail", true);
    }

    public function password()
    {
        return view("comment.user.password");
    }

    public function passwordSubmit(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string|between:6,15',
            'password' => 'required|string|between:6,15|confirmed',
        ], [
            'old_password.required' => '旧密码不能为空',
            'old_password.string' => '旧密码格式错误',
            'old_password.between' => '旧密码长度必须是6-15个字符之间',
            'password.required' => '密码不能为空',
            'password.string' => '密码格式错误',
            'password.between' => '密码长度必须是6-15个字符之间',
            'password.confirmed' => '确认密码与新密码不一致',
        ]);
        $user = $request->session()->get("comment_user");
        $info = User::where("id", $user->id)->first();
        if (!Hash::check($request->input("old_password"), $info->password)) {
            return back()->withInput($request->all())->with("old_password_error", true);
        }
        $result = User::where("id", $user->id)->update([
            'password' => Hash::make($request->input("password")),
        ]);
        if ($result) {
            return back()->with("password_update_ok", true);
        }
        return back()->withInput($request->all())->withErrors("password_update_fail");
    }

    public function pictureUpload(Request $request)
    {
        if (!$request->hasFile("picture")) {
            return response()->json([
                'code' => 1,
                'msg' => '参数错误',
                'data' => null
            ]);
        }
        $file = $request->file("picture");
        $path = "comment/picture/".Carbon::now()->toDateString();
        $fileName = md5_file($file->getRealPath()).".".$file->extension();
        $result = $file->storeAs("public/".$path, $fileName);
        $url = str_replace("public", "/storage", $result);
        return response()->json([
            'code' => 0,
            'msg' => '上传成功',
            'data' => [
                'src' => url($url),
                'key' => $url,
            ]
        ]);
    }

    public function home(Request $request, int $userId)
    {
        $user = User::where("id", $userId)->first();
        $contents = Content::where("user_id", $userId)->where("status", 1)->where("is_online", 1)
            ->orderBy("id", "DESC")->paginate(20);

        $userHomeUserTop = UserAd::where("user_id", $user->id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "user_home_user_top")->orderBy(DB::raw("rand()"))->first();

        $userHomeUserBottom = UserAd::where("user_id", $user->id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "user_home_user_bottom")->orderBy(DB::raw("rand()"))->first();

        $userHomeContentsTop = UserAd::where("user_id", $user->id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "user_home_contents_top")->orderBy(DB::raw("rand()"))->first();

        $userHomeContentsBottom = UserAd::where("user_id", $user->id)->where("status", 1)->where("is_online", 1)
            ->where("place_code", "user_home_contents_bottom")->orderBy(DB::raw("rand()"))->first();

        return view("comment.user.home", compact(
            "user","contents",
            "userHomeUserTop", "userHomeUserBottom", "userHomeContentsTop", "userHomeContentsBottom"
        ));
    }
}
