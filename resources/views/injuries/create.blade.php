@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Injury">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('injuries.index')}}">Injruies List</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        @include('injuries.partials.injury_form');
@endsection
@section('script')
<script src="{{asset('assets/js/plugins/multistep-form.js')}}"></script>

<script>
$(document).ready(function(){
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
          $('<td>').html('<input type="hidden" name="actions['+nextRowNo+'][sno]" value="'+nextRowNo+'"><input type="text" class="form-control form-control-sm" name="actions['+nextRowNo+'][description]">'),
            $('<td>').html('<input type="text" class="form-control form-control-sm" name="actions['+nextRowNo+'][responsibility]">'),
          $('<td>').html('<input type="text" class="form-control form-control-sm" name="actions['+nextRowNo+'][timeline]">'),
          $('<td>').html('<select name="actions['+nextRowNo+'][status]" class="form-control form-control-sm"><option value="active">Active</option><option value="inactive">InActive</option></select>'),
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
})
</script> 
@include('partials.location_script')

@endsection