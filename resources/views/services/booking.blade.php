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
        <h4>Appointment Booking Form</h4>
        <br>
            <form action="/service/book/{{$service->id}}" method="POST">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Service</label>
                                @php
                                    $list = json_decode($service->service_list);
                                @endphp
                                <select type="date" name="title" id="" class="form-control"> 
                                    <option value=""selected disabled>Select Service</option>
                                    @foreach ($list as $item)
                                    <option value="{{$item}}">{{$item}}</option>  
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Appointment Date</label>
                                <input type="date" name="start_date" id="" class="form-control">
                            </div>
                        </div>
    
                        <div class="col col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Appointment Time</label>
                                <input type="time" name="start_time" id="" class="form-control">
                            </div>
                        </div>

                        
                    </div>
                    <button type="submit" class="btn btn-info">Book Now</button>
                </div>
            </form>
      </div>
  </div>




</section>

@endsection
