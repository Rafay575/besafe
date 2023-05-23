<div class="form-group {{$width}}">
  @if ($label != "")
    <label for="{{$name}}" class="form-control-label">{{$label}}</label>
  @endif
    <input type="{{$type}}" class="form-control {{$inputClass}}" name="{{$name}}" id="{{$name}}" placeholder="{{$label}}" value="{{$value}}" {{ $attributes }} @if(isset($required) && $required) required @endif >
  </div>