@extends(config('OliveMediaNewsPackage.blade_template'))

@section('title','Create News')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
@endsection

@section('content')
    <main class="site-main edit-page">
        <div class="container-fluid">

            <div class="top-bar clearfix ">
                <h2>Create News</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Connected</a></li>
                    <li class="breadcrumb-item"><a href="/console/news">News</a></li>
                    <li class="breadcrumb-item"><a href="#">Create News</a></li>
                </ol>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-default ">
                        @if(\Session::has('error'))
                            <div class="alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        <div class="card-header">Create</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="title" class="col-form-label text-md-right">Title</label>
                                    </div>

                                    <div class="col-md-7">
                                        <input id="title" type="text"
                                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                               name="title" value="{{ old('title') }}" required autofocus>

                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="description"
                                               class="col-form-label text-md-right">Description</label>
                                    </div>

                                    <div class="col-md-7">
                                    <textarea id="description"
                                              class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                              name="description" required>{{ old('description') }}</textarea>

                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="image" class="col-form-label text-md-right">Image</label>
                                    </div>

                                    <div class="col-md-7">
                                        <input id="image" type="file"
                                               class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                               name="image">

                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @else
                                            <span class="info">
                                                <strong>The supported type are jpg, jpeg</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="video" class="col-form-label text-md-right">Video</label>
                                    </div>

                                    <div class="col-md-7">
                                        <input id="video" type="file"
                                               class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}"
                                               name="video">

                                        @if ($errors->has('video'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('video') }}</strong>
                                        </span>
                                        @else
                                            <span class="info">
                                                <strong>The supported type is mp4</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="attachment" class="col-form-label text-md-right">Attachment</label>
                                    </div>

                                    <div class="col-md-7">
                                        <input id="attachment" type="file"
                                               class="form-control{{ $errors->has('attachment') ? ' is-invalid' : '' }}"
                                               name="attachment">

                                        @if ($errors->has('attachment'))
                                                    <span class="invalid-feedback">
                                                <strong>{{ $errors->first('attachment') }}</strong>
                                            </span>
                                        @else
                                            <span class="info">
                                                <strong>The supported type are pdf,docx</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 "></div>
                                    <div class="col-sm-7 add-btn float-right">
                                        <input class="btn btn-outline-primary waves-effect btn-md" type="submit"
                                               value="Save"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('page-script')
    <script type="text/javascript">

        CKEDITOR.replace('description');

    </script>
@endsection
