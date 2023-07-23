

<?php
$ptw_types = $ptw->ptw_types->pluck('ptw_type_title')->toArray();
// $ptw_types = ["LPG PTW Check List", "Work at Height", "Electric Work (Machine/ Isolation)", "Demolition/ Excavation & Civil Work", "Electrical Work (HT/LT/DBP & Transformer)", "Hot Work"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTW View</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }


    </style>
</head>
<body>
    <div class="content" style="position: relative;">

        <h1 style="position: absolute; left: {{615 + 90}}px;top: {{130 + 27}}px;">{{$ptw->id}}</h1>

        <h5 style="position: absolute; left: {{600 + 90}}px;top: {{162 + 32}}px;">{{$ptw->date}}</h5>
        <h5 style="position: absolute; left: {{610 + 100}}px;top: {{177 + 35}}px;">{{$ptw->start_time}}</h5>
        <h5 style="position: absolute; left: {{610 + 100}}px;top: {{194 + 40}}px;">{{$ptw->end_time}}</h5>

        <h5 style="position: absolute; left: {{820 + 140}}px;top: {{162 + 33}}px;">{{$ptw->work_area}}</h5>
        <h5 style="position: absolute; left: {{710 + 120}}px;top: {{162 + 33}}px;">{{$ptw->line_machine}}</h5>
        {{--  ptw exist yes --}}
        <h3 style="position: absolute; left: {{743 + 125}}px;top: {{180 + 35}}px;">{!!$ptw->is_ptw_exist ? '&#10004;' : ''!!}</h3> 
        {{-- ptw exist no --}}
        <h3 style="position: absolute; left: {{710 + 118}}px;top: {{180 + 35}}px;">{!!$ptw->is_ptw_exist ? '' : '&#10004;'!!}</h3>
        <h5 style="position: absolute; left: {{780 + 115}}px;top: {{195 + 40}}px;">{{$ptw->cross_reference}}</h5>

        {{-- moc required yes --}}
        <h3 style="position: absolute; left: {{1003 + 167}}px;top: {{162 + 35}}px;">{!!$ptw->moc_required ? '&#10004;' : ''!!}</h3>

        {{-- moc required no --}}
        <h3 style="position: absolute; left: {{1030 + 167}}px;top: {{162 + 35}}px;">{!!$ptw->moc_required ? '' : '&#10004;'!!}</h3>

        <h5 style="position: absolute; left: {{955 + 150}}px;top: {{180 + 33}}px;">{{$ptw->moc_desc}}</h5>
        <h5 style="position: absolute; left: {{965 + 160}}px;top: {{195 + 35}}px;">{{$ptw->moc_title}}</h5>


        <div class="h5" style="position: absolute; left:{{ 580 + 100}}px;top: {{235 + 40}}px; width: 400px;line-height: 20px; height: 40px;overflow: hidden;">
            <span>{{$ptw->work_desc}}</span>
        </div>

        <h5 style="position: absolute; left: {{925 + 160}}px;top: {{265 + 47}}px;">{{$ptw->working_group}}</h5>
        <h5 style="position: absolute; left: {{580 + 100}}px;top: {{265 + 47}}px;">{{$ptw->worker_name}}</h5>


        <h5 style="position: absolute; left: {{580 + 95}}px;top: {{265 + 75}}px;">{!! in_array('Hot Work', $ptw_types) ? '&#10004;' : '' !!}</h5>
        <h5 style="position: absolute; left: {{580 + 95}}px;top: {{265 + 95}}px;">{!! in_array('Electrical Work (HT/LT/DBP & Transformer)', $ptw_types) ? '&#10004;' : '' !!}</h5>
        <h5 style="position: absolute; left: {{580 + 95}}px;top: {{265 + 112}}px;">{!! in_array('Demolition/ Excavation & Civil Work', $ptw_types) ? '&#10004;' : '' !!}</h5>

        <h5 style="position: absolute; left: {{925 + 25}}px;top: {{265 + 75}}px;">{!! in_array('Electric Work (Machine/ Isolation)', $ptw_types) ? '&#10004;' : '' !!}</h5>
        <h5 style="position: absolute; left: {{925 + 25}}px;top: {{265 + 95}}px;">{!! in_array('Work at Height', $ptw_types) ? '&#10004;' : '' !!}</h5>
        <h5 style="position: absolute; left: {{925 + 25}}px;top: {{265 + 112}}px;">{!! in_array('LPG PTW Check List', $ptw_types) ? '&#10004;' : '' !!}</h5>



       <img src="{{asset('layout/ptw/page_1_v2.jpg')}}" alt="" width="99%">
       <img src="{{asset('layout/ptw/page_2.jpg')}}" alt="" width="99%">


    </div>
</body>
</html>
