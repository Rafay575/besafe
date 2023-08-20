@extends('layouts.main')
@can('dashboard.view')
    
@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm">
      <a class="text-white" href="javascript:;">
        <i class="ni ni-box-2"></i>
      </a>
    </li>
    <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Dashoard</a></li>
  </ol>
  <h6 class="font-weight-bolder mb-0 text-white">Dashboard</h6>
</nav>
@endsection
@section('content')

  @include('dashboard.partials.top_stats')
  <div class="row mb-3">
    <div class="col-1 col-sm-4">

    </div>
    <div class="col-sm-4 col-5">
    <input class="form-control datepicker" placeholder="Please select date" type="text" onfocus="focused(this)" onfocusout="defocused(this)">
      
    </div>
    <div class="nav-wrapper position-relative end-0 col-6 col-sm-4" style="cursor: pointer">
      <ul class="nav nav-pills nav-fill p-1" role="tablist">
         <li class="nav-item">
            <a class="nav-link mb-0 px-0 py-1 active" id="data_by" data-data_by="daily" data-bs-toggle="tab"  role="tab" aria-controls="daily" aria-selected="true">
            Daily
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link mb-0 px-0 py-1" id="data_by" data-bs-toggle="tab" data-data_by="monthly"  role="tab" aria-controls="monthly" aria-selected="false">
            Monthly
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link mb-0 px-0 py-1" id="data_by" data-bs-toggle="tab" data-data_by="yearly"  role="tab" aria-controls="yearly" aria-selected="false">
            Yearly
            </a>
         </li>
       </ul>
   </div>
  </div>
  <div class="row">

    {{-- incidents line chart --}}
    <div class="col-12 mb-4 mb-lg-0">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Incidents</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="incidents_line_chart" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>

    {{-- Permit to Work line chart --}}
    <div class="col-12 col-sm-6 col-lg-6 mb-4 mb-lg-0 mt-2">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Permit To Work</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="ptw_line_chart" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>

    {{-- IE Audit --}}
    <div class="col-12 col-sm-6 col-lg-6 mb-4 mb-lg-0 mt-2">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">IE Audit</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="ie_audit_line_chart" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>

    {{-- ptw_type_wise --}}

    
    <div class="col-12 col-sm-6  mb-4 mb-lg-0 mt-2">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Permit To Work Type Wise</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="ptw_type_wise" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    

    <div class="col-12 col-sm-6  mb-4 mb-lg-0 mt-2">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Fire and Property Damages Category Wise</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="fpd_category_wise" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-12 col-sm-6  mb-4 mb-lg-0 mt-2">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Injury Category Wise</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="injury_category_wise" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-12 col-sm-6  mb-4 mb-lg-0 mt-2">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Injury Incident Machine Wise</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="injury_incident_cat_wise" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-12 col-sm-6  mb-4 mb-lg-0 mt-2">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Injuries Investigation Report</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="injury_investigation" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-12 col-sm-6  mb-4 mb-lg-0 mt-2">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Hazard Risk level wise</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="hazard_risk_wise" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-12 col-sm-6  mb-4 mb-lg-0 mt-2">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Hazards Department Wise</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="hazard_department_wise" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>

    
    <div class="col-12 col-sm-6  mb-4 mb-lg-0 mt-2">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Hazard Incident Status wise</h6>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="hazard_status_wise" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  

 
 
@endsection
@endcan

@section('script')
<script src="{{asset('assets/js/site_charts.js?v5')}}"></script>
<script src="{{asset('assets/js/plugins/flatpickr.min.js')}}"></script>
<script>

// date picker
if (document.querySelector('.datepicker')) {
        flatpickr('.datepicker', {
          mode: "range",
          dateFormat: 'd-m-Y', // Set the desired date format
          onChange: function(selectedDates, dateStr, instance) {
                let fromDate;
                let toDate;
                 if (selectedDates.length === 2) {
                    fromDate = instance.formatDate(selectedDates[0], 'd-m-Y');
                    toDate = instance.formatDate(selectedDates[1], 'd-m-Y');
                    // Do something with the formatted from and to dates...
                  }else{
                    fromDate = instance.formatDate(selectedDates[0], 'd-m-Y');
                    toDate = instance.formatDate(selectedDates[0], 'd-m-Y');
                  }
                  // loading charts
                  loadLineCharts(data_by,fromDate);
                  loadBarChart(fromDate,toDate);
            },
        }); // flatpickr
      }



var data_by = "daily";
loadLineCharts(data_by);
loadBarChart();
$('body').on('click','a#data_by',function(){
  data_by = $(this).attr('data-data_by');
  loadLineCharts(data_by);
})


function loadLineCharts(data_by,date = ""){
  $.ajax({
  url: "{{ route('line_chart')}}",
  type: "get",
  dataType: "json",
  data: {
    _token: token,
    data_by:data_by,
    date:date,
  },
  success: function(response) {
    // Handle the success response
    let ptws = {
      labels: response.data['ptws']['label'],
      dataSet: [
       {
         data: response.data['ptws']['value'],
         label: "Permit To Work",
         borderColor: "#17c1e8"
       }
      ]
    }

    let ie_audit = {
      labels: response.data['ie_audit']['label'],
      dataSet: [
       {
         data: response.data['ie_audit']['value'],
         label: "IE Audits",
         borderColor: "Green"
       }
      ]
    }

    let incidents = {
      labels: response.data['incident_all']['label'],
      dataSet: [
       {
         data: response.data['incident_all']['value'],
         label: "Incidents",
         borderColor: "#17c1e8"
       },
       {
         data: response.data['unsafe_behavior']['value'],
         label: "Unsafe Behavior",
         borderColor: "red"
       },
       {
         data: response.data['injury']['value'],
         label: "Injuries",
         borderColor: "green"
       },
       {
         data: response.data['fire_property_damage']['value'],
         label: "Fire and Property Damages",
         borderColor: "orange"
       },
       {
         data: response.data['hazard']['value'],
         label: "Hazards",
         borderColor: "yellow"
       },
       {
         data: response.data['near_miss']['value'],
         label: "Near Misses",
         borderColor: "purple"
       }
      ]

    }
  // creating line chart of incidents
  lineChart('incidents_line_chart',incidents.dataSet,incidents.labels);
  // creating ptw line chart
  lineChart('ptw_line_chart',ptws.dataSet,ptws.labels);
  // creating ie audit line chart
  lineChart('ie_audit_line_chart',ie_audit.dataSet,ie_audit.labels);
  }
});
}


function incidentPiChart(){
  let data = [15, 20, 12, 60];
  let colors = ['#17c1e8', '#5e72e4', '#3A416F', 'green'];
  let labels = ['Facebook', 'Direct', 'Organic', 'Referral'];
  let chartName = "Incidents";
  piChart("chart-line",data,labels,colors,chartName);
}

function loadBarChart(fromDate,toDate){
  $.ajax({
  url: "{{ route('bar_chart')}}",
  type: "get",
  dataType: "json",
  data: {
    _token: token,
    data_by:data_by,
    from_date: fromDate,
    to_date: toDate
  },
  success: function(response){
    let ptw_type_wise = {
      labels: response['ptw_type_wise']['labels'],
      data: response['ptw_type_wise']['data'],
      chartName: 'Permit to Work Type Wise',
    }

    let fpd_category_wise = {
      labels: response['fpd_category_wise']['labels'],
      data: response['fpd_category_wise']['data'],
      chartName: 'Fire and Property Damages Category Wise',
    }

    let injury_category_wise = {
      labels: response['injury_category_wise']['labels'],
      data: response['injury_category_wise']['data'],
      chartName: 'Injuries Category wise',
    }
    let injury_incident_cat_wise = {
      labels: response['injury_incident_cat_wise']['labels'],
      data: response['injury_incident_cat_wise']['data'],
      chartName: 'Injury Incident Machine Wise',
    }
    let injury_investigation = {
      labels: response['injury_investigation']['labels'],
      data: response['injury_investigation']['data'],
      chartName: 'Injury Investigation Report',
    }
    let hazard_risk_wise = {
      labels: response['hazard_risk_wise']['labels'],
      data: response['hazard_risk_wise']['data'],
      chartName: 'Hazard Risk Wise',
    }
    let hazard_department_wise = {
      labels: response['hazard_department_wise']['labels'],
      data: response['hazard_department_wise']['data'],
      chartName: 'Hazard Department Wise',
    }
    let hazard_status_wise = {
      labels: response['hazard_status_wise']['labels'],
      data: response['hazard_status_wise']['data'],
      chartName: 'Hazard Status Wise',
    }

    barChart("ptw_type_wise",ptw_type_wise.chartName,'x',ptw_type_wise.labels,ptw_type_wise.data,'green');
    barChart("fpd_category_wise",fpd_category_wise.chartName,'x',fpd_category_wise.labels,fpd_category_wise.data,'orange');
    barChart("injury_category_wise",injury_category_wise.chartName,'x',injury_category_wise.labels,injury_category_wise.data,'red');
    barChart("injury_incident_cat_wise",injury_incident_cat_wise.chartName,'x',injury_incident_cat_wise.labels,injury_incident_cat_wise.data,'red');
    barChart("injury_investigation",injury_investigation.chartName,'x',injury_investigation.labels,injury_investigation.data,'red');
    barChart("hazard_risk_wise",hazard_risk_wise.chartName,'x',hazard_risk_wise.labels,hazard_risk_wise.data,'purple');
    barChart("hazard_department_wise",hazard_department_wise.chartName,'x',hazard_department_wise.labels,hazard_department_wise.data,'purple');
    barChart("hazard_status_wise",hazard_status_wise.chartName,'x',hazard_status_wise.labels,hazard_status_wise.data,'purple');

  }

  });
  // let labels = ['16-20', '21-25', '26-30', '31-36', '36-42', '42+'];
  // let data  = [15, 20, 12, 60, 20, 15];
  // let chartName = "Incidents";
  // barChart("chart-line",chartName,'x',labels,data,'green');
}












</script>  
@endsection