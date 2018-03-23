<?php

namespace OliveMedia\OliveMediaNews\Persistence\Repositories\Eloquent;

use OliveMedia\OliveMediaNews\Persistence\Repositories\Contract\NewsInterface;

class NewsRepository extends EloquentRepository implements NewsInterface
{
    protected $modelClassName = 'OliveMedia\OliveMediaNews\Entities\News\News';
}
