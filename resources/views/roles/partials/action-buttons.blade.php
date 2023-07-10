
    <td class="text-sm">
        @can('role.edit')
        <x-forms.action-btn href="{{route('roles.show',$role['id'])}}" action="edit" title="edit role"></x-forms.action-btn>
        @endcan

        {{-- <x-forms.action-btn href="" action="view" title="view role"></x-forms.action-btn> --}}
        {{-- <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete role"
            data-action="{{route('roles.destroy',$role['id'])}}" data-parent="tr"></x-forms.action-btn> --}}
    </td>
