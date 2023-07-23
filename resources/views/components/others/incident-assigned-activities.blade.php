@if ($attributes->has('displayAsCard') && $attributes['displayAsCard'] == "true")
{{-- card starts here --}}
<div class="card h-100 d-print-none">
    @if ($attributes->has('label') && $attributes['label'] != "")
        <div class="card-header pb-0">
             <h6>{{$attributes['label']}}</h6>
        </div>
    @endif
    <div class="card-body">
@endif
    @if ($attributes->has('label') && $attributes['label'] != "" && $attributes['displayAsCard'] != 'true')
            <h6>{{$attributes['label']}}</h6>
    @endif

    @if ($incident->assignedUsers->count() > 0)
        <div class="timeline timeline-one-side">
            <div class="timeline-block mb-3">
                @php
                    $user = $incident->assignedUsers->first()->assignBy;
                @endphp
            <img alt="Image placeholder" class="avatar rounded-circle timeline-step" src="{{($user->image != "") ? asset('images/profile/' . $user->image) : asset('images/profile/User.ico') }}">
            <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">Assigned to {{$incident->assignedUsers->first()->assignBy->first_name}} by System and the status is Pending</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{$incident->created_at}}</p>
            </div>
            </div>                          
        </div>

        @foreach ($incident->assignedUsers as $usersAssigned)
            <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                    @php
                    $user = $usersAssigned->assignTo;
                @endphp
               <img alt="Image placeholder" class="avatar rounded-circle timeline-step" src="{{($user->image != "") ? asset('images/profile/' . $user->image) : asset('images/profile/User.ico') }}">
                <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Assigned to {{$usersAssigned->assignTo->first_name}} by {{$usersAssigned->assignBy->first_name}} and the status is Assigned as of now</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{$usersAssigned->updated_at}}</p>
                </div>
                </div>                          
            </div>
        @endforeach
        
        <div class="timeline timeline-one-side">
            <div class="timeline-block mb-3">
                @php
                    $user = $incident->assignedUsers->last()->assignTo;
                @endphp
             <img alt="Image placeholder" class="avatar rounded-circle timeline-step" src="{{($user->image != "") ? asset('images/profile/' . $user->image) : asset('images/profile/User.ico') }}">
            <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">{{$user->first_name}} is working on and the status is {{$incident->incident_status->status_title}}</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{$incident->updated_at}}</p>
            </div>
            </div>                          
        </div>


    @else
    <div class="timeline timeline-one-side">
      <div class="timeline-block mb-3">
        <img alt="Image placeholder" class="avatar rounded-circle timeline-step" src="{{asset('website/img/logo-mini.png') }}">
        <div class="timeline-content">
          <h6 class="text-dark text-sm font-weight-bold mb-0">Pending With Admin</h6>
          <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{$incident->updated_at}}</p>
        </div>
      </div>                          
    </div>
        
    @endif
    

@if ($attributes->has('displayAsCard') && $attributes['displayAsCard'] === 'true')
    </div>{{-- card body --}}
</div>
{{-- card end here --}}

@endif