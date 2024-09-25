
    <td class="text-sm">
        @can('unsafe_behavior.edit')
        <x-forms.action-btn href="{{route('designations.edit',$designations['id'])}}" action="edit" title="edit unsafe behavior"></x-forms.action-btn>
        @endcan

{{--
        @can('unsafe_behavior.view')
        <x-forms.action-btn href="{{route('designations.show',$designations['id'])}}" action="view" title="view unsafe behavior"></x-forms.action-btn>
        @endcan
--}}

        @can('unsafe_behavior.delete')
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete designation"
        data-action="{{route('designations.destroy',$designations['id'])}}" data-parent="tr"></x-forms.action-btn>
        @endcan
    </td>
