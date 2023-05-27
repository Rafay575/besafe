
    <td class="text-sm">
        {{-- assign should be visible for those to whom it is assigned or if the status is pending --}}
        @if(auth()->user()->id === optional($incident->assignedUsersAll->where('form_name', $incident->form_name)->last()->assign_to ?? null) or $incident->incident_status->status_code === 0)
            <x-forms.action-btn data-bs-toggle="modal"  data-bs-target="#assignUserToIncident"  href="#" id="table_data_assign" action="assign" title="Assign {{$incident['incident_name']}}"
            data-object_id="{{$incident['id']}}" 
            data-department_id="{{$incident->initiator->meta_department_id}}" 
            data-assign_to="{{$incident->assignedUsersAll->where('form_name', $incident->form_name)->last()->assign_to ?? ''}}"
            data-assign_by="{{$incident->assignedUsersAll->where('form_name', $incident->form_name)->last()->assign_by ?? ''}}"
            data-allowed_assign="{{$incident->assignedUsersAll->where('form_name', $incident->form_name)->last()->allowed_assign ?? ''}}"
            data-route_name="{{$incident['route_name']}}"  
            data-incident_name="{{$incident['incident_name']}}"  
            ></x-forms.action-btn>
        @endif

        {{-- edit should be visible to admin, or to whom it is assigned --}}
        @if(auth()->user()->can($incident->perm_name.".delete") or auth()->user()->id === optional($incident->assignedUsersAll->where('form_name', $incident->form_name)->last()->assign_to ?? null))
         <x-forms.action-btn href="{{route($incident['route_name'].'.edit',$incident['id'])}}" action="edit" title="edit {{$incident['incident_name']}}"></x-forms.action-btn>
        @endif
        
        <x-forms.action-btn href="{{route($incident['route_name'].'.show',$incident['id'])}}" action="view" title="view {{$incident['incident_name']}}"></x-forms.action-btn>
       
        @can($incident->perm_name.".delete")
            <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete {{$incident['incident_name']}}"
            data-action="{{route($incident['route_name'].'.destroy',$incident['id'])}}" data-parent="tr"></x-forms.action-btn>
        @endcan
    </td>
   
