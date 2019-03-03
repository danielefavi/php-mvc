<?php

namespace App\Resources\Posts;

use Core\Model;



class Post extends Model
{
    protected $table = 'posts';

    protected $deletedAt = true;

    protected $fillable = [
        'title',
        'body',
    ];

}
