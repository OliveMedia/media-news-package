<?php
namespace OliveMedia\OliveMediaNews\Helpers;

use Illuminate\Support\Str;
use OliveMedia\OliveMediaNews\Entities\News\MediaNews;

class MediaNewsHelper
{

    public static function getNewsById($newsId)
    {
        try {
            $news = MediaNews::where('news_id', $newsId)->first();

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getPaginatedNewsBy($attribute, $value, $perPage = 10)
    {
        try {
            $news = MediaNews::where($attribute, $value)->orderBy('created_at', 'desc')->paginate($perPage);

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getAllNews($perPage = 10)
    {
        try {
            $news = MediaNews::orderBy('created_at', 'desc')->paginate($perPage);

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getAllNewsWithTrash($perPage = 10)
    {
        try {
            $news = MediaNews::orderBy('created_at', 'desc')
                ->withTrashed()
                ->paginate($perPage);

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getAllTrashedNews($perPage = 10)
    {
        try {
            $news = MediaNews::orderBy('created_at', 'desc')
                ->onlyTrashed()
                ->paginate($perPage);

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function createNews($newsData)
    {
        try {
            $newsData['news_id'] = Str::orderedUuid();

            $news = MediaNews::create($newsData);
            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function updateNews($newsData, $newsId)
    {
        try {
            $news = MediaNews::where('news_id', $newsId)->update($newsData);
            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function deleteNews($newsId)
    {
        try {
            $news = MediaNews::where('news_id', $newsId)->first();
            return $news->delete();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function restoreNews($newsId)
    {
        try {
            $news = MediaNews::where('news_id', $newsId)->restore();

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function forceDeleteNews($newsId)
    {
        try {
            $news = MediaNews::where('news_id', $newsId)->first();
            return $news->forceDelete();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

}
