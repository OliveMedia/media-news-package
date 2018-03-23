@extends(config('OliveMediaNews.blade_template'))

@section('title', 'News')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
@endsection

@section('content')
    <div style="display:none;" id="error_check" data-showtab="{{session('errors')}}"></div>
    <main class="site-main course-management main-content-mgmt">
        <div class="container-fluid">
            <div class="top-bar clearfix ">
                <h2>Courses</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">{{ config('OliveMediaNews.site_name') }}</a></li>
                    <li class="breadcrumb-item"><a href="/news">News</a></li>{{ SESSION('success') }}
                </ol>
            </div>{{-- top-bar --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        {{--@include('layouts.error')--}}
                        <div class="card-header">
                            <div class="row">
                                <div class="bottom-bar col-sm-12 col-md-6 float-left">
                                    <a href="{{ route('news.create') }}" class="btn btn-md add-btn">ADD News</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Videos</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($news as $individualNews)
                                    <tr>
                                        <td><span>{{$individualNews->title}}</span></td>
                                        <td><span>{{$individualNews->description}}</span></td>
                                        <td><span>{{$individualNews->image}}</span></td>
                                        <td><span>{{$individualNews->video}}</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"
                                                        class="btn btn-sm btn-primary btn-sm dropdown-toggle">Option
                                                </button>
                                                <div class="dropdown-menu" x-placement="top-start">
                                                    @if($individualNews->deleted_at)
                                                        <a href="{{ route('course.restore',$individualNews->course_id)}}"
                                                           class="dropdown-item">Restore</a>
                                                    @else
                                                        <a href="{{ route("news.show", $individualNews->id) }}"
                                                           class="dropdown-item">View</a>
                                                        <a href="{{ route("news.edit", $individualNews->id) }}"
                                                           class="dropdown-item">Edit</a><hr>

                                                        <form method="post" action="{{ route('news.destroy', $individualNews->id) }}">
                                                            @csrf
                                                            {{ method_field('DELETE') }}

                                                            <button type="submit" class="dropdown-item">Delete</button>

                                                        </form>

                                                    @endif
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $news->links() }}

                        </div>{{-- card-body --}}
                    </div>{{-- card --}}
                </div>
            </div>{{-- row --}}
        </div>{{-- container-fluid --}}
    </main>
@endsection
