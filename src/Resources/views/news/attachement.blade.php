<div class="modal fade" id="attachmentmodal-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info modal-md" role="document">
        <div class="modal-content content-display">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
            </button>
            <div class="modal-body">
                <embed src="{{ $attachment }}"
                       width="100%" height="500px" internalinstanceid="5">
            </div>{{-- modal-body --}}
        </div>{{-- modal-content --}}
    </div>{{-- modal-dialog --}}
</div>{{-- modal --}}