<?php


namespace PluginCloud\Comment\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class UserAd extends Base
{
    use SoftDeletes;
    protected $table = "comment_user_ads";
}
