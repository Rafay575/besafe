@php
    $reportTitle = "Internal External Audits";
@endphp

@include('pdf.layout.header')

    <table class="table">
      <thead>
        <tr>
            <th>Hall Title</th>
            <th>Audit Type</th>
            <th>Initiated By</th>
            <th>Audit Date</th>
            <th>Audit Score</th>
            <th>Created_at</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $ieAuditClause)
            <tr>
                <td>{{$ieAuditClause->audit_hall->hall_title}}</td>
                <td>{{$ieAuditClause->audit_type->audit_title}}</td>
                <td>{{$ieAuditClause->initiator->first_name}}</td>
                <td>{{$ieAuditClause->audit_date}}</td>
                <td>{{$ieAuditClause->audit_score}}%</td>
                <td>{{ $ieAuditClause->created_at->format('m-d-Y') }}</td>
 
            </tr>
        @endforeach
    </tbody>
      </table>
    
    
  @include('pdf.layout.footer')
