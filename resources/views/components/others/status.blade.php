@switch($status)
    @case(0)
    <span class="badge badge-success badge-sm">InActive</span>
        @break
    @case(1)
    <span class="badge badge-secondary badge-sm">Active</span>
        @break
    @default
    <span class="badge badge-primary badge-sm">Pending</span>
        
@endswitch