<div class="form-check {{$width}}">
    <input class="form-check-input {{$radioBoxClass}}" type="radio" name="{{$name}}" value="{{$value}}" id="{{$name}}"  {{$checked === 'true' ? "checked" : "" }} {{ $attributes }} >
    <label class="form-control-label" for="{{$name}}">{{$label}}</label>
  </div>