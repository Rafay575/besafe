
    <td class="text-sm">
        <x-forms.action-btn href="{{route('fire-property.edit',$fpdamage['id'])}}" action="edit" title="edit fire property damage"></x-forms.action-btn>
        <x-forms.action-btn href="{{route('fire-property.show',$fpdamage['id'])}}" action="view" title="view fire property damage"></x-forms.action-btn>
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete fire property damage"
            data-action="{{route('fire-property.destroy',$fpdamage['id'])}}" data-parent="tr"></x-forms.action-btn>
    </td>
