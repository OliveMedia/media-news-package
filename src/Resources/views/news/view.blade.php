@extends(config('media-news-package'))

@section('title','View News')

@section('page-css')
<link rel="stylesheet" type="text/css" href="/css/custom.css">
@endsection

@section('content')
<main class="site-main view main-content-mgmt view-course">
    <div class="container-fluid">
        <div class="top-bar clearfix ">
            <h2>View</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">CONNECTed</a></li>
                <li class="breadcrumb-item"><a href="/console/news">News</a></li>
                <li class="breadcrumb-item"><a href="#">View News</a></li>
            </ol>
        </div>
    </div>

    <div class="content-holder container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-holder">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="profile-image" style=" height:300px; width:300px;">
                                        @if($news->image)
                                        <img src="{{$news->image}}" style="width:300px;">
                                        @else
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="profile-info">
                                            <div class="row">
                                                <div class="col-md-3 info-title">Title:</div>
                                                <div class="col-md-7">{{$news->title}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 info-title">Description:</div><div
                                                class="col-md-7">{{$news->description}}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3 info-title">Preview:</div>
                                                <div class="col-md-5">
                                                    @if($news->video)
                                                    <video width="700" height="395" controls>
                                                        <source src="{{ $news->video }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                        @else
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 info-title">Attachment:</div>
                                                    <div class="col-md-5">
                                                        @if($news->attachment)
                                                        <a href="{{ $news->attachment }}" target="_blank">
                                                            <i class="ion-android-attach"></i>
                                                        </a>
                                                        @else
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row float-right">
                                            <div class="btn-group">
                                                <a class="btn btn-outline-primary waves-effect btn-sm edit-btn"
                                                href="{{ route('news.edit', $news->news_id) }}">Edit News</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>{{-- card-body --}}
                </div>{{-- card--}}
            </div>
        </div>
    </div>
</main>
@endsection
