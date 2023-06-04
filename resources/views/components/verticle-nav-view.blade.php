 {{-- nav_bar --}}
 <div class="col-2" style="max-height: 700px; overflow:auto;">
     <div class="nav-wrapper position-relative end-0">
         <ul class="nav nav-pills nav-fill flex-column p-1 shadow" role="tablist">
             {{$heads}}
         </ul>
     </div>
 </div>
 {{-- content --}}
 <div class="col-10">
     <!-- Content Containers -->
     <div class="card">
         <div class="card-body">
             <div class="tab-content">
                 {{$contents}}
             </div>
         </div>
     </div>

 </div>
