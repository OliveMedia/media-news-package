@extends(config('OliveMediaNewsPackage.blade_template'))

@section('title', 'News')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
@endsection

@section('content')
    <div style="display:none;" id="error_check" data-showtab="{{session('errors')}}"></div>
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
                                    <a href="{{ route('news.create') }}" class="btn btn-md add-btn">ADD News</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($news as $individualNews)
                                    <tr>
                                        <td><span>{{$individualNews->title}}</span></td>
                                        <td><span>{!! $individualNews->description !!}</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"
                                                        class="btn btn-sm btn-primary btn-sm dropdown-toggle">Option
                                                </button>
                                                <div class="dropdown-menu" x-placement="top-start">
                                                    @if($individualNews->deleted_at)
                                                    @else
                                                        <a href="{{ route("news.show", $individualNews->news_id) }}"
                                                           class="dropdown-item">View</a>
                                                        <a href="{{ route("news.edit", $individualNews->news_id) }}"
                                                           class="dropdown-item">Edit</a>
                                                        <a class="dropdown-item delete-news" href="#"
                                                           data-news_id="{{ $individualNews->news_id }}">Delete</a>
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

    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-notify modal-info" role="document">
            <div class="modal-content delete-model">
                <div class="modal-header">
                    <p class="heading lead">Delete User</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>{{-- modal-header --}}
                <div class="modal-body">
                    <div class="delete-msg">
                        <span>Are you sure you want to delete this user?</span>
                    </div>
                    <div class="float-left">
                        <form method="post">
                            @csrf
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger waves-effect btn-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                    <div class="float-right">
                        <a type="button" class="btn btn-outline-danger waves-effect btn-sm"
                           data-dismiss="modal">Cancel</a>
                    </div>
                </div>{{-- modal-body --}}
            </div>{{-- modal-content --}}
        </div>{{-- modal-dialog --}}
    </div><!-- Delete Modal-->

@endsection

@section('page-script')
    <script>
        $('.delete-news').on('click', function (e) {
            var newsId = $(this).data('news_id');
            var url = '/console/news/' + newsId;

            $('#deletemodal').find('form').attr('action', url);

            $('#deletemodal').modal('show');
        })
    </script>
@endsection

