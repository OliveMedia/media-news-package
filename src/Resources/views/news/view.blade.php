@extends('layouts.app')

@section('title','News')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
@endsection

@section('content')
    <main class="site-main view main-content-mgmt view-course">
        <div class="container-fluid">
            <div class="top-bar clearfix ">
                <h2>Details</h2>
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
                                        <div class="profile-image">
                                            @if($news->image)
                                                <img src="{{$news->image}}">
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="profile-info">
                                                <div class="row">
                                                    <span class="col-md-3 info-title">Title:</span><span
                                                            class="col-md-7">{{$news->title}}</span>
                                                </div>
                                                <div class="row">
                                                    <span class="col-md-3 info-title">Description:</span><span
                                                            class="col-md-7">{{$news->description}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row float-right">
                                            <div class="btn-group">
                                                <a class="btn btn-outline-primary waves-effect btn-sm edit-btn"
                                                   href="{{ route('news.edit', $news->id) }}">Edit News</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>{{-- profile-holder --}}
                        </div>
                    </div>
                </div>{{-- card-body --}}
            </div>{{-- card--}}
        </div>
        </div>
        </div>
    </main>
@endsection
