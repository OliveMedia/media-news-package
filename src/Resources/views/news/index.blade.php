@extends(config('OliveMediaNewsPackage.blade_template'))

@section('title', 'News')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
@endsection

@include('OliveMediaNewsPackage::news.create')

@section('content')
    <main class="site-main course-management main-content-mgmt">
        <div class="container-fluid">
            <div class="top-bar clearfix ">
                <h2>News</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">CONNECTed</a></li>
                    <li class="breadcrumb-item"><a href="#">News</a></li>
                </ol>
            </div>{{-- top-bar --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        @include('OliveMediaNewsPackage::news.error')
                        <div class="card-header">
                            <div class="row">
                                <div class="bottom-bar col-sm-12 col-md-6 float-left">
                                    <button type="button" class="btn btn-md add-btn" data-toggle="modal"
                                            id="add-news-btn"
                                            data-target="#add-news">ADD News
                                    </button>
                                </div>
                                <div class="col-sm-12 col-md-6 text-right float-right">
                                    <form id="form-search">
                                        <input type="search" placeholder="Search">
                                    </form>

                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="news-section-holder">
                                <div class="row">
                                    @if ($news)
                                        @foreach($news as $individualNews)
                                            <div class="col-md-3">
                                                <article class="news-section">
                                                    <div class="news-img">
                                                        <a href="#" data-toggle="modal"
                                                           data-target="#viewnewsmodal">
                                                            @if($individualNews->image)
                                                                <img src="{{ $individualNews->image }}"
                                                                     alt="img-desctiption">
                                                            @endif
                                                        </a>
                                                    </div>{{-- news-images --}}
                                                    <div class="news-info">
                                                        <h3><a data-toggle="modal" data-target="#viewnewsmodal-{{ $individualNews->news_id }}"
                                                               href="#">{{ $individualNews->title }}</a></h3>
                                                        @include('OliveMediaNewsPackage::news.view-news', ['indNews' => $individualNews])
                                                        <div class="news-description">
                                                            {!! $individualNews->description !!}
                                                        </div>{{-- news-description --}}
                                                    </div>{{-- news-info --}}
                                                    <div class="news-option clearfix">
                                                        <div class="opt-left float-left">
                                                            @if($individualNews->video)
                                                                <a href="#" data-toggle="modal"
                                                                   data-target="#videomodal-{{$individualNews->news_id}}"
                                                                   title="video"><i class="ion-play"></i>
                                                                </a>
                                                                @include('OliveMediaNewsPackage::news.video', ['id' => $individualNews->news_id, 'video' => $individualNews->video])
                                                            @endif
                                                            @if($individualNews->attachment)
                                                                <a href="#" data-toggle="modal"
                                                                   data-target="#attachmentmodal-{{ $individualNews->news_id }}"
                                                                   title="attachement">
                                                                    <i class="ion-paperclip"></i>
                                                                </a>
                                                                @include('OliveMediaNewsPackage::news.attachement',['id' => $individualNews->news_id, 'attachment' => $individualNews->attachment])
                                                            @endif
                                                        </div>{{-- opt-left --}}
                                                        <div class="opt-right float-right">
                                                            <a href="#"
                                                               data-toggle="modal"
                                                               data-target="#edit-news-{{ $individualNews->news_id }}">
                                                                <i class="ion-edit"></i>
                                                            </a>
                                                            @include('OliveMediaNewsPackage::news.edit-modal', ['indNews' => $individualNews])
                                                            <a class="delete-btn" data-toggle="modal"
                                                               data-target="#deletemodal-{{ $individualNews->news_id }}"
                                                               href="#">
                                                                <i class="ion-trash-a"></i>
                                                            </a>
                                                            @include('OliveMediaNewsPackage::news.delete', ['id' => $individualNews->news_id, 'title' => $individualNews->title])
                                                        </div>{{-- opt-right --}}
                                                    </div>{{-- news-option --}}
                                                </article>{{-- news-section --}}
                                            </div>{{-- col-md-3 --}}
                                        @endforeach
                                    @endif
                                </div>{{-- row --}}
                            </div>{{-- news-section-holder --}}
                        </div>{{-- card-body --}}
                    </div>{{-- card --}}
                </div>
            </div>{{-- row --}}
        </div>{{-- container-fluid --}}
    </main>

@endsection

@section('page-script')
    <script>
        $(document).ready(function () {


        });
    </script>
@endsection

