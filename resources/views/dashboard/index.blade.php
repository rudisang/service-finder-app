@extends('layouts.dashboard')
@section('breadcrumb')
   
        <nav aria-label="breadcrumb" >
            <div class="container">
            <ol class="breadcrumb mt-4" style="background:#fff;max-width:400px;">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{Auth::user()->role->role}} Account</li>
            </ol>
        </div>
          </nav>
  
@endsection
@section('content')
<section class="container my-4">
  <x-flash-messages />
</section>
<!-- Seller Dashboard Views -->
@if(Auth::user()->role_id == 2)
    @if(Auth::user()->service)
    <section class="container my-4">
      <div class="card" style="border: none">
          <h5 class="card-header" style="background: #fff">Reviews</h5>
          <div class="card-body">
             
            @if (count(Auth::user()->service->ratings) != 0)
            @foreach (Auth::user()->service->ratings as $rating)
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
     </section>
    @else
    <section class="container my-4">
      <a href="/dashboard/create-service" class="btn btn-info">Setup Company</a>
    </section>

    
    @endif

     

     <div style ="position: fixed; bottom: 30px;right:30px;background:rgb(180, 117, 0);padding:10px;border-radius:100%;">
      <a style="background:none;border:none;font-weight: 900;" class="btn btn-info" href="#">+</a>

  </div>
@endif

@if(Auth::user()->role_id == 1)
<!-- Bidder Dashboard Views -->
<section class="container my-4">
  <div class="card" style="border: none">
      <h5 class="card-header" style="background: #fff">My Appointments</h5>
      <div class="card-body">
          <h2 class="text-center">Nothing Yet</h2>
       <!-- <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>
 </section>
@endif

@if(Auth::user()->role_id == 3)
<section class="container my-4">
  <a href="/dashboard/create-user" class="btn btn-info">Create New User</a>
 </section>

<section class="container my-4">
  <x-admin-user-table />
 </section>
@endif


@endsection