@can('meta_data.edit')
    
<x-forms.action-btn data-bs-toggle="modal" id="meta_data_edit_button" data-meta_data_obj="{{json_encode($meta_data->toArray())}}"  data-title_field="{{$title_field}}"  data-meta_data_name="{{$meta_data_name}}" data-bs-target="#metaDataEdit" href="#" action="edit" title="edit {{$meta_data_name}}"></x-forms.action-btn>
@endcan

@can('meta_data.delete')
    
<x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete {{$meta_data_name}}"
                        data-action="{{ route('meta-data.destroy', ['meta_data_id' => $meta_data->id, 'meta_data_name' => $meta_data_name]) }}
                        " data-parent="tr"></x-forms.action-btn>
@endcan