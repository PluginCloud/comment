<?php

namespace PluginCloud\Comment\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Base
{
    use SoftDeletes;
    protected $table = "comment_contents";
}
