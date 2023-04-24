<div class="form-group {{$divClass}}">
  @if ($label != "")
  <label for="{{$name}}" class="form-control-label">{{$label}}</label>
  @endif
<select class="form-control {{$selectClass}}" name="{{$name}}" id="choices-button" {{$attributes}}>
    @if ($attributes->has('multiple'))
    @else   
    <option selected disabled>Select {{$label}}</option>
    @endif
   {{$slot}}
  </select>
</div> 