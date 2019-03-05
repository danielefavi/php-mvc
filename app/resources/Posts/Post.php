<?php

namespace App\Resources\Posts;

use Core\Model;



class Post extends Model
{
    /**
     * Name of the database table that the Post class is related to.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Enabling the soft-delete setting $deletedAt to TRUE.
     *
     * @var boolean
     */
    protected $deletedAt = true;

    /**
     * List of fields that will be autamatically be filled when using
     * the function Post::create or Post::update
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
    ];

}
