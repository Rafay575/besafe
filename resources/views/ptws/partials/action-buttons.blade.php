
    <td class="text-sm">
        <x-forms.action-btn href="" action="edit" title="edit ptw"></x-forms.action-btn>
        <x-forms.action-btn href="" action="view" title="view ptw"></x-forms.action-btn>
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete ptw"
            data-action="{{route('ptws.destroy',$ptw['id'])}}" data-parent="tr"></x-forms.action-btn>
    </td>
