<div>

    <input style="width:100% !important" name="search" class="form-control" type="text" id="search" placeholder="Search" aria-label="Search">
<br>
<div id="results">

  @foreach($services as $service)
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
<a href="/services/{{$service->id}}" style="text-decoration: none;color:black">
  <div class="card shadow p-3 mb-5 bg-white rounded hoverable" style="border:none;border-radius:25px !important">
    <div class="card-body">
      <div class="media">
          <img width=80 src="{{asset('logos/'.$service->logo)}}" class="align-self-center mr-3" alt="...">
          <div class="media-body">
            <h5 class="mt-0">{{$service->title}}</h5>
            @for ($i=0; $i<round($average); $i++)
                <span class="fa fa-star checked"></span>
              @endfor @for ($j=0; $j<5-round($average); $j++)
                <span class="fa fa-star"></span>
              @endfor<br>
            <span>{{$service->category}}</span>
          
          </div>
        </div>
    </div>
</div>
</a>
      @endforeach
</div>
   
</div>
