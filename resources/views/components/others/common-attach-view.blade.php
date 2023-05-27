@if ($attributes->has('shouldNotCollapse') && @$attributes['shouldNotCollapse'] === 'true')
 
  {{-- pictures --}}
  <div class="row">
    <h5 class="mt-2">
      @if (!empty($label))
      {{$label}}
      @endif
    </h5>
    @foreach ($attachements as $attachement)
    <div class="col-6 col-sm-6 eachImage">
        @if ($attributes->has('shouldDelete') && @$attributes['shouldDelete'] === 'true')
      <div style="position: relative; display: inline-block;" id="table_data_delete" data-action="{{route('common_files.destroy',$attachement->id)}}" data-parent="div.eachImage">
            <div style="position: absolute; top: 10px; left: 1px; z-index: 100; padding: 1px;  cursor: pointer; ">
                <i class="fa fa-trash text-light p-2 bg-danger rounded"></i>
            </div>
        </div>
        @endif

        <a test={{$attachement->id}} href="{{ asset("attachements/{$attachement->form_name}/{$attachement->form_input_name}/" . $attachement->file_name) }}">
            <img class="w-100 border-radius-lg p-1 shadow-lg" src="{{ asset("attachements/{$attachement->form_name}/{$attachement->form_input_name}/" . $attachement->file_name) }}" alt="attachements">
        </a>
    </div>
    @endforeach
</div>



@else
  <div class="accordion" id="accordionRental">
      <div class="accordion-item mb-3">
        <h5 class="accordion-header" id="{{(!empty($label)) ? $label : 'ItemOne'}}">
          <button class="accordion-button border-bottom font-weight-bold  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{(!empty($label)) ? $label : 'ItemOne'}}" aria-expanded="false" aria-controls="collapse{{(!empty($label)) ? $label : 'ItemOne'}}">
              @if (!empty($label))
              {{$label}}
              @endif
            <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
            <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
          </button>
        </h5>
        <div id="collapse{{(!empty($label)) ? $label : 'ItemOne'}}" class="accordion-collapse collapse" aria-labelledby="{{(!empty($label)) ? $label : 'ItemOne'}}" data-bs-parent="#accordionRental" style="">
          <div class="accordion-body text-sm opacity-8 row">
            {{-- pictures --}}
            @foreach ($attachements as $attachement)
            <div class="col-6 col-sm-6 eachImage">
                @if ($attributes->has('shouldDelete') && @$attributes['shouldDelete'] === 'true')
              <div style="position: relative; display: inline-block;" id="table_data_delete" data-action="{{route('common_files.destroy',$attachement->id)}}" data-parent="div.eachImage">
                    <div style="position: absolute; top: 10px; left: 1px; z-index: 100; padding: 1px;  cursor: pointer; ">
                        <i class="fa fa-trash text-light p-2 bg-danger rounded"></i>
                    </div>
                </div>
                @endif

                <a test={{$attachement->id}} href="{{ asset("attachements/{$attachement->form_name}/{$attachement->form_input_name}/" . $attachement->file_name) }}">
                    <img class="w-100 border-radius-lg p-1 shadow-lg" src="{{ asset("attachements/{$attachement->form_name}/{$attachement->form_input_name}/" . $attachement->file_name) }}" alt="attachements">
                </a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
  </div>
@endif