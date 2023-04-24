<div class="form-check  form-switch {{$width}}">
    <input class="form-check-input {{$checkBoxClass}}" type="checkbox" value="{{$value}}" id="{{$name}}" name="{{$name}}" {{$checked === 'true' ? "checked" : "" }} {{ $attributes }} >
    <label class="form-control-label" for="{{$name}}">{{$label}}</label>
  </div>