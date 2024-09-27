$( document ).ready(function() {

    load_services();

    $('#specialty_id').on('change', function () {
        load_service_by_speci(this.value);
    });
});

function load_service_by_speci(speci_id) {
   var list_services = load_services();
   $('#service_id').empty();
   console.log(speci_id);
   for(var i=0; i  < list_services.length; i++){
       if(list_services[i].specialty_id == speci_id){
           $("#service_id").append(new Option(list_services[i].name, list_services[i].id));
       }
   }
}

function load_services() {
   const services_list = JSON.parse($('#services_list').val());
   console.log(services_list);
   return services_list;
}