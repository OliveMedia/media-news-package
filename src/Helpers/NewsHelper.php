<?php
namespace OliveMedia\OliveMediaNews\Helpers;

use Illuminate\Support\Str;
use OliveMedia\OliveMediaNews\Entities\News\News;

class NewsHelper
{

    public static function getNew($newsId)
    {
        try {
            $news = News::where('news_id', $newsId)->first();

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getUserNews($userId, $perPage = 10)
    {
        try {
            $news = News::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate($perPage);

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getAllNews($perPage = 10)
    {
        try {
            $news = News::orderBy('created_at', 'desc')->paginate($perPage);

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function createNews($newsData)
    {
        try {
            $news['news_id'] = Str::orderedUuid();

            $news = News::create($newsData);
            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

}
