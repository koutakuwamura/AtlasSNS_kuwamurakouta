<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'post','user_id',

    ];//データベースの更新や反映などの許可

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
