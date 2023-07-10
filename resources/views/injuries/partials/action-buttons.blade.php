
    <td class="text-sm">
        @can('injury.edit')
        <x-forms.action-btn href="{{route('injuries.edit',$injury['id'])}}" action="edit" title="edit injury"></x-forms.action-btn>
            
        @endcan
        @can('injury.view')
        <x-forms.action-btn href="{{route('injuries.show',$injury['id'])}}" action="view" title="view injury"></x-forms.action-btn>
            
        @endcan
        @can('injury.delete')
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete injury"
            data-action="{{route('injuries.destroy',$injury['id'])}}" data-parent="tr"></x-forms.action-btn>
            
        @endcan
    </td>
