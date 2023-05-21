
    <td class="text-sm">
        <x-forms.action-btn href="" action="edit" title="edit ie_aduit"></x-forms.action-btn>
        <x-forms.action-btn href="" action="view" title="view ie_aduit"></x-forms.action-btn>
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete ie_aduit"
            data-action="{{route('ie_audits.destroy',$ie_audit['id'])}}" data-parent="tr"></x-forms.action-btn>
    </td>
