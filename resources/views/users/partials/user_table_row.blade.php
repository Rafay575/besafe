
@foreach ($users as $user)
    
<tr>
    <td class="text-sm">
        <div class="d-flex px-2 py-1">
            <div>
                <img src="{{asset('assets/img/team-2.jpg')}}" class="avatar avatar-sm me-3" alt="avatar image">
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm">Kashif Khan</h6>
            </div>
        </div>
    </td>
    <td class="text-sm">kashifbmk</td>
    <td class="text-sm">smevkpathan@gmail.com</td>
    <td class="text-sm">Admin</td>
    <td>
        <x-others.status status="1"></x-others.status>
    </td>
    <td class="text-sm">
        <x-forms.action-btn href="" action="edit" title="edit user"></x-forms.action-btn>
        <x-forms.action-btn href="" action="view" title="view user"></x-forms.action-btn>
        <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete user"
            data-action="{{route('users.destroy',1)}}" data-parent="tr"></x-forms.action-btn>
    </td>
</tr>
@endforeach
