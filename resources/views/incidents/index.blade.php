@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Incident List">
</x-templates.bread-crumb>
@endsection

@section('content')

  <x-templates.basic-page-temp page-title="Incidents" page-desc="List of Incidents">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush" id="incidents-table" data-source="{{route('incidents.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Incident Name, Initiated By, Incident Status, Created at, Updated at,Action"></x-table.tblhead>
              </thead>
              <tbody>
                
              </tbody>
             
            </table>
        </div>
      {{-- defautl slot end here --}}

   </x-templates.basic-page-temp>

  

{{-- modals --}}
    <x-modals.basic-modal title="Assign User" id="assignUserToIncident" footer="no" header="yes" class="modal fade modal-md">
        <form method="POST" class="ajax-form row" action="{{route('incidents.storeByIncidentName')}}">
          @csrf
            <div class="col-12 col-sm-6 form-group">
                <label for="assign_by" class="col_form_label">Assigend By</label>
                <select name="assign_by" class="form-control-sm departmentUsersAssignBy">
                </select>
              </div>
          <div class="col-12 col-sm-6 form-group">
            <label for="assign_to" class="col_form_label">Assigend To</label>
            <select name="assign_to" class="form-control-sm departmentUsers" >
            </select>
          </div>
          <div class="col-12 col-sm-6 form-group">
            <input type="hidden" name="incident_name" id="incident_name" value="">
            <input type="hidden" name="incident_id" id="incident_id" value="">
            <input type="hidden" name="redirect" value="{{url()->current()}}">
            <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" type="submit" title="Send" data-style="expand-left">Submit</button>
          </div>
        </form>
    </x-modals.basic-modal>
<!-- Modal -->
@endsection
@section('script')
<script>

$(document).ready(function() {
  const table  = $('#incidents-table');
  const DataSource = table.attr('data-source');
  
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },

    columns: [
      
        {data: 'sno', name: 'sno'},
        {data: 'incident_name', name: 'incident_name'},
        {data: 'initiated_by', name: 'initiated_by'},
        {data: 'incident_status', name: 'incident_status'},
        {data: 'created_at', name: 'created_at'},
        {data: 'updated_at', name: 'updated_at'},
        { data: 'action', name: 'action', orderable: false, searchable: false }

    ],
    
  });
  
// assigning user
$('body').on('click','#table_data_assign',function(){
    let objectId = $(this).attr('data-object_id');
    let route_name = $(this).attr('data-route_name');
    let department_id = $(this).attr('data-department_id');
    let assignedTo = $(this).attr('data-assign_to');
    let assignedBy = $(this).attr('data-assign_by');
    let allowed_assign = $(this).attr('data-allowed_assign');
    let incident_name = $(this).attr('data-incident_name');
    // Call the fetchUsers function to populate the select options
    fetchUsersAndMapToChoices(department_id,assignedTo,assignedBy,incident_name,objectId);
});

function fetchUsersAndMapToChoices(department_id,assignedTo,assignedBy,incident_name,objectId) {
  // Send an AJAX request to fetch the users
  var data = {
    department_id: department_id
  };
  $.ajax({
    url: "{{ route('users.department_users') }}",
    method: "GET",
    data: data,
    success: function(response) {
      // Handle the success response
      let users = response;
      const selectOptionAssignedTo = new Choices('.departmentUsers');
      const selectOptionAssignBy= new Choices('.departmentUsersAssignBy');

      

      $('input#incident_name').val(incident_name);
      $('input#incident_id').val(objectId);
      let mappedUsersForAssignBy = users.filter(function(user) {
        if (user.id === assignedBy) {
            return {
            value: user.id,
            label: user.first_name,
            selected: true,
            disabled: false // Set the disabled property as needed
            };
        }
        });

        // Check if the mappedUsersForAssignBy array is empty
        if (mappedUsersForAssignBy.length === 0) {
        // Add the default option for the currently logged-in user
        mappedUsersForAssignBy.push({
            value: "{{auth()->user()->id}}",
            label: "{{auth()->user()->first_name}}",
            selected: true,
            disabled: false // Set the disabled property as needed
        });
        }

        let mappedUsersForAssignTo = users.map(function(user) {
            return {
            value: user.id,
            label: user.first_name,
            selected: user.id == assignedTo,
            disabled: false  // Set the disabled property as needed
            };
        });



      selectOptionAssignedTo.setChoices(mappedUsersForAssignTo);
      selectOptionAssignBy.setChoices(mappedUsersForAssignBy);
      
    },
    error: function(xhr, status, error) {
      // Handle the error response
      console.error(error);
    }
  });
}




});
</script>
@endsection