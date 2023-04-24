<tr>
    @php
        $heads = explode($heads,',')
    @endphp
    @foreach ($heads as $head)
        <th>{{$head}}</th>
    @endforeach
</tr>