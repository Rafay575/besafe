<div class="form-group {{$width}}">
  @if ($label != "")
    <label for="{{$name}}" class="form-control-label">{{$label}}</label>
  @endif
    <input type="{{$type}}" class="form-control {{$inputClass}}"{{ $attributes }} name="{{$name}}" id="{{$name}}" placeholder="{{$label}}" value="{{$value}}" >
  </div>