
    <td class="text-sm">
        <x-forms.action-btn href="{{asset('reports/' . $report['file_name'])}}" action="download" title="download report"></x-forms.action-btn>
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete report"
            data-action="{{route('pdfreports.destroy',$report['id'])}}" data-parent="tr"></x-forms.action-btn>
    </td>
