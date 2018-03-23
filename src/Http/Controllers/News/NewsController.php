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
        $news = $this->newsRepo->paginate();

        return view("OliveMediaNews::news.index", ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('OliveMediaNews::news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsStoreRequest $request)
    {
        $inputs = $request->all();

        $inputs['news_id'] = 'abcyzx234as';
        //$inputs['news_id'] = StorageService::uuid();

        $inputs['image'] = StorageService::store($request->file('image'), 'uploads/news')['url'];
        $inputs['video'] = StorageService::store($request->file('video'))['url'];
        $inputs['attachment'] = StorageService::store($request->file('attachment'))['url'];

        if ($this->newsRepo->create($inputs)) {
            Session::flash('success', 'Successfully created news');

            return redirect()->action('\OliveMedia\OliveMediaNews\Http\Controllers\News\NewsController@index');
        }

        Session::flash('error', 'Sorry!! Error occured while creating news');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->newsRepo->delete($id)) {
            Session::flash('success', "Successfully deleted news");
            return redirect()->back();
        }

    }
}
