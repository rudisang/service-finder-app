@extends('layouts.main')

@section('content')
<section>
    <x-main-carousel />
</section>

<section class="container mt-4 dis-none">
   <div class="row">
        <div class="col-sm-12 text-center my-4">
            <h2 class="">What Are You Interested in Today?</h2>
        </div>

       <div class="col-sm-12 col-md-4">
        <a href="" style="text-decoration: none;color:rgb(53, 53, 53)">
            <div class="card shadow p-3 mb-5 bg-white rounded hoverable" style="border:none;border-radius:25px !important">
                <div class="card-body text-center">
                    <img style="width:70%;display:block;margin:auto" src="{{asset('images/hair-salon.png')}}" alt="">
            <h3 class="my-3">HAIR SALON</h3>
            
                </div>
            </div>
        </a>
       </div>

       <div class="col-sm-12 col-md-4">
        <a href="" style="text-decoration: none;color:rgb(53, 53, 53)">
            <div class="card shadow p-3 mb-5 bg-white rounded hoverable" style="border:none;border-radius:25px !important">
                <div class="card-body text-center">
                    <img style="width:70%;display:block;margin:auto" src="{{asset('images/nail_bar.png')}}" alt="">
            <h3 class="my-3">NAIL BAR</h3>
            
                </div>
            </div>
        </a>
       </div>

       <div class="col-sm-12 col-md-4">
            <a href="" style="text-decoration: none;color:rgb(53, 53, 53)">
                <div class="card shadow p-3 mb-5 bg-white rounded hoverable" style="border:none;border-radius:25px !important">
                    <div class="card-body text-center">
                        <img style="width:70%;display:block;margin:auto" src="{{asset('images/spa.png')}}" alt="">
                <h3 class="my-3">SPA</h3>
                
                    </div>
                </div>
            </a>
       </div>

       <div class="col-sm-12 text-center">
           <a href="" class="btn btn-outline-secondary btn-lg">View All Services</a>
       </div>
   </div>
</section>
<br>
<br>
<br>
@endsection