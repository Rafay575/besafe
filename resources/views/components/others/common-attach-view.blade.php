<div class="col-12 mt-4">
    @if (!empty($label))
    <h6>{{$label}}</h6>
        
    @endif
    <div class="row">
        @foreach ($attachements as $attachement)
            <div class="col-6 col-sm-6 eachImage">
                <div style="position: relative; display: inline-block;" id="table_data_delete" data-action="{{route('common_files.destroy',$attachement->id)}}" data-parent="div.eachImage">
                    <div style="position: absolute; top: 10px; left: 1px; z-index: 100; padding: 1px;  cursor: pointer; ">
                        <i class="fa fa-trash text-light p-2 bg-danger rounded"></i>
                    </div>
                </div>
                <a test={{$attachement->id}} href="{{ asset("attachements/{$attachement->form_name}/{$attachement->form_input_name}/" . $attachement->file_name) }}">
                    <img class="w-100 border-radius-lg p-1 shadow-lg" src="{{ asset("attachements/{$attachement->form_name}/{$attachement->form_input_name}/" . $attachement->file_name) }}" alt="attachements">
                </a>
            </div>
            @endforeach
    </div>
    
</div>