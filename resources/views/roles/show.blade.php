@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="View / Edit Role">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('roles.index')}}">Roles List</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="View / Edit Role" page-desc="View / Edit Role">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4 bg-white-custom ">
          <div class="ms-auto my-auto">
            {{-- <a href="{{route('roles.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New Role</a> --}}
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
      <div class="card-body ">
        <form action="{{route('roles.store')}}" method="post" class="ajax-form">
        <div class="d-flex mb-3  bg-secondary text-light p-2 rounded">
            <span class="mt-2 ml-2 text-sm" style="width:100px"><strong>Role Name</strong></span>
            <input required type="text" name="role_name" id="role_name" readonly class="form-control form-control-sm" value="{{$role->name}}">
        </div>
    <h5>Permission</h5>
        @csrf
      <table class="table table-sm table-bordered table-striped">
        <tbody>
            <thead>
                <tr>
                    <th  class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">#</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">Permission</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">Index</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">View</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">Create</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">Edit</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">Delete</th>
                </tr>
            </thead>
            @foreach ($modules as $module)
            
           @if (!in_array('meta',$module))
               
            <tr>
                <td>{{$loop->iteration}}</td>
                <td class="d-flex"><span class="text-bold text-sm">{{$module['name']}}</span> <a class="px-2 text-success text-sm" href="#" id="select_all">Select All</a></td>
                <td><span class="text-sm"><x-forms.toggle-check label="" name="permissions[]"  value="{{$module['slug']}}.index" width="col-6" check-box-class="" id="{{$module['slug']}}.index" checked="{{$permissions->contains($module['slug'].'.index') ? 'true' : 'false'}}"></x-forms.toggle-check></span></td>
                <td><span class="text-sm"><x-forms.toggle-check label="" name="permissions[]"  value="{{$module['slug']}}.view" width="col-6" check-box-class="" id="{{$module['slug']}}.view" checked="{{$permissions->contains($module['slug'].'.view') ? 'true' : 'false'}}"></x-forms.toggle-check></span></td>
                <td><span class="text-sm"><x-forms.toggle-check label="" name="permissions[]"  value="{{$module['slug']}}.create" width="col-6" check-box-class="" id="{{$module['slug']}}.create" checked="{{$permissions->contains($module['slug'].'.create') ? 'true' : 'false'}}"></x-forms.toggle-check></span></td>
                <td><span class="text-sm"><x-forms.toggle-check label="" name="permissions[]"  value="{{$module['slug']}}.edit" width="col-6" check-box-class="" id="{{$module['slug']}}.edit" checked="{{$permissions->contains($module['slug'].'.edit') ? 'true' : 'false'}}"></x-forms.toggle-check></span></td>
                <td><span class="text-sm"><x-forms.toggle-check label="" name="permissions[]"  value="{{$module['slug']}}.delete" width="col-6" check-box-class="" id="{{$module['slug']}}.delete" checked="{{$permissions->contains($module['slug'].'.delete') ? 'true' : 'false'}}"></x-forms.toggle-check></span></td>
                
            </tr>
           @endif 

            @endforeach
            
        </tbody>
      </table>
      {{-- <input type="submit" value="subimt"> --}}
      <input type="hidden" name="redirect" value="{{url()->previous()}}">
      <input type="hidden" name="role_id" value="{{$role->id}}">
      @can(['role.edit'])
      <button class="btn bg-primary text-light text-bold ms-auto mb-0 btn-ladda" type="submit" title="Submit" data-style="expand-left">Submit</button>
      @endcan

     </form>

    </div>
      {{-- defautl slot end here --}}

   </x-templates.basic-page-temp>

@endsection
@section('script')
<script>    
$(document).ready(function() {
    // select all
    $('body').on('click','a#select_all','click',function(e){
        e.preventDefault();
        var siblingsCheckbox = $(this).parent().siblings().find('input');
        var siblingsSelectScope = $(this).parent().siblings().find('select');
        siblingsCheckbox.attr('checked','true');
        siblingsSelectScope.attr('required','true');
        $(this).text('Unsellect All');
        $(this).attr('id','unselect_all');
    })
    // unselect all
    $('body').on('click','a#unselect_all',function(e){
        e.preventDefault();
        var siblingsCheckbox = $(this).parent().siblings().find('input');
        var siblingsSelectScope = $(this).parent().siblings().find('select');
        siblingsCheckbox.removeAttr('checked');
        siblingsSelectScope.removeAttr('required');
        $(this).text('Select All');
        $(this).attr('id','select_all');
    })

    // makin scope mandatory incase a checkbox is selected in a module
    $('input:checkbox').on('click',function(){
        siblingSelectScope = $(this).parent().parent().siblings().find('select');
        allsiblings = $(this).parent().parent().siblings().find('input:checked');

        // if this input is checked then we make scope mandatory
        if ($(this).is(':checked')) {
           siblingSelectScope.attr('required','true');
        }else{
            // if its not checked but its any sibling checked then we still make scope mandoatry
            if (allsiblings.length > 0) {
             siblingSelectScope.attr('required','true');
            }else{
                siblingSelectScope.removeAttr('required');
            }
        }
    })

    // updating existing data into this view
  
});
</script>
@endsection