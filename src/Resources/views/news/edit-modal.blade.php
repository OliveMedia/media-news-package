<!-- Central Modal Medium Success -->
<div class="modal fade" id="edit-news-{{ $indNews->news_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Edit News</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <form method="POST" action="{{ route('news.update', $indNews->news_id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}

                    <div class="form-group md-form row">

                        <label for="title" class="col-md-12 col-form-label">Title</label>
                        <input id="title" type="text"
                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                               name="title" value="{{ old('title', $indNews->title) }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group row md-form text-editor">
                        <label for="description" class="col-md-12 col-form-label">Description</label>
                        <textarea id="edit-description-{{$indNews->news_id}}"
                                  class="form-control md-textarea{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                  type="text-box"
                                  name="description" required="required">{{old('description', $indNews->description)}}</textarea>
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
                            <button type="submit" class="btn btn-outline-primary waves-effect btn-sm">Update</button>

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

        CKEDITOR.replace('edit-description-{{ $indNews->news_id }}');


        $('.attachment-wrapper input').change(
            function (e) {
                var filename = e.target.files[0].name;
                $(this).parent().find("span").text(filename);
                $(this).parent().addClass("has-file");
            });

        @if ($errors->any())
        $('#edit-news-{{ $indNews->news_id }}').modal('show');
        @endif

    </script>
@endsection