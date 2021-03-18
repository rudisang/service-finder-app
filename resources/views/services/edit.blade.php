@extends('layouts.dashboard')
@section('breadcrumb')
<nav aria-label="breadcrumb" >
  <div class="container">
  <ol class="breadcrumb mt-4" style="background:#fff;max-width:400px;">
    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard/account">{{Auth::user()->role->role}} Account</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
    <li class="breadcrumb-item active" aria-current="page">{{$service->title}}</li>
  </ol>
</div>
</nav>

@endsection

@section('content')
  <section class="container my-4 dis-none">
    <x-flash-messages />
  </section>

  <section class="container my-4 dis-none">
    <form method="post" action="/service/images/{{$service->id}}" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
        <div class="card" style="border: none">
            <div class="card-body">
              <h5 class="card-title">Edit Log &amp; Cover</h5>
              <hr>
               <div style="max-width:70%;margin:auto">

         <div class="row">
             <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <div class="form-group">
                        <label for="logo">Logo</label><br>
                        <img style="border-radius:20px;object-fit: cover;" src="{{asset('logos/'.$service->logo)}}" width=200  alt="" class="result upload"> 
                        <input accept="image/*" style="display:none" type="file" name="logo" class="form-control-file" id="logo">
                        @if ($errors->has('logo'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('logo') }}</strong>
                        </span>
                         @endif
                      </div>
                  </div>
             </div>

             <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <div class="form-group">
                        <label for="cover">Cover Image</label><br>
                        <img id="cover-img" style="border-radius:20px" src="{{asset('covers/'.$service->cover)}}" width=200 alt="" class="result-cover upload"> 
                        <input accept="image/*" style="display:none" type="file" name="cover" class="form-control-file" id="cover">
                        @if ($errors->has('cover'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('cover') }}</strong>
                        </span>
                         @endif
                      </div>
                  </div>
             </div>
         </div>
      
               </div>
               <button type="submit" class="btn btn-secondary">Save</button>
            </div>
        </div>

    </form>
  </section>

  <section class="container my-4 dis-none">
   <form method="post" action="/service/edit/{{$service->id}}">
    {{ method_field('PATCH') }}
       @csrf

  
       <div class="card" style="border: none">
        <div class="card-body">
            <h5 class="card-title">Titles</h5>
            <hr>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Title</label>
                        <input type="text" value="{{$service->title}}" name="title" class="form-control" placeholder="Tiny Hair Salon" id="name" aria-describedby="emailHelp" required>
                        @if ($errors->has('title'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('title') }}</strong>
                        </span>
                         @endif
                      </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Category</label>
                    <select name="category" class="form-control" id="exampleFormControlSelect1" required>
                        <?php $arr = ['Nail Bar','Hair Salon', 'Spa']; ?>
                        @foreach($arr as $cat)
                        <option value="{{$cat}}" @if($cat == $service->category)) selected @endif>{{$cat}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('category') }}</strong>
                    </span>
                @endif
                  </div>
              </div>
                </div>
            </div>
            <br>
            <h5 class="card-title">Business Location</h5>
            <hr>
             
       <div class="mb-3">
          <label for="address" class="form-label">Business Address</label>
          <input type="text" name="address" class="form-control" value="{{$service->address}}" id="address" required>
          @if ($errors->has('address'))
          <span class="help-block">
              <strong style="color:red">{{ $errors->first('address') }}</strong>
          </span>
      @endif
        </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" value="{{$service->location_lat}}" name="location_lat" class="form-control"placeholder="Lat coordinate" id="lat" aria-describedby="emailHelp" required>
                        @if ($errors->has('location_lat'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('location_lat') }}</strong>
                        </span>
                         @endif
                      </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="long" class="form-label">Longitude</label>
                        <input type="text" value="{{$service->location_long}}" name="location_long" class="form-control"placeholder="Long coordinate" id="long" aria-describedby="emailHelp" required>
                        @if ($errors->has('location_long'))
                        <span class="help-block">
                            <strong style="color:red">{{ $errors->first('location_long') }}</strong>
                        </span>
                         @endif
                      </div>
                </div>
             </div>
            
            <br>

          <h5 class="card-title">Business Details</h5>
          <hr>
           <div style="max-width:100%;margin:auto">
            
            <div class="mb-3">
                <label for="age" class="form-label">About Us</label>
                <textarea class="form-control" name="about" id="" >{{$service->about}}</textarea>
                @if ($errors->has('about'))
                <span class="help-block">
                    <strong style="color:red">{{ $errors->first('about') }}</strong>
                </span>
            @endif
              </div>

  <div class="mb-3">
    <label for="age" class="form-label">Pricing Details</label>
    <textarea name="services" id="editor" >{{$service->services}}</textarea>
    @if ($errors->has('services'))
    <span class="help-block">
        <strong style="color:red">{{ $errors->first('services') }}</strong>
    </span>
@endif
  </div>

  <div class="mb-3">
    <label for="service_list" class="form-label">Service List</label>
    @php
        $list = json_decode($service->service_list);
    @endphp
    <input type="text" name="service_list" class="form-control" data-role="tagsinput" value="@foreach($list as $item) {{$item.","}} @endforeach">
    @if ($errors->has('service_list'))
    <span class="help-block">
        <strong style="color:red">{{ $errors->first('service_list') }}</strong>
    </span>
@endif
  </div>

  



           </div>
           <button type="submit" class="btn btn-secondary">Save</button>
        </div>
       </div>
   </form>
  </section>

  <section class="container my-4 dis-none">
      
  </section>


  <script>
    const selectElement = document.querySelector('#logo');
    const cover = document.querySelector('#cover');
    const logoimage = document.querySelector('.result');
    const coverimg= document.querySelector('#cover-img');

selectElement.addEventListener('change', (event) => {
 const result = document.querySelector('.result');
 result.src = URL.createObjectURL(event.target.files[0]);
 result.style.borderRadius = '100%'
});

logoimage.onclick = function(){
 selectElement.click()
}

coverimg.onclick = function(){
 cover.click()
}



cover.addEventListener('change', (event) => {
 const img = document.querySelector('.result-cover');
 img.src = URL.createObjectURL(event.target.files[0]);
 img.style.width = '300px'
});
</script>
@endsection