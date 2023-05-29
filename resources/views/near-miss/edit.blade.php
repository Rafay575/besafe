@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Near-Miss Create">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('near-miss.index')}}">Near-Miss List</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')

@include('near-miss.partials.near_miss_create_form')


<div class="row">
    <div class="col-12 col-sm-8 mx-auto">
        <div class="card p-0">
            <div class="card-body row">
              <x-others.common-attach-view label="Attachments" :attachements="$near_miss->attachements" shouldDelete="true"></x-others.common-attach-view>
            </div>
          </div>
    </div>

</div>
@endsection
@section('script')
<script src="{{asset('assets/js/plugins/multistep-form.js')}}"></script>

<script>
$(document).ready(function() {
    // Add record button click event
    $('#addRecordButton').click(function() {
      // Check if the number of rows exceeds 5
      let countRows = $('#actionTable tbody tr').length;
      let nextRowNo = countRows + 1;
      if (countRows >= 5) {
        alert('Maximum 5 records allowed.');
        return;
      }
      
      // Get the table body
      var tableBody = $('#actionTable tbody');
      
      // Create a new row with form inputs
      var newRow = $('<tr>').append(
        $('<td>').html('<input type="hidden" name="actions['+nextRowNo+'][sno]" value="'+nextRowNo+'"><input type="text" class="form-control form-control-sm" name="actions['+nextRowNo+'][action]">'),
        $('<td>').html('<input type="text" class="form-control form-control-sm" name="actions['+nextRowNo+'][responsible]">'),
        $('<td>').html('<input type="date" class="form-control form-control-sm" name="actions['+nextRowNo+'][target_date]">'),
        $('<td>').html('<input type="date" class="form-control form-control-sm" name="actions['+nextRowNo+'][actual_completion]">'),
        $('<td>').html('<input type="text" class="form-control form-control-sm" name="actions['+nextRowNo+'][remarks]">'),
        $('<td>').html('<span class="btn btn-sm btn-danger deleteActionRecord">X</span>')
      );
      
      // Append the new row to the table body
      tableBody.append(newRow);
    });
    
    // Delete record button click event
    $(document).on('click', '.deleteActionRecord', function() {
      // Get the table row to be removed
      var row = $(this).closest('tr');
      
      // Remove the row from the table
      row.remove();
    });

   
  });
</script>   
@endsection