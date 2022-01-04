<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_tag extends Model
{
    protected $table = "post_tags";
    use HasFactory;
   
    public function getTag()
    {
        return $this->belongsTo("App\Models\Tag",'tag_id', 'id');
    }
}

