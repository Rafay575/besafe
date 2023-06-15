@php
      $file_name = $ptw->getTable() . "_" . $ptw->id . ".pdf";
      $public_path = asset('reports/ptws/' . $file_name);
      $file_path = public_path('reports/ptws/' . $file_name);
@endphp
    <td class="text-sm">
       
        <x-forms.action-btn href="{{route('ptws.edit',$ptw['id'])}}" action="edit" title="edit ptw"></x-forms.action-btn>
        <x-forms.action-btn href="{{route('ptws.show',$ptw['id'])}}" action="view" title="view ptw"></x-forms.action-btn>
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete ptw"
            data-action="{{route('ptws.destroy',$ptw['id'])}}" data-parent="tr"></x-forms.action-btn>

        @if (file_exists($file_path))
        <x-forms.action-btn href="{{$public_path}}" action="download" title="download ptw"></x-forms.action-btn>
        @endif
    </td>
