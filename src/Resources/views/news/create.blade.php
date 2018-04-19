<!-- Central Modal Medium Success -->
<div class="modal fade" id="add-news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Add News</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <form class="col-md-12" method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">

                    <div class="form-group md-form row">

                        <label for="title" class="col-md-12 col-form-label">Title</label>
                        <input id="title" type="text"
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               name="title" value="{{ old('title') }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group row md-form text-editor">
                        <label for="description" class="col-md-12 col-form-label">Description</label>
                        <textarea id="description"
                                  class="form-control md-textarea{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                  type="text-box"
                                  name="description" required="required">{{old('description')}}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="attachment-wrapper">
                                <label for="image" class="col-form-label">Image</label>
                                <span></span>
                                <input id="image" type="file"
                                       class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                       name="image">

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback"><strong>{{ $errors->first('image') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-sm-4">
                            <div class="attachment-wrapper">
                                <label for="video" class="col-form-label">Video</label>
                                <span></span>
                                <input id="video" type="file"
                                       class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}"
                                       name="video">

                                @if ($errors->has('video'))
                                    <span class="invalid-feedback"><strong>{{ $errors->first('video') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-sm-4">
                            <div class="attachment-wrapper">
                                <label for="attachment" class="col-form-label">Attachment</label>
                                <span></span>
                                <input id="attachment" type="file"
                                       class="form-control{{ $errors->has('attachment') ? ' is-invalid' : '' }}"
                                       name="attachment">

                                @if ($errors->has('attachment'))
                                    <span class="invalid-feedback"><strong>{{ $errors->first('attachment') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row float-right">
                        <div class="add-btn">
                            <button type="submit" class="btn btn-outline-primary waves-effect btn-sm">Save</button>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!--/.Content-->
</div>
<!-- Central Modal Medium Success-->
@section('page-script')
    <script type="text/javascript">

        CKEDITOR.replace('description');


        $('.attachment-wrapper input').change(
            function (e) {
                var filename = e.target.files[0].name;
                $(this).parent().find("span").text(filename);
                $(this).parent().addClass("has-file");
            });

        @if ($errors->any())
        $('#add-news').modal('show');
        @endif

    </script>
@endsection