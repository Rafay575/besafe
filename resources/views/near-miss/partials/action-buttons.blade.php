
    <td class="text-sm">
        <x-forms.action-btn href="" action="edit" title="edit near miss"></x-forms.action-btn>
        <x-forms.action-btn href="" action="view" title="view near miss"></x-forms.action-btn>
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete near miss"
            data-action="{{route('near-miss.destroy',$near_miss['id'])}}" data-parent="tr"></x-forms.action-btn>
    </td>
