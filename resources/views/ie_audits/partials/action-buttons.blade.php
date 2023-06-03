
    <td class="text-sm">
        <x-forms.action-btn href="{{route('audit_init.edit',$ie_audit['id'])}}" action="edit" title="edit ie_aduit"></x-forms.action-btn>
        <x-forms.action-btn href="{{route('ie_audits.show',$ie_audit['id'])}}" action="view" title="view ie_aduit"></x-forms.action-btn>
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete ie_aduit"
            data-action="{{route('ie_audits.destroy',$ie_audit['id'])}}" data-parent="tr"></x-forms.action-btn>
    </td>
