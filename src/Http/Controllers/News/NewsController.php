<?php

namespace OliveMedia\OliveMediaNews\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use OliveMedia\OliveMediaNews\Http\Request\News\NewsStoreRequest;
use OliveMedia\OliveMediaNews\Http\Request\News\NewsUpdateRequest;

use OliveMedia\OliveMediaNews\Persistence\Repositories\Contract\NewsInterface;
use OliveMedia\OliveMediaNews\Services\StorageService;

class NewsController extends Controller
{
    protected $newsRepo;


    public function __construct(NewsInterface $newsRepo)
    {
        $this->newsRepo = $newsRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $news = $this->newsRepo->paginateBy(\Auth::user()->user_id, 'user_id');

            return view("media-news-package::news.index", ['news' => $news]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('media-news-package::news.create');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsStoreRequest $request)
    {
        try {
            $inputs = $request->all();

            $inputs['news_id'] = Str::orderedUuid();
            $inputs['user_id'] = \Auth::user()->user_id;

            $inputs['image'] = StorageService::store($request->file('image'), 'public/uploads/news')['url'];
            $inputs['video'] = StorageService::store($request->file('video'), 'public/uploads/news')['url'];
            $inputs['attachment'] = StorageService::store($request->file('attachment'), 'public/uploads/news')['url'];

            if ($this->newsRepo->create($inputs)) {
                Session::flash('success', 'Successfully created news');

                return redirect()->action('\OliveMedia\OliveMediaNews\Http\Controllers\News\NewsController@index');
            }

            Session::flash('error', 'Sorry!! Error occur while creating news');
            return redirect()->back();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $news = $this->newsRepo->findBy('news_id', $id);

            return view("media-news-package::news.view", ['news' => $news]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $news = $this->newsRepo->findBy('news_id', $id);

            return view("media-news-package::news.edit", ['news' => $news]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, $id)
    {
        try {
            $inputs = $request->except(['_token', '_method']);

            $news = $this->newsRepo->findBy('news_id', $id);
            if ($request->hasFile('image')) {
                $inputs['image'] = StorageService::store($request->file('image'), 'public/uploads/news')['url'];
                StorageService::deleteFile($news->image);
            }
            if ($request->hasFile('video')) {
                $inputs['video'] = StorageService::store($request->file('video'), 'public/uploads/news')['url'];
                StorageService::deleteFile($news->video);
            }
            if ($request->hasFile('attachment')) {
                $inputs['attachment'] = StorageService::store($request->file('attachment'), 'public/uploads/news')['url'];
                StorageService::deleteFile($news->attachment);
            }

            if ($this->newsRepo->update($inputs, $id, 'news_id')) {
                Session::flash('success', 'Successfully updated news');

                return redirect()->action('\OliveMedia\OliveMediaNews\Http\Controllers\News\NewsController@index');
            }

            Session::flash('error', 'Sorry!! Error occur while creating news');
            return redirect()->back();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $news = $this->newsRepo->findBy('news_id', $id);
            StorageService::deleteFile($news->image);
            StorageService::deleteFile($news->video);
            StorageService::deleteFile($news->attachment);

            if ($this->newsRepo->deleteBy($id, 'news_id')) {
                Session::flash('success', "Successfully deleted news");
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }
}
