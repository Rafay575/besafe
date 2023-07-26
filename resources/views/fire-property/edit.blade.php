@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Fire / Property damage Create">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('fire-property.index')}}">Fire / Property damage List</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        @include('fire-property.partials.fire_property_new_form')

        <div class="row">
          <div class="col-12 col-sm-8 mx-auto">
              <div class="card p-0">
                  <div class="card-body row">
                    <x-others.common-attach-view label="Initial_Attachments" :attachements="$fire_property->initial_attachements" shouldDelete="true"></x-others.common-attach-view>
                    <x-others.common-attach-view label="Attachments" :attachements="$fire_property->attachements" shouldDelete="true"></x-others.common-attach-view>
                    {{-- <x-others.common-attach-view label="Interview" :attachements="$fire_property->interview_attachs" shouldDelete="true"></x-others.common-attach-view> --}}
                    {{-- <x-others.common-attach-view label="Records" :attachements="$fire_property->record_attachs" shouldDelete="true"></x-others.common-attach-view> --}}
                    {{-- <x-others.common-attach-view label="Photographs" :attachements="$fire_property->photograph_attachs" shouldDelete="true"></x-others.common-attach-view> --}}
                    {{-- <x-others.common-attach-view label="Other" :attachements="$fire_property->other_attachs" shouldDelete="true"></x-others.common-attach-view> --}}
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
          $('<td>').html('<input type="hidden" name="actions['+nextRowNo+'][sno]" value="'+nextRowNo+'"><input type="text" class="form-control form-control-sm" name="actions['+nextRowNo+'][description]">'),
          $('<td>').html('<input type="text" class="form-control form-control-sm" name="actions['+nextRowNo+'][responsibility]">'),
          $('<td>').html('<input type="text" class="form-control form-control-sm" name="actions['+nextRowNo+'][timeline]">'),
          $('<td>').html('<select name="actions['+nextRowNo+'][status]" class="form-control form-control-sm"><option value="pending">Pending</option><option value="closed">Closed</option></select>'),
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

      // total loss calculation
       // Calculate and update total loss on input change
        $('.direct_loss, .indirect_loss').on('input', function() {
          // Get the values of direct_loss and indirect_loss inputs
          var directLoss = parseFloat($('.direct_loss').val()) || 0;
          var indirectLoss = parseFloat($('.indirect_loss').val()) || 0;

          // Calculate the sum of direct_loss and indirect_loss
          var totalLoss = directLoss + indirectLoss;

          // Update the value of total_loss input
          $('.total_loss').val(totalLoss);
        });
        
      // toggle fire_categories
        $('body').on('change', 'select.fire_categories', function() {
          let propertyDamages =  $('select.property_damages');
          $(this).parent().parent().removeClass('is-disabled');
          propertyDamages.parent().parent().addClass('is-disabled');
          propertyDamages.val(null);
        });
      // toggle property demages
        $('body').on('change', 'select.property_damages', function() {
          let fireCategories = $('select.fire_categories');
          $(this).parent().parent().removeClass('is-disabled');
          fireCategories.parent().parent().addClass('is-disabled');
          fireCategories.val(null);
        });

     
    });


 
  </script>  
  @include('partials.location_script')

@endsection