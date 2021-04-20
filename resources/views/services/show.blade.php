@extends('layouts.main')
@section('bg')
background-color: #F3F4F6;
@endsection
@section('content')
@php
$overall = 0;
@endphp
@foreach ($service->ratings as $rating)
  @php
      $overall = $rating->rating + $overall;
  @endphp
@endforeach

@php
if(count($service->ratings) == 0){
    $average = $overall/1;
}else {
    $average = $overall/count($service->ratings);
}
    
@endphp
<section class="dis-none">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>

        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img style="max-height: 50vh;object-fit:cover" src="{{asset('covers/'.$service->cover)}}" class="d-block w-100 dim" alt="...">
            <div class="carousel-caption  d-md-block">
              <h2>@for ($i=0; $i<round($average); $i++)
                <span class="fa fa-star checked"></span>
              @endfor @for ($j=0; $j<5-round($average); $j++)
                <span class="fa fa-star"></span>
              @endfor</h2>
              <h3>{{$service->title}}</h3>
            </div>
          </div>
        </div>

      </div>


      <img id="service-logo" style="position: relative;border-radius:100%;width:200px;top:-100px;left:50px;" src="{{asset('logos/'.$service->logo)}}" alt="">

    </section>


<section class="container dis-none" style="margin-top:-100px">
    <x-flash-messages />

  <div class="card shadow p-3 mb-5 bg-white rounded hoverable" style="border:none;border-radius:25px !important;">
      <div class="card-body">
        <h4>About Us</h4>

        <p>{{$service->about}}</p>
        <strong><span style="font-weight: 900">Contacts</span></strong>
        <p>{{$service->category}}<br>{{$service->address}}<br>{{$service->user->mobile}}</p>
        <span id="button"></span>
      </div>
  </div>

  <div class="card shadow p-3 mb-5 bg-white rounded hoverable" style="border:none;border-radius:25px !important;">
    <div class="card-body">
      <h4>Services</h4>
      @guest
      <a href="/login" class="btn btn-info"><i class="far fa-calendar-alt"></i>Login To Book Appointment</a>
         @else
        @if (Auth::user()->id == $service->user_id)
        <a href="/dashboard/account/service/{{$service->id}}" class="btn btn-warning">Edit My Service</a>
        @else
        <a href="/service/book/{{$service->id}}" class="btn btn-info"><i class="far fa-calendar-alt"></i> Book Appointment</a>
        @endif
      @endguest
      
      {!!$service->services!!}
    </div>
</div>



@php $images = json_decode($service->gallery); @endphp
<div class="row">
  <div class="col-sm-12 col-md-6">
    <div class="card shadow p-3 mb-5 bg-white rounded hoverable" style="border:none;border-radius:25px !important;">
      <div class="card-body">
        <h4>Gallery</h4>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
           
            @foreach ($images as $image)
            
            @if ($images[0] == $image)
            <div class="carousel-item active">
              <img style="width:400px;display:block;margin:auto" src="{{asset('gallery/'.$image)}}"  alt="...">
              </div>
                @else
                <div class="carousel-item">
                  <img style="width:400px;display:block;margin:auto" src="{{asset('gallery/'.$image)}}"  alt="...">
                  </div>
            @endif
            
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
  </div>
  </div>
  
  <div class="col-sm-12 col-md-6">
    <div class="card shadow p-3 mb-5 bg-white rounded hoverable" style="border:none;border-radius:25px !important;">
      <div class="card-body">
       
        <h4>Ratings &amp; Reviews @for ($i=0; $i<round($average); $i++)
          <span class="fa fa-star checked"></span>
        @endfor @for ($j=0; $j<5-round($average); $j++)
          <span class="fa fa-star"></span>
        @endfor <span style="font-size: 14px !important">&lbrack;{{round($average, 1)}}&rbrack;</span></h4>
        @guest
        <a href="" style="color:white" class="btn btn-warning disabled" data-toggle="modal" data-target="#review"><span class="fa fa-star"></span> Give Review</a>
            @else
            @php
              $rated = false;
            @endphp
           @foreach (Auth::user()->review as $item)
               @if ($item->service_id == $service->id)
                 @php
                   $rated = true;
                 @endphp
               @endif
           @endforeach
  
            @if ($rated)
            @else
            <a href="" style="color:white" class="btn btn-warning" data-toggle="modal" data-target="#review"><span class="fa fa-star"></span> Give Review</a>
            @endif
        @endguest
      
        <br><hr>
        
        @if (count($service->ratings) != 0)
        @foreach ($service->ratings as $rating)
        <div class="media">
          <img width=40 src="{{asset('images/no_logo.png')}}" class="mr-3" alt="...">
          <div class="media-body">
            <h5 class="mt-0">{{$rating->user->name}} @for ($i=0; $i<$rating->rating; $i++)
              <span class="fa fa-star checked"></span>
            @endfor @for ($j=0; $j<5-$rating->rating; $j++)
              <span class="fa fa-star"></span>
            @endfor</h5>
            <p>{{$rating->review}}</p>
          </div>
        </div>
        @endforeach
          @else
              <p>No Reviews Yet</p>
        @endif
      </div>
  </div>
  </div>
</div>
<div class="modal fade" id="review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/rate" method="post">
        <div class="modal-body">
          
            @csrf
            <body>
                <input type="hidden" value="{{$service->id}}" name="id">
                <div class="main-container">
                    <div class="inner-content">
                        <h3>Star Rating</h3>
                        <input value="5" type="radio" name="rating" id="star6">
                        <label for="star6"><i class="fa fa-star"></i></label>
                        <input value="4" type="radio" name="rating" id="star7">
                        <label for="star7"><i class="fa fa-star"></i></label>
                        <input value="3" type="radio" name="rating" id="star8">
                        <label for="star8"><i class="fa fa-star"></i></label>
                        <input value="2" type="radio" name="rating" id="star9">
                        <label for="star9"><i class="fa fa-star"></i></label>
                        <input value="1" type="radio" name="rating" id="star10">
                        <label for="star10"><i class="fa fa-star"></i></label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Review</label>
                    <textarea name="review" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>

                 
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary">Submit</button>
        </div>
    </form>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')

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
var btn = '<a target="_blank" href="https://www.google.com/maps/dir/?api=1&origin='+lat+','+long+'&destination={{$service->location_lat}},{{$service->location_long}}" class="btn btn-secondary"><i class="fas fa-directions"></i> Get Directions</a>'
    $( '#button' ).html( btn );
}



    getLocation();
    

</script>
@endsection