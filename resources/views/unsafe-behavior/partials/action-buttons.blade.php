
    <td class="text-sm">
        <x-forms.action-btn href="" action="edit" title="edit unsafe behavior"></x-forms.action-btn>
        <x-forms.action-btn href="" action="view" title="view unsafe behavior"></x-forms.action-btn>
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete unsafe behavior"
            data-action="{{route('unsafe-behaviors.destroy',$unsafe_behavior['id'])}}" data-parent="tr"></x-forms.action-btn>
    </td>
