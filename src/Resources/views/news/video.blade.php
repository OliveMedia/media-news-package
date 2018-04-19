<div class="modal fade" id="videomodal-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info modal-md" role="document">
        <!--Content-->
        <div class="modal-content content-display">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="">&times;</span>
            </button>
            <div class="modal-body">
                <iframe src="{{ $video }}" frameborder="0"
                        allow="autoplay; encrypted-media" allowfullscreen style="width: 100%; height: 500px;"></iframe>
            </div>
        </div>{{-- modal-content --}}
    </div>{{-- modal-dialog --}}
</div>{{-- modal --}}