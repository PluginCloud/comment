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
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            ->link(route("comment.content.info", ['id', $this->id]))
            ->author($this->author);
    }
}
