<div class="tab-pane fade show {{Str::slug($attributes['title'])}} " id="{{Str::slug($attributes['title'])}}" role="tabpanel"
aria-labelledby="{{Str::slug($attributes['title'])}}">
<!-- Add your content here -->
{{$slot}}
</div>