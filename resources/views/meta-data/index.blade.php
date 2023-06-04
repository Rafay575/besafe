@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Meta Data">
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="Meta Data" page-desc="Meta Data">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
    <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
                {{-- <a href="{{route('fire-property.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp;
                New damage</a> --}}
            </div>
        </div>
        </x-slot>
        {{-- x slot page header ends here --}}

        {{-- default slot starts here --}}
        <div class="row container mb-5">
           <x-verticle-nav-view>
            <x-slot:heads>
              @foreach ($menus as $menu)
                 <x-verticle-nav-link-view title="{{$menu}}" isActive="{{$loop->iteration == 1 ? 'hello' : ''}}"></x-verticle-nav-link-sview>
              @endforeach
            </x-slot:heads>

            <x-slot:contents>

            @foreach ($menus as $menu)
                  @php
                      $menu_slug = \Illuminate\Support\Str::slug($menu).'_table';
                      $menu_view = "meta-data.partials.index.{$menu_slug}";
                  @endphp
                  <x-verticle-nav-content-view title="{{$menu}}" isActive="{{$loop->iteration == 1 ? 'hello' : ''}}">
                      @include($menu_view)    
                  </x-verticle-nav-content-sview>
              @endforeach
              
            </x-slot:contents>
           </x-verticle-nav-view>
        </div>
        {{-- defautl slot end here --}}

</x-templates.basic-page-temp>

@endsection

@section('script')
<script>

const table = $('.datatable');
  table.DataTable({
    serverSide: false,
  });
  

</script>
@endsection
