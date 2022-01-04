<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post_tag;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;

    public function status()
    {
        return $this->belongsTo("App\Models\Post_status", 'post_status_id', "id");
    }
    public function user()
    {
        return $this->belongsTo("App\Models\User", 'user_id', "id");
    }

    public function tag()
    {
        return $this->belongsToMany("App\Models\Tag","post_tags","post_id","tag_id");
    }


    public function getTagsByPostId($postId)
    {
        return Post_tag::where("post_id", $postId)->get();
    }
}
