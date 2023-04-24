<div {{$attributes}} id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="{{$id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        @if ($header === "yes")
        <div class="modal-header">
            <h5 class="font-weight-bolder text-primary text-gradient" id="{{$id}}Label">{{$title}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div class="modal-body">
         {{$slot}}
        </div>
        {{-- modal body ends here --}}
        @if ($footer === "yes")
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn bg-gradient-primary">Save changes</button> --}}
        </div>
        @endif
      </div>
    </div>
  </div>