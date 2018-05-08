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
                <form method="POST" action="{{ url('console/news/'.$indNews->news_id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}

                    <div class="form-group md-form row">

                        <label for="title" class="col-md-12 col-form-label">Title</label>
                        <input id="title" type="text"
                               class="form-control{{ $errors->consoleUpdateNews->has('title') ? ' is-invalid' : '' }}"
                               name="title" value="{{ old('title', $indNews->title) }}" required autofocus>

                               @if($errors->consoleUpdateNews->first('title'))
                               {!! $errors->consoleUpdateNews->first('title', '<span class="invalid-feedback"><strong>:message</strong></span>') !!}
                               @endif
                    </div>
                    <div class="form-group row md-form text-editor">
                        <label for="description" class="col-md-12 col-form-label">Description</label>
                        <textarea id="edit-description-{{$indNews->news_id}}"
                                  class="form-control md-textarea{{ $errors->consoleUpdateNews->has('description') ? ' is-invalid' : '' }}"
                                  type="text-box"
                                  name="description">{{old('description', $indNews->description)}}</textarea>
                                  @if($errors->consoleUpdateNews->first('description'))
                                  {!! $errors->consoleUpdateNews->first('description', '<span class="invalid-feedback"><strong>:message</strong></span>') !!}
                                  @endif
                          <div class="file-uploads row">
                              @if($indNews->description)
                                  <div class="col-md-4 file-display" id='previewed-image'>
              						<img id="image-perview" src="{{ $indNews->image }}" alt="" />
              					</div>
                                @endif
                                @if($indNews->video)
                                  <div class="col-md-4 file-display" id="previewed-video">
          							<video id="video-preview" width="100px" height="100px"  controls>
          								<source src="{{ $indNews->video }}" type="video/mp4">
          								Your browser does not support the video tag.
          							</video>
          						</div>
                                @endif
                                @if($indNews->attachment)
                                  <div class="col-md-4 file-display" id="previewed-attachment">
                                          <a class="" href="{{ $indNews->attachment }}" target="_blank">
                                              <i class="ion-archive" style="font-size: 50px !important;"></i>
                                          </a>
                  				</div>
                                @endif
            				</div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <div class="attachment-wrapper">
                                <label for="image" class="col-form-label">Image</label>
                                <span></span>
                                <input id="image" type="file"
                                       class="form-control{{ $errors->consoleUpdateNews->has('image') ? ' is-invalid' : '' }}"
                                       name="image">

                                       @if($errors->consoleUpdateNews->first('image'))
                                       {!! $errors->consoleUpdateNews->first('image', '<span class="invalid-feedback"><strong>:message</strong></span>') !!}
                                       @endif
                            </div>
                        </div>

                        <div class="form-group col-sm-4">
                            <div class="attachment-wrapper">
                                <label for="video" class="col-form-label">Video</label>
                                <span></span>
                                <input id="video" type="file"
                                       class="form-control{{ $errors->consoleUpdateNews->has('video') ? ' is-invalid' : '' }}"
                                       name="video">

                                       @if($errors->consoleUpdateNews->first('video'))
                                       {!! $errors->consoleUpdateNews->first('video', '<span class="invalid-feedback"><strong>:message</strong></span>') !!}
                                       @endif
                            </div>
                        </div>

                        <div class="form-group col-sm-4">
                            <div class="attachment-wrapper">
                                <label for="attachment" class="col-form-label">Attachment</label>
                                <span></span>
                                <input id="attachment" type="file"
                                       class="form-control{{ $errors->consoleUpdateNews->has('attachment') ? ' is-invalid' : '' }}"
                                       name="attachment">

                                       @if($errors->consoleUpdateNews->first('attachment'))
                                       {!! $errors->consoleUpdateNews->first('attachment', '<span class="invalid-feedback"><strong>:message</strong></span>') !!}
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
