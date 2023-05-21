
    <td class="text-sm">
        <x-forms.action-btn href="" action="edit" title="edit hazard"></x-forms.action-btn>
        <x-forms.action-btn href="" action="view" title="view hazard"></x-forms.action-btn>
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete hazard"
            data-action="{{route('hazards.destroy',$hazard['id'])}}" data-parent="tr"></x-forms.action-btn>
    </td>
