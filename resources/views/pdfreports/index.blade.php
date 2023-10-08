@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Reports List">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="Reports List" page-desc="List of Generated Reports">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          {{-- <div class="ms-auto my-auto">
            <a href="{{route('reports.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New report</a>
            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
          </div> --}}
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      
      {{-- default slot starts here --}}

      <div class="row container">
        <div class="col-12 mb-5">

          @can('report.create')
            <div class="accordion-item mb-3">
              <h5 class="accordion-header" id="headingOne">
                <button class="accordion-button border-bottom font-weight-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  Generate New Reports
                  <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                  <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                </button>
              </h5>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionRental" style="">
                <div class="accordion-body text-sm opacity-8">
                <form action="{{route('pdfreports.store')}}" method="post" class="ajax-forms row" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group col-4">
                      <label for="report_of">Report Of</label>
                      <select name="report_of" id="reports_of" class="form-control-sm form-control">
                          <option selected>Select</option>
                          <option value="hazards">Hazards</option>
                          <option value="near_misses">Near Misses</option>
                          <option value="unsafe_behaviors">Unsafe Behaviors</option>
                          <option value="injuries">Injuries</option>
                          <option value="fpdamages">Fire and Property Damages</option>
                          <option value="ptws">Permit to Work</option>
                          {{-- <option value="ie_audits">IE Audits</option> --}}
                      </select>
                  </div>

                  <div class="form-group col-4" id="availble_reports">
                      <label for="availble_reports">Availble Reports</label>
                      <select name="availble_reports" id="availble_reports" class="form-control-sm form-control">
                        <option selected>Select Report Of First</option>
                      </select>
                  </div>

                  
                  <div class="form-group col-4">
                    <label for="report_file_format">Report File Format</label>
                    <select name="report_file_format" class="form-control-sm form-control">
                        <option value="pdf">PDF</option>
                        <option value="excel">Excel</option>
                    </select>
                  </div>

                  <x-forms.basic-input label="From Date" id="from_date" name="from_date" type="date" value=""  width="col-4" input-class="form-control-sm"></x-forms.basic-input>
                  <x-forms.basic-input label="To Date" id="to_date" name="to_date" type="date" value="" width="col-4" input-class="form-control-sm"></x-forms.basic-input>
                  <div class="form-group col-12">
                    <a href="#" class="badge  badge-primary" id="year_to_date">Year to Date</a>
                    <a href="#" class="badge  badge-primary" id="current_month">Current Month</a>
                    <a href="#" class="badge  badge-primary" id="previous_month">Previous Month</a>
                    <a href="#" class="badge  badge-primary" id="current_week">Current Week</a>
                    <a href="#" class="badge  badge-primary" id="month_to_date">Month to Date</a>
                    <a href="#" class="badge  badge-primary" id="current_year">Current Year</a>  
                    <a href="#" class="badge  badge-primary" id="previous_year">Previous Year</a> 
                    <select name="month_selector" class="p-1 rounded" id="month_selector">
                      <option value="01">January</option>
                      <option value="02">February</option>
                      <option value="03">March</option>
                      <option value="04">April</option>
                      <option value="05">May</option>
                      <option value="06">June</option>
                      <option value="07">July</option>
                      <option value="08">August</option>
                      <option value="09">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                    </select> 
                  </div>   
              
                  <div class="form-group col-12">
                  <input type="hidden" name="redirect" value="{{url()->current()}}">
                  <x-forms.ajax-submit-btn div-class="col-12"  id="submit-button" btn-class="btn-sm btn-primary btn-ladda">Generate Report</x-forms.ajax-submit-btn>
                  </div>
                </form>

              </div>
            </div>
          @endcan
        </div>
        </div>
      </div>


        <div class="table-responsive">
            <table class="table table-flush" id="report-table" data-source="{{route('pdfreports.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Report of, From Date, To Date,Generated By,Created at,Action"></x-table.tblhead>
              </thead>
              <tbody>
              </tbody>
             
            </table>
        </div>
      {{-- defautl slot end here --}}

   </x-templates.basic-page-temp>

@endsection
@section('script')
<script>    
let selectedReportOf;
let locations;
$(document).ready(function() {

$.ajax({
  url: "{{ route('pdfreports.metadata') }}",
  type: "GET",
  success: function(res){
  
const availableReports = {
  hazards: [
    {
      title: "Hazard Logs",
      slug: "hazards_list",
      filters: [
        
          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          {
            type: 'select',
            title: "Select Risk Level",
            value: res.risk_levels,
            name: "meta_risk_level_id"
          },
        
      ]
    },

  ],
  near_misses: [
    {
      title: "Near Miss Logs",
      slug: "near_misses_list",
      filters: [
        
          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          
        
      ]
    },

  ],
  ptws: [
    {
      title: "Permit to Work Logs",
      slug: "ptws_list",
      filters: []
    },

  ],
  unsafe_behaviors: [
    {
      title: "Unsafe Behavior Logs",
      slug: "unsafe_behaviors_list",
      filters: [
        
          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          {
            type: 'select',
            title: "Select Risk Level",
            value: res.risk_levels,
            name: "meta_risk_level_id"
          },
         
        
      ]
    },

  ],
  injuries: [
    {
      title: "Injuries Logs",
      slug: "injuries_list",
      filters: [
        
          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Unit",
            value: res.units,
            name: "meta_unit_id"
          },
          {
            type: 'select',
            title: "Select Injury Category",
            value: res.injury_categories,
            name: "meta_injury_category_id"
          },
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          {
            type: 'select',
            title: "Select Risk Level",
            value: res.risk_levels,
            name: "meta_risk_level_id"
          },
          {
            type: 'select',
            title: "Select Line",
            value: res.lines,
            name: "meta_line_id"
          },
          {
            type: 'text',
            title: "Reported By",
            value: "",
            name: "initiated_by"
          },
          {
            type: 'text',
            title: "Witness",
            value: "",
            name: "witness_name"
          },
          {
            type: 'time',
            title: "Time",
            value: "",
            name: "time"
          },
         
        
      ]
    },
    {
      title: "Type of Injury Report",
      slug: "injury_category_report",
      filters: [
        
          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Unit",
            value: res.units,
            name: "meta_unit_id"
          },
          {
            type: 'select',
            title: "Select Injury Category",
            value: res.injury_categories,
            name: "meta_unit_id"
          },
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          {
            type: 'select',
            title: "Select Risk Level",
            value: res.risk_levels,
            name: "meta_risk_level_id"
          },
          {
            type: 'select',
            title: "Select Line",
            value: res.lines,
            name: "meta_line_id"
          },
          {
            type: 'text',
            title: "Reported By",
            value: "",
            name: "initiated_by"
          },
          {
            type: 'text',
            title: "Witness",
            value: "",
            name: "witness_name"
          },
          {
            type: 'time',
            title: "Time",
            value: "",
            name: "time"
          },
         
        
      ]
    },
    {
      title: "Action List of Injuries",
      slug: "actions_list_of_injuries_report",
      filters: [
        
          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Unit",
            value: res.units,
            name: "meta_unit_id"
          },
          {
            type: 'select',
            title: "Select Injury Category",
            value: res.injury_categories,
            name: "meta_unit_id"
          },
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          {
            type: 'select',
            title: "Select Risk Level",
            value: res.risk_levels,
            name: "meta_risk_level_id"
          },
          {
            type: 'select',
            title: "Select Line",
            value: res.lines,
            name: "meta_line_id"
          },
          {
            type: 'text',
            title: "Reported By",
            value: "",
            name: "initiated_by"
          },
          {
            type: 'text',
            title: "Witness",
            value: "",
            name: "witness_name"
          },
          {
            type: 'time',
            title: "Time",
            value: "",
            name: "time"
          },
         
        
      ]
    },
    {
      title: "Open Action Report",
      slug: "injuries_open_action_report",
      filters: [
        
          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Unit",
            value: res.units,
            name: "meta_unit_id"
          },
          {
            type: 'select',
            title: "Select Injury Category",
            value: res.injury_categories,
            name: "meta_unit_id"
          },
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          {
            type: 'select',
            title: "Select Risk Level",
            value: res.risk_levels,
            name: "meta_risk_level_id"
          },
          {
            type: 'select',
            title: "Select Line",
            value: res.lines,
            name: "meta_line_id"
          },
          {
            type: 'text',
            title: "Reported By",
            value: "",
            name: "initiated_by"
          },
          {
            type: 'text',
            title: "Witness",
            value: "",
            name: "witness_name"
          },
          {
            type: 'time',
            title: "Time",
            value: "",
            name: "time"
          },
         
        
      ]
    },
    {
      title: "Incident closure % report",
      slug: "injuries_closer_report",
      filters: [
        
          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Unit",
            value: res.units,
            name: "meta_unit_id"
          },
          {
            type: 'select',
            title: "Select Injury Category",
            value: res.injury_categories,
            name: "meta_unit_id"
          },
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          {
            type: 'select',
            title: "Select Risk Level",
            value: res.risk_levels,
            name: "meta_risk_level_id"
          },
          {
            type: 'select',
            title: "Select Line",
            value: res.lines,
            name: "meta_line_id"
          },
          {
            type: 'text',
            title: "Reported By",
            value: "",
            name: "initiated_by"
          },
          {
            type: 'text',
            title: "Witness",
            value: "",
            name: "witness_name"
          },
          {
            type: 'time',
            title: "Time",
            value: "",
            name: "time"
          },
         
        
      ]
    },

  ],
  fpdamages: [
    {
      title: "Fire Property Damages Logs",
      slug: "fpdamages_list",
      filters: [
     
          {
            type: 'select',
            title: "Select Property Type",
            value: res.property_types,
            name: "meta_property_damage_id"
          },
          {
            type: 'text',
            title: "Reviewed By",
            value: "",
            name: "reviewed_by"
          },
          {
            type: 'text',
            title: "Investigated By",
            value: "",
            name: "investigated_by"
          },
          {
            type: 'select',
            title: "Select Fire Category",
            value: res.fire_categories,
            name: "meta_fire_category_id"
          },

          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Unit",
            value: res.units,
            name: "meta_unit_id"
          },
          
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          
          {
            type: 'select',
            title: "Select Line",
            value: res.lines,
            name: "meta_line_id"
          },
          
         
        
      ]
    },
    
    {
      title: "Action List of Fire Accidents",
      slug: "actions_list_of_fpdamages_report",
      filters: [
     
          {
            type: 'select',
            title: "Select Property Type",
            value: res.property_types,
            name: "meta_property_damage_id"
          },
          {
            type: 'text',
            title: "Reviewed By",
            value: "",
            name: "reviewed_by"
          },
          {
            type: 'text',
            title: "Investigated By",
            value: "",
            name: "investigated_by"
          },
          {
            type: 'select',
            title: "Select Fire Category",
            value: res.fire_categories,
            name: "meta_fire_category_id"
          },

          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Unit",
            value: res.units,
            name: "meta_unit_id"
          },
          
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          
          {
            type: 'select',
            title: "Select Line",
            value: res.lines,
            name: "meta_line_id"
          },
          
         
        
      ]
    },
    {
      title: "Open Action Report",
      slug: "fpdamages_open_action_report",
      filters: [
     
          {
            type: 'select',
            title: "Select Property Type",
            value: res.property_types,
            name: "meta_property_damage_id"
          },
          {
            type: 'text',
            title: "Reviewed By",
            value: "",
            name: "reviewed_by"
          },
          {
            type: 'text',
            title: "Investigated By",
            value: "",
            name: "investigated_by"
          },
          {
            type: 'select',
            title: "Select Fire Category",
            value: res.fire_categories,
            name: "meta_fire_category_id"
          },

          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Unit",
            value: res.units,
            name: "meta_unit_id"
          },
          
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          
          {
            type: 'select',
            title: "Select Line",
            value: res.lines,
            name: "meta_line_id"
          },
          
         
        
      ]
    },
    {
      title: "Incident closure % report",
      slug: "fpdamages_closer_report",
      filters: [
     
          {
            type: 'select',
            title: "Select Property Type",
            value: res.property_types,
            name: "meta_property_damage_id"
          },
          {
            type: 'text',
            title: "Reviewed By",
            value: "",
            name: "reviewed_by"
          },
          {
            type: 'text',
            title: "Investigated By",
            value: "",
            name: "investigated_by"
          },
          {
            type: 'select',
            title: "Select Fire Category",
            value: res.fire_categories,
            name: "meta_fire_category_id"
          },

          {
            type: 'select',
            title: "Select Location",
            value: res.locations,
            name: "meta_location_id"
          },
          {
            type: 'select',
            title: "Select Unit",
            value: res.units,
            name: "meta_unit_id"
          },
          
          {
            type: 'select',
            title: "Select Department",
            value: res.departments,
            name: "meta_department_id"
          },
          {
            type: 'select',
            title: "Select Status",
            value: res.incident_statuses,
            name: "meta_incident_status_id"
          },
          
          {
            type: 'select',
            title: "Select Line",
            value: res.lines,
            name: "meta_line_id"
          },
          
         
        
      ]
    },

  ],
 
};

  // appending filters
  $('select#reports_of').on('change',function(){
    $('div#filter_item').hide();  
     selectedReportOf = $(this).find(':selected').val();
    const availbleReportsList = availableReports[selectedReportOf];
    const reportsContainer =  $('select#availble_reports');
    reportsContainer.empty()
    if (availbleReportsList) {
      const options = $("<option>").attr({
            value: "", // Set the value attribute
        }).text("Select Report"); // Set the text content of the option
          reportsContainer.append(options);
        availbleReportsList.forEach(element => {
          // Create a select input
          const options = $("<option>").attr({
            value: element.slug, // Set the value attribute
        }).text(element.title); // Set the text content of the option
          reportsContainer.append(options);
        });
    }
  })






$('select#availble_reports').on('change',function(){
  $('div#filter_item').hide();  
  const container = $('div#availble_reports');
  const selectedValue = $(this).find(':selected').val();
  const availbleFiltersList = availableReports[selectedReportOf];
  const {filters} =availbleFiltersList.find(report => report.slug === selectedValue);
  filters.forEach(filter => {

    const filterTitle = $("<label>").text(filter.title);


      const divContainer =  $("<div>").attr({
              class: "form-group col-4", // You can use a unique identifier for the name attribute
              id: 'filter_item',
            });
    if (filter.type !== "select") {
          // Create a text input
          const textInput = $("<input>").attr({
              type: filter.type,
              class: "form-control form-control-sm",
              value: filter.value,
              name: filter.name, // You can use a unique identifier for the name attribute
          });
         
          divContainer.append(filterTitle)
          divContainer.append(textInput)
          container.after(divContainer);
      } else if (filter.type === "select") {
        
          // Create a select input
          const selectInput = $("<select>").attr({
              name: filter.name, // You can use a unique identifier for the name attribute
              class: "form-control form-control-sm", // You can use a unique identifier for the name attribute
              id:"choices-button"
            });
          
          // Add options to the select input
          const option = $("<option>").text("Select");
                selectInput.append(option);
            filter.value.forEach(element => {
              const option = $("<option>").text(element.title).val(element.id);
                selectInput.append(option);
            });
          
          divContainer.append(filterTitle)
          divContainer.append(selectInput)
          container.after(divContainer);
          if (document.querySelectorAll("[id='choices-button']")) {
          const element = document.querySelectorAll("[id='choices-button']");
          for(let i = 0; i < element.length; i++){
            new Choices(element[i], {
              position: 'bottom',
            });
          } 
        }
      }
  });
})



}
})


// date range functions

function getCurrentDate() {
                const today = new Date();
                const yyyy = today.getFullYear();
                let mm = (today.getMonth() + 1).toString();
                mm = mm.length === 1 ? '0' + mm : mm;
                let dd = today.getDate().toString();
                dd = dd.length === 1 ? '0' + dd : dd;
                return yyyy + '-' + mm + '-' + dd;
            }

            // Year to Date button click handler
            $('#year_to_date').click(function() {
                const currentDate = getCurrentDate();
                $('#from_date').val(currentDate.split('-')[0] + '-01-01');
                $('#to_date').val(currentDate);
            });

            // Current Month button click handler
            $('#current_month').click(function() {
                const currentDate = getCurrentDate();
                $('#from_date').val(currentDate.split('-')[0] + '-' + currentDate.split('-')[1] + '-01');
                $('#to_date').val(currentDate);
            });

            // Previous Month button click handler
            $('#previous_month').click(function() {
                const currentDate = getCurrentDate();
                const firstDayOfCurrentMonth = new Date(currentDate.split('-')[0], currentDate.split('-')[1] - 1, 1);
                const lastDayOfPreviousMonth = new Date(firstDayOfCurrentMonth.getTime() - 86400000);
                const month = (lastDayOfPreviousMonth.getMonth() + 1).toString().padStart(2, '0'); // Ensure two digits
                const day = lastDayOfPreviousMonth.getDate().toString().padStart(2, '0'); // Ensure two digits
                $('#from_date').val(lastDayOfPreviousMonth.getFullYear() + '-' + month + '-01');
                $('#to_date').val(lastDayOfPreviousMonth.getFullYear() + '-' + month + '-' + lastDayOfPreviousMonth.getDate());
            });

                  // Current Week button click handler
                  $('#current_week').click(function() {
                  const currentDate = new Date();
                  const firstDayOfWeek = new Date(currentDate.setDate(currentDate.getDate() - currentDate.getDay()));
                  const lastDayOfWeek = new Date(firstDayOfWeek.getTime() + 6 * 86400000);

                  const fromYear = firstDayOfWeek.getFullYear();
                  const fromMonth = (firstDayOfWeek.getMonth() + 1).toString().padStart(2, '0'); // Ensure two digits
                  const fromDay = firstDayOfWeek.getDate().toString().padStart(2, '0'); // Ensure two digits

                  const toYear = lastDayOfWeek.getFullYear();
                  const toMonth = (lastDayOfWeek.getMonth() + 1).toString().padStart(2, '0'); // Ensure two digits
                  const toDay = lastDayOfWeek.getDate().toString().padStart(2, '0'); // Ensure two digits

                  $('#from_date').val(fromYear + '-' + fromMonth + '-' + fromDay);
                  $('#to_date').val(toYear + '-' + toMonth + '-' + toDay);
              });







            // Month to Date button click handler
            $('#month_to_date').click(function() {
              const currentDate = getCurrentDate();
              const currentYear = currentDate.split('-')[0];
              const currentMonth = currentDate.split('-')[1];

              const fromYear = currentYear;
              const fromMonth = currentMonth;
              const fromDay = '01'; // Set to the first day of the current month

              $('#from_date').val(fromYear + '-' + fromMonth + '-' + fromDay);
              $('#to_date').val(currentDate);
          });

            // Current Year button click handler
            $('#current_year').click(function() {
                const currentDate = getCurrentDate();
                $('#from_date').val(currentDate.split('-')[0] + '-01-01');
                $('#to_date').val(currentDate);
            });


            // Previous Year button click handler
        $('#previous_year').click(function() {
            const currentDate = getCurrentDate();
            const currentYear = parseInt(currentDate.split('-')[0]);
            const previousYear = currentYear - 1;

            const fromYear = previousYear.toString();
            const fromMonth = '01'; // Set to the first month of the previous year
            const fromDay = '01'; // Set to the first day of the previous year

            const toYear = previousYear.toString();
            const toMonth = '12'; // Set to the last month of the previous year
            const toDay = '31'; // Set to the last day of the previous year

            $('#from_date').val(fromYear + '-' + fromMonth + '-' + fromDay);
            $('#to_date').val(toYear + '-' + toMonth + '-' + toDay);
        });

        // Function to update date fields based on selected month
        function updateDatesFromMonth(selectedMonth) {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            
            // Ensure the selected month is formatted as two digits (e.g., '01' for January)
            const formattedMonth = selectedMonth < 10 ? '0' + selectedMonth : selectedMonth;

            const fromDay = '01'; // Set to the first day of the selected month
            const toDay = new Date(currentYear, selectedMonth, 0).getDate(); // Last day of the selected month

            const fromMonth = formattedMonth;
            const toMonth = formattedMonth;

            $('#from_date').val(currentYear + '-' + fromMonth + '-' + fromDay);
            $('#to_date').val(currentYear + '-' + toMonth + '-' + toDay);
        }

        // Event handler for month selection
        $('select#month_selector').change(function() {
            const selectedMonth = parseInt($(this).val());
            updateDatesFromMonth(selectedMonth);
        });




// data table scripts
  const table = $('#report-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },
    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'report_of', name: 'report_of' },
      { data: 'from_date', name: 'from_date' },
      { data: 'to_date', name: 'to_date' },
      { data: 'generated_by', name: 'generated_by' },
      { data: 'created_at', name: 'created_at' },
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    
  });
  
});
</script>
@endsection