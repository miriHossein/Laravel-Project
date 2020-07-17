<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable = ['comment_id', 'author', 'email', 'content', 'post_id', 'is_active', 'file'];

    public function comment(){
        return $this->belongsTo('App\Comment');
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }
}
