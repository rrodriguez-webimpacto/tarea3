<br>
<br>
<br>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<script> 

  let options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
  };
    
  function success(pos) {
    let crd = pos.coords;

    // GET al servidor
    $(document).ready(function(){
      let api_type = 'location';

      {literal}
      $.get('../modules/tarea3/get_apis.php',{locationIQ: api_type, latitude: crd.latitude, longitude: crd.longitude},function(first_response){
        var response = first_response;

        // GET al servidor
        $(document).ready(function(){
          let api_type = 'openweather';

          $.get('../modules/tarea3/get_apis.php',{openWeather: api_type, response: response},function(second_response){

            results = JSON.parse(second_response);

            let city_name = results[0]['name'];
            let country = results[0]['country']
            let temperature = (results[0]['temperature'] -273).toFixed(2);
            let humidity = results[0]['humidity'];

            let text1 = 'Ciudad: ' + city_name;
            let text2 = 'País: ' + country;
            let text3 = 'Temperatura: ' + temperature + 'ºC';
            let text4 = 'Humedad: ' + humidity + '%';

            $data_text1 = document.getElementById('data_text1');
            $data_text2 = document.getElementById('data_text2');
            $data_text3 = document.getElementById('data_text3');
            $data_text4 = document.getElementById('data_text4');

            data_text1.innerHTML = text1;
            data_text2.innerHTML = text2;
            data_text3.innerHTML = text3;
            data_text4.innerHTML = text4;

          });
        });
      });
      {/literal}
    });
  }    

  function error(err) {
    console.warn('ERROR(' + err.code + '): ' + err.message);
  };
  
  navigator.geolocation.getCurrentPosition(success, error, options);

</script>


<style>
.weather{
    border-radius: 5px solid green;
    background-color: lightgreen;
}

.hidden{
  display: none;
}

</style>

<div class="card weather" style="width: 18rem;">
  <div class="card-body">
    <ul class="list-group list-group-flush">
        <li id="data_text1" class="list-group-item weather">El tiempo en: <br> <h6>{$name}</h6></li>
        <li id="data_text2" class="list-group-item "></li>
        <li id="data_text3" class="list-group-item "></li>
        <li id="data_text4" class="list-group-item "></li>
        <li id="api_key" class="list-group-item hidden"></li>
    </ul>
  </div>
</div>