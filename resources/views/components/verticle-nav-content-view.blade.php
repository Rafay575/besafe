<div class="tab-pane fade show {{$attributes['isActive'] ? 'active' : ''}}" id="{{\Illuminate\Support\Str::slug($attributes['title'])}}" role="tabpanel"
aria-labelledby="{{\Illuminate\Support\Str::slug($attributes['title'])}}">
<!-- Add your content here -->
{{$slot}}
</div>