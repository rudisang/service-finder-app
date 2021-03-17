@extends('layouts.main')

@section('content')

<section class="row" style="width:100% !important">
    
        <div class="col-sm-12 col-md-6" style="margin:0 !important;padding:0 !important">
            <div id="map"></div>
        </div>

        <div class="col-sm-12 col-md-6" style="max-height:88vh;overflow:scroll">
<br>
              <div class="container">
                <livewire:search-service />
              </div>
        </div>

    
</section>

@endsection

@section('scripts')
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVyIUJq_UDfoxblvvpK73epq1O4e3aCXE&callback=initMap&libraries=geometry&v=weekly"
      async
    ></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      //var x = document.getElementById("demo");
      var lat;
   var long ;
   var me;
  
  function getLocation() {
  if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
  } else {
  //x.innerHTML = "Geolocation is not supported by this browser.";
  }
  }
  function showPosition(position) {
  //x.innerHTML = "Latitude: " + position.coords.latitude +
  //"<br>Longitude: " + position.coords.longitude;
   
  lat = position.coords.latitude;
  long = position.coords.longitude;
  me = {lat:lat, lng:long}
  
  }
  getLocation();
  </script>

    <script>
      
        let map;

function initMap() {
  
    const uluru = { lat: -24.397, lng: 25.644  };
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -24.397, lng: 25.644 },
    zoom: 10,
  });

 

  async function getUser() {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/services');
    
   

    let data = response.data

    for(let i=0;i<data.length;i++){
        let contentString =
    '<a style="text-decoration:none;color:black" href="/services/'+data[i].id+'"><div id="content">' +
    '<div id="siteNotice">' +
    "</div>" +
    '<h3 id="firstHeading" class="firstHeading">'+data[i].title+'</h3>' +
    '<div id="bodyContent">' +
    '<img style="width:100%;border-radius:20px" src="/covers/'+data[i].cover+'" />' +
    "</div>" +
    "</div></a>";

    let infowindow = new google.maps.InfoWindow({
    content: contentString,
  });
     
        const marker = new google.maps.Marker({
    position: { lat: Number(data[i].location_lat), lng: Number(data[i].location_long) },
    map,
    title: data[i].title,

  });

  marker.addListener("click", () => {
    infowindow.open(map, marker);
  });
  
    }

    

  } catch (error) {
    console.error(error);
  }
}

  getUser()
  
}
    </script>
    
      <script type="application/javascript">
        $(document).ready(function(){
     
            $('#search').on('keyup', function(){
              var htmlOutput = '';
                var text = $('#search').val();
                var loading = '<div class="text-center mt-4">'+
                                  '<div class="spinner-grow text-dark" role="status">'+
                                      '<span class="sr-only">Loading...</span>'+
                                  '</div>'+
                                  '<div class="spinner-grow text-dark" role="status">'+
                                      '<span class="sr-only">Loading...</span>'+
                                  '</div>'+
                                  '<div class="spinner-grow text-dark" role="status">'+
                                      '<span class="sr-only">Loading...</span>'+
                                  '</div>'+
                                  '<div class="spinner-grow text-dark" role="status">'+
                                      '<span class="sr-only">Loading...</span>'+
                                  '</div>'+
                                  '<div class="spinner-grow text-dark" role="status">'+
                                      '<span class="sr-only">Loading...</span>'+
                                  '</div>'+
                              '</div>'
                     $( '#results' ).html( loading );
 
                $.ajax({
    
                    type:"GET",
                    url: '/search',
                    data: {text: $('#search').val()},
                    success: function(data) {
                      
                      data.forEach( function( post ) {
                        
                        var distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(
                          new google.maps.LatLng({
                              lat: lat, 
                              lng: long
                          }),
                          new google.maps.LatLng({
                              lat: Number(post.location_lat), 
                              lng: Number(post.location_long)
                          })
                      );

                      console.log(distanceInMeters *0.001)
                        htmlOutput += '<div class="card shadow p-3 mb-5 bg-white rounded hoverable" style="border:none;border-radius:25px !important">'+
                        '<div class="card-body">'+
                            '<div class="media">'+
                                '<img width=80 src="/logos/'+post.logo+'" class="align-self-center mr-3" alt="...">'+
                                '<div class="media-body">'+
                                  '<h5 class="mt-0">'+post.title+'</h5>'+
                                  '<span>'+post.category+'</span> <br>'+
                                  '<span><strong>'+Math.round(((distanceInMeters*0.001) * 100)/100)+' km</strong></span>'+
                                '</div>'+
                              '</div>'+
                          '</div>'+
                      '</div>';
                      });

                      $( '#results' ).html( htmlOutput );
                     }
    
    
    
                });
    
    
            });
    
        });
        </script>
    
@endsection