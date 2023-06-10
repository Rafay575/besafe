<div class="table-responsive">
    <table class="table table-flush table-bordered">
        <thead class="thead-light bg-primary text-light">
            <x-table.tblhead heads="Audit Hall, Audit Type, Initiator,Audit Date,Audit Score"></x-table.tblhead>
        </thead>
        <tbody>
            <tr>
                <th>{{$ieAuditClause->audit_hall->hall_title}}</th>
                <th>{{$ieAuditClause->audit_type->audit_title}}</th>
                <th>{{$ieAuditClause->initiator->first_name}}</th>
                <th>{{$ieAuditClause->audit_date}}</th>
                <th>{{$ieAuditClause->audit_score}}%</th>
            </tr>
        </tbody>
    </table>
</div>

<hr>
<div class="audit_questions">
    {{-- <h5>Audit Questions</h5> --}}
    <div class="table-responsive">
        <table class="table table-flush table-bordered">
            <tbody>
                @foreach ($auditQuestions as $question)
                @php
                $attachements = [];
                $audit_answer = [];
                if($question->audit_answer){
                $audit_answer = $question->audit_answer->where('ie_audit_clause_id',$ieAuditClause->id)->first();
                if($audit_answer){
                $attachements = $audit_answer->attachements;
                }
                }
                @endphp

                <tr class="bg-primary">
                    <td>                        
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-bold">Question. {{$loop->iteration}}</td>
                    <td>{{$question->question}}</td>
                </tr>
                <tr>
                    <td class="text-bold">Answer</td>
                    <td>{{$audit_answer ? $audit_answer->yes_or_no ? 'Yes' : 'No' : 'Not yet answered'}}</td>
                </tr>
                <tr>
                    <td class="text-bold">Response</td>
                    <td>{{$audit_answer ? $audit_answer->response  : ''}}</td>
                </tr>
                <tr>
                    <td class="text-bold">Remarks</td>
                    <td>{{$audit_answer ? $audit_answer->remarks  : ''}}</td>
                </tr>
                <tr>
                    <td class="text-bold">Attachements</td>
                    <td>
                        <div class="w-50">
                            @if (!empty($attachements))
                            <x-others.i-e-aduit-ans-attach-view label="" :attachements="$attachements"
                                shouldDelete="false" shouldNotCollapse="true">
                                </x-others.common-attach-view>
                                @endif
                        </div>
                    </td>
                </tr>

    </div>
    @endforeach
    </tbody>
    </table>

    <button onclick="window.print()" class="btn btn-primary mt-5">Print</button>

</div>
