<?php

namespace PluginCloud\Comment\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Content extends Base implements Feedable
{
    use SoftDeletes;
    protected $table = "comment_contents";

    public function toFeedItem()
    {
        $author = User::where("id", $this->user_id)->value("nickname");
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            ->link(route("comment.home.content.info", ['id', $this->id]))
            ->author($author);
    }

    public static function getFeedItems()
    {
        return Content::all();
    }
}
