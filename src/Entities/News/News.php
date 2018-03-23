<?php

namespace OliveMedia\OliveMediaNews\Entities\News;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'news_id',
        'title',
        'description',
        'image',
        'video',
        'attachment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
