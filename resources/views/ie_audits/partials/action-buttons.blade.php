
    <td class="text-sm">
        @can('ie_audit_cluase.edit')
        
        <x-forms.action-btn href="{{route('audit_init.edit',$ie_audit['id'])}}" action="edit" title="edit ie_aduit"></x-forms.action-btn>
        @endcan
        @can('ie_audit_cluase.view')
        <x-forms.action-btn href="{{route('audit_init.show',$ie_audit['id'])}}" action="view" title="view ie_aduit"></x-forms.action-btn>
            
        @endcan
        @can('ie_audit_cluase.delete')
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete ie_aduit"
            data-action="{{route('ie_audits.destroy',$ie_audit['id'])}}" data-parent="tr"></x-forms.action-btn>
            
        @endcan
    </td>
