<div class="modal fade" id="viewnewsmodal-{{$indNews->news_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md modal-notify modal-info modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead">{{ $indNews->title }}</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>{{-- modal-header --}}
            <div class="modal-body">
                <div class="news-view-content">
                    <div class="news-intro">
                        @if($indNews->image)
                        <div class="img-holder">
                            <img src="{{ $indNews->image }}" alt="">
                        </div>
                        @endif
                        <div class="text-holder">
                            {!! $indNews->description !!}
                        </div>{{-- text-holder --}}
                    </div>{{-- news-intro --}}
                    <div class="news-detail">
                        <div class="row">
                            @if($indNews->video)
                            <div class="col-md-6">
                                <iframe src="{{ $indNews->video }}" frameborder="0"
                                        allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            @endif
                            @if($indNews->attachment)
                            <div class="col-md-6">
                                <embed src="{{ $indNews->attachment }}"
                                       width="100%" height="100%" internalinstanceid="5">
                            </div>
                                @endif
                        </div>
                    </div>
                    <div class="bottom-bar float-right">
                        <a type="button" class="btn btn-outline-danger waves-effect btn-sm"
                           data-dismiss="modal">Cancel</a>
                    </div>
                </div>
            </div>{{-- modal-body --}}
        </div>{{-- modal-content --}}
    </div>{{-- modal-dialog --}}
</div>{{-- modal --}}
    