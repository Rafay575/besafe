
<a href="{{$href}}" class="mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$title}}" data-container="body" data-animation="true" data-bs-original-title="{{$title}}" >
    @if ($action === 'view')
    
    @endif
    @switch($action)
        @case("view")
        <i class="fas fa-eye text-success" {{$attributes}}></i>
            @break
        @case("assign")
        <i class="fas fa-check-double text-success" {{$attributes}}></i>
            @break
        @case("edit")
      <i class="fas fa-user-edit text-purple" {{$attributes}}></i>
            @break
        @case("delete")
          <i class="fas fa-trash text-danger" {{$attributes}}></i>
            @break
        @case("download")
          <i class="fas fa-download text-success" {{$attributes}}></i>
            @break
        @default
        <i class="fas fa-eye text-secondary" {{$attributes}}></i>
    @endswitch
  </a>