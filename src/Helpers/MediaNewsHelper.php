<?php
namespace OliveMedia\OliveMediaNews\Helpers;

use Illuminate\Support\Str;
use OliveMedia\OliveMediaNews\Entities\News\MediaNews;

class MediaNewsHelper
{
    protected $mediaNews;

    public function __construct($newsObj)
    {
        $this->mediaNews = $newsObj;
    }

    public function getNewsById($newsId)
    {
        try {
            $news = $this->mediaNews->where('news_id', $newsId)->first();

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getPaginatedNewsBy($attribute, $value, $perPage = 10)
    {
        try {
            $news = $this->mediaNews->where($attribute, $value)->orderBy('created_at', 'desc')->paginate($perPage);

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAllNews($perPage = 10)
    {
        try {
            $news = $this->mediaNews->orderBy('created_at', 'desc')->paginate($perPage);

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAllNewsWithTrash($perPage = 10)
    {
        try {
            $news = $this->mediaNews->orderBy('created_at', 'desc')
                ->withTrashed()
                ->paginate($perPage);

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function getAllTrashedNews($perPage = 10)
    {
        try {
            $news = $this->mediaNews->orderBy('created_at', 'desc')
                ->onlyTrashed()
                ->paginate($perPage);

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function createNews($newsData)
    {
        try {
            $newsData['news_id'] = Str::orderedUuid();

            $news = $this->mediaNews->create($newsData);
            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function updateNews($newsData, $newsId)
    {
        try {
            $news = $this->mediaNews->where('news_id', $newsId)->update($newsData);
            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function deleteNews($newsId)
    {
        try {
            $news = $this->mediaNews->where('news_id', $newsId)->first();
            return $news->delete();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function restoreNews($newsId)
    {
        try {
            $news = $this->mediaNews->where('news_id', $newsId)->restore();

            return $news;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function forceDeleteNews($newsId)
    {
        try {
            $news = $this->mediaNews->where('news_id', $newsId)->first();
            return $news->forceDelete();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

}
