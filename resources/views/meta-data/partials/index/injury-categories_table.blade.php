@php
$collection = $injuryCategories;
$title_field = "injury_category_title";
$desc_field = "injury_category_desc";
$meta_data_name = "injury_categories";
$heads = "S.No,incident injury category ID,incident injury category title,Group,Date Created,Actions";
@endphp

<div class="d-flex justify-content-between">
  <h5>
    {{ucfirst(str_replace('_'," ",$meta_data_name))}}
  </h5>
  <a href="{{ route('meta-data.create', $meta_data_name)}}" class="btn btn-sm btn-primary align-right">Add</a>
</div>


<div class="table-responsive">
<table class="table table-flush datatable" id="datatable">
  <thead class="thead-light">
    <x-table.tblhead :heads=$heads></x-table.tblhead>
  </thead>
  <tbody>
    @foreach ($collection as $meta_data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$meta_data->id}}</td>
            <td>{{$meta_data->$title_field}}</td>
            <td>{{$meta_data->group_name}}</td>
            <td>{{$meta_data->created_at}}</td>
            <td class="text-sm">
                <x-forms.action-btn href="{{ route('meta-data.edit', ['meta_data_id' => $meta_data->id, 'meta_data_name' => $meta_data_name]) }}" action="edit" title="edit {{$meta_data_name}}"></x-forms.action-btn>
                <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete {{$meta_data_name}}"
                    data-action="{{ route('meta-data.destroy', ['meta_data_id' => $meta_data->id, 'meta_data_name' => $meta_data_name]) }}
                    " data-parent="tr"></x-forms.action-btn>
            </td>
        </tr>
    @endforeach

  </tbody>
  
</table>
</div>