<div class="form-group {{$width}}">
    <label class="form-control-label" for="{{$name}}">{{$label}}</label>
    <textarea class="form-control {{$textAreaClass}}" id="{{$name}}" name="{{$name}}" cols="{{$cols}}" rows="{{$rows}}" {{$attributes}}>{{$slot}}</textarea>
  </div>