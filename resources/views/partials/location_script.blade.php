<script>
// fetching locations
let metaLocations = {!! json_encode($locations) !!};

let choicesInstance;

$('body').on('change', 'select.meta_unit_id', function() {
    setLocationChoices();
});

function setLocationChoices(){
  let meta_unit_id = parseInt($('select.meta_unit_id').find(':selected').val(), 10);
  let locationSelect = $('select#meta_locations');
  let selectedLocation = parseInt($('select#meta_locations').find(':selected').val(),10);
  locationSelect.empty(); // Clear the existing options
  let locations = metaLocations.filter(function(item) {
    return item.meta_unit_id === meta_unit_id;
  });

  let mappedLocations = locations.map(function(item){
    return {
      'label': item.location_title,
      'id': item.id,
      'value': item.id,
      'selected': selectedLocation == item.id  ? 'selected' : '',
    };
  });

  if(mappedLocations.length > 0){
      if(selectedLocation == ""){
        mappedLocations[0]['selected'] = true;
      }
  }else{
    mappedLocations.push({
      'label' :'Select Location',
      'id' :'',
      'value' :'',
      'selected': true,
      'disabled': true,
    });

  }

  // Create a new Choices instance if it doesn't exist
  if (!choicesInstance) {
      choicesInstance = new Choices(locationSelect[0], {
        choices: mappedLocations,
      });
    
  } else {
    choicesInstance.setChoices(mappedLocations, 'value', 'label', true);

  }
}

setLocationChoices();



</script>




