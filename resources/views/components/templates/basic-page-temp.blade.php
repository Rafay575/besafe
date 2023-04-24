<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">{{$pageTitle}}</h5>
                <p class="text-sm mb-0">
                 {{$pageDesc}}
                </p>
              </div>
              {{$pageHeader}}
            </div>
          </div>
        <div class="card-body px-0 pb-0">
         {{$slot}}
        </div>
    </div>
  </div>
</div>