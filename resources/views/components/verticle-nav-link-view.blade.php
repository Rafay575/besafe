<li class="nav-item">
    <a class="nav-link mb-0 px-0 py-1 {{$attributes['isActive'] ? 'active' : ''}}" data-bs-toggle="tab" href="#{{\Illuminate\Support\Str::slug($attributes['title'])}}"
        role="tab" aria-controls="preview" aria-selected="true">
       {{$attributes['title']}}
    </a>
</li>