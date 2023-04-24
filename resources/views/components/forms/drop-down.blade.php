<div class="dropdown">
    <button class="btn  dropdown-toggle {{$btnClass}}" type="button" id="{{$id}}" data-bs-toggle="dropdown" aria-expanded="false" {{$attributes}}>
      {{$label}}
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
     {{$slot}}
    </ul>
  </div>