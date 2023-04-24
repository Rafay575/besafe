    @php
        $ths = explode(",",$heads);
    @endphp
<tr>
    @foreach ($ths as $th)
        <th {{$attributes}}>{{$th}}</th>
    @endforeach
</tr>