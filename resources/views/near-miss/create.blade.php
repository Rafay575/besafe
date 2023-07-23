@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Near-Miss Create">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('near-miss.index')}}">Near-Miss List</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        @include('near-miss.partials.near_miss_create_form')
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
  
  
  
  
      // Add record button click event
      $('#addPersonRecordButton').click(function() {
        // Check if the number of rows exceeds 5
        let countRows = $('#personTable tbody tr').length;
        let nextRowNo = countRows + 1;
        if (countRows >= 5) {
          alert('Maximum 5 records allowed.');
          return;
        }
        
        // Get the table body
        var tableBody = $('#personTable tbody');
        
        // Create a new row with form inputs
        var newRow = $('<tr>').append(
          $('<td>').html('<input type="hidden" name="persons['+nextRowNo+'][sno]" value="'+nextRowNo+'"><input type="text" class="form-control form-control-sm" name="persons['+nextRowNo+'][employee_id]">'),
          $('<td>').html('<input type="text" class="form-control form-control-sm" name="persons['+nextRowNo+'][name]">'),
          $('<td>').html('<input type="text" class="form-control form-control-sm" name="persons['+nextRowNo+'][department]">'),
          $('<td>').html('<input type="text" class="form-control form-control-sm" name="persons['+nextRowNo+'][designation]">'),
          $('<td>').html('<input type="text" class="form-control form-control-sm" name="persons['+nextRowNo+'][contact_no]">'),
          $('<td>').html('<select name="persons['+nextRowNo+'][health_status]" class="form-control form-control-sm"><option value="injured">Injured</option><option value="healthy">Healthy</option></select>'),
          $('<td>').html('<span class="btn btn-sm btn-danger deletePersonRecord">X</span>')
        );
        
        // Append the new row to the table body
        tableBody.append(newRow);
      });
      
      // Delete record button click event
      $(document).on('click', '.deletePersonRecord', function() {
        // Get the table row to be removed
        var row = $(this).closest('tr');
        
        // Remove the row from the table
        row.remove();
      });
  
     
    });
  
  
  
  
  
    function togglePersonTableVisibility() {
      $('input.person_involved').on('change', function() {
          let selectedVal = $('input.person_involved:checked').val();
          if (selectedVal == 1) {
              $('div.personTableDiv').removeClass('d-none');
          } else {
              $('div.personTableDiv').addClass('d-none');
          }
      });
  }
  
  // Call the function to initialize the event listener
  togglePersonTableVisibility();
  
  // Show/hide the div based on the default checked radio button on page load
  $(document).ready(function() {
      let defaultSelectedVal = $('input.person_involved:checked').val();
      if (defaultSelectedVal == 1) {
          $('div.personTableDiv').removeClass('d-none');
      } else {
          $('div.personTableDiv').addClass('d-none');
      }
  });
  
  </script>  

@include('partials.location_script')

@endsection