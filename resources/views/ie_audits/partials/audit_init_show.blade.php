
<form action="{{route('audit_init.store')}}" class="col-12 row  ajax-form" method="post"  enctype="multipart/form-data">
    @csrf
    <div class="table-responsive">
        <table class="table table-flush table-bordered" >
          <thead class="thead-light bg-primary text-light">
            <x-table.tblhead heads="Audit Hall, Audit Type, Initiator,Audit Date"></x-table.tblhead>
          </thead>
          <tbody>
            <tr>
                <th>{{$ieAuditClause->audit_hall->hall_title}}</th>
                <th>{{$ieAuditClause->audit_type->audit_title}}</th>
                <th>{{$ieAuditClause->initiator->first_name}}</th>
                <th>{{$ieAuditClause->audit_date}}</td>
            </tr>
          </tbody>
        </table>
    </div>

    <hr>
    <div class="audit_questions">
        {{-- <h5>Audit Questions</h5> --}}
        @foreach ($auditQuestions as $question)
        @php
            $attachements = [];
            $audit_answer = [];
            if($question->audit_answer){
                $audit_answer = $question->audit_answer->where('ie_audit_clause_id',$ieAuditClause->id)->first();
                if($audit_answer){
                    $attachements  = $audit_answer->attachements;
                }
            }
        @endphp
        <div class="accordion mt-2" id="accordionRental">
            <div class="accordion-item mb-3 mt-2">
            <h5 class="accordion-header" id="heading{{$loop->iteration}}">
                <button class="accordion-button border-bottom font-weight-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->iteration}}" aria-expanded="false" aria-controls="collapse{{$loop->iteration}}">
                    <div class="question_status_icon">
                        @if (isset($audit_answer))
                            @if ($audit_answer->yes_or_no)
                            <i class="fa fa-circle-check p-2 text-success"></i>
                            @else
                            <i class="fa fa-circle-xmark p-2 text-danger"></i>
                            @endif
                         @else   
                         <i class="fa fa-circle-info p-2 text-info"></i>
                        @endif
                    </div>
                    {{$question->question}}
                <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                </button>
            </h5>
            <div id="collapse{{$loop->iteration}}" class="accordion-collapse collapse" aria-labelledby="heading{{$loop->iteration}}" data-bs-parent="#accordionRental" style="">
                <div class="accordion-body text-sm opacity-8 text-dark row">
                    <div class="col-6" >
                        <x-forms.radio-and-check-box-div name="response[{{$question->id}}][yes_or_no]" label="Your Answer" div-class="col-6">
                                <x-forms.radio-box width="col-2" radio-box-class="" name="response[{{$question->id}}][yes_or_no]" checked="{{(isset($audit_answer) ? $audit_answer->yes_or_no ? 'true' : 'false' : '')}}" label="Yes" value="1"></x-forms.radio-box>
                                <x-forms.radio-box width="col-2" radio-box-class="" name="response[{{$question->id}}][yes_or_no]" checked="{{(isset($audit_answer) ? $audit_answer->yes_or_no ? 'false' : 'true' : '')}}" label="No" value="0"></x-forms.radio-box>
                        </x-forms.radio-and-check-box-div>
                            
                        <x-forms.basic-input label="Response" name="response[{{$question->id}}][response]" type="text" value="{{(isset($audit_answer) ? $audit_answer->response : '')}}" width="col-12" input-class="form-control-sm"></x-forms.basic-input>
        
                        <x-forms.text-area label="Remarks" name="response[{{$question->id}}][remarks]"  width="col-12" text-area-class="" cols="" rows="3">
                            {{(isset($audit_answer) ? $audit_answer->remarks : '')}}
                        </x-forms.text-area>
                        <x-forms.basic-input label="Attachments" name="response[{{$question->id}}][attachements][]" type="file" multiple  width="col-12" value="" input-class="multisteps-form__input"></x-forms.basic-input>
                    </div>
                    <div class="col-6" style="overflow: auto; height:400px">
                        @if (!empty($attachements))
                          <x-others.i-e-aduit-ans-attach-view label="Attachments" :attachements="$attachements" shouldDelete="true" shouldNotCollapse="true"></x-others.common-attach-view>
                        @endif
                    </div>
            </div>
            </div>
        </div>
        @endforeach

    </div>
    

    <input type="hidden" name="ie_audit_clause_id" value="{{$ieAuditClause->id}}">
    <input type="hidden" name="redirect" value="{{url()->current()}}">
    <x-forms.ajax-submit-btn div-class="col-12"  id="submit-button" btn-class="btn-sm btn-primary btn-ladda">Submit Answers</x-forms.ajax-submit-btn>
</form>