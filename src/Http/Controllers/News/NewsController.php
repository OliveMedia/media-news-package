<?php

namespace OliveMedia\OliveMediaNews\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            $news = $this->newsRepo->paginate();

            return view("OliveMediaNews::news.index", ['news' => $news]);
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
            return view('OliveMediaNews::news.create');
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

            $inputs['news_id'] = 'abcyzx234as';
            //$inputs['news_id'] = StorageService::uuid();

            $inputs['image'] = StorageService::store($request->file('image'), 'uploads/news')['url'];
            $inputs['video'] = StorageService::store($request->file('video'), 'uploads/news')['url'];
            $inputs['attachment'] = StorageService::store($request->file('attachment'), 'uploads/news')['url'];

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
            $news = $this->newsRepo->findById($id);

            return view("OliveMediaNews::news.view", ['news' => $news]);
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
            $news = $this->newsRepo->findById($id);

            return view("OliveMediaNews::news.edit", ['news' => $news]);
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

            $news = $this->newsRepo->findById($id);
            if ($request->hasFile('image')) {
                $inputs['image'] = StorageService::store($request->file('image'), 'uploads/news')['url'];
                StorageService::deleteFile($news->image);
            }
            if ($request->hasFile('video')) {
                $inputs['video'] = StorageService::store($request->file('video'), 'uploads/news')['url'];
                StorageService::deleteFile($news->video);
            }
            if ($request->hasFile('attachment')) {
                $inputs['attachment'] = StorageService::store($request->file('attachment'), 'uploads/news')['url'];
                StorageService::deleteFile($news->attachment);
            }

            if ($this->newsRepo->update($inputs, $id)) {
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

            $news = $this->newsRepo->findById($id);
            StorageService::deleteFile($news->image);
            StorageService::deleteFile($news->video);
            StorageService::deleteFile($news->attachment);

            if ($this->newsRepo->delete($id)) {
                Session::flash('success', "Successfully deleted news");
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }
}
