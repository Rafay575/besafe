
    <td class="text-sm">
        @can('hazard.edit')
            
        <x-forms.action-btn href="{{route('hazards.edit',$hazard['id'])}}" action="edit" title="edit hazard"></x-forms.action-btn>
        @endcan
        @can('hazard.view')
        <x-forms.action-btn href="{{route('hazards.show',$hazard['id'])}}" action="view" title="view hazard"></x-forms.action-btn>
            
        @endcan
        @can('hazard.delete')
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete hazard"
            data-action="{{route('hazards.destroy',$hazard['id'])}}" data-parent="tr"></x-forms.action-btn>
        @endcan
    </td>
