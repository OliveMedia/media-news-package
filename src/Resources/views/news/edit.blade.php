@extends(config('OliveMediaNews.blade_template'))

@section('title','News')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Create News</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                           name="title" value="{{ old('title', $news->title) }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description"
                                              class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                              name="description" required>{{ old('description', $news->description) }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>

                                <div class="col-md-6">
                                    <input id="image" type="file"
                                           class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                           name="image">

                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="video" class="col-md-4 col-form-label text-md-right">Video</label>

                                <div class="col-md-6">
                                    <input id="video" type="file"
                                           class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}"
                                           name="video">

                                    @if ($errors->has('video'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('video') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="attachment" class="col-md-4 col-form-label text-md-right">Attachment</label>

                                <div class="col-md-6">
                                    <input id="attachment" type="file"
                                           class="form-control{{ $errors->has('attachment') ? ' is-invalid' : '' }}"
                                           name="attachment">

                                    @if ($errors->has('attachment'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input class="col-sm-3 form-control btn btn-primary offset-md-9" type="submit" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>{{-- card-body --}}
                </div>{{-- card --}}
            </div>{{-- col-md-8 --}}
        </div>{{-- row --}}
    </div>{{-- container --}}
@endsection