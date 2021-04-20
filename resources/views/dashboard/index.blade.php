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
<div class="container"><a href="/dashboard/bookings" class="btn btn-info">View All Bookings</a></div><br>
        <div id='calendar'></div>
     
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
    <section class="container my-4 dis-none">
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
          <div class="row">
          @if (Auth::user()->bookings->count() > 0)

            @foreach (Auth::user()->bookings as $booking)

                
                  @if ($booking->message != null)
                  <div class="col col-sm-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      <h4>Notification</h4>
                      <strong>{{$booking->title}} Appointment @ {{$booking->service->title}}</strong><br>
                      {{ $booking->message }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
              </div>
            @endif
            

            <div class="col col-sm-12 col-md-6">
              <div class="card shadow p-3 mb-5 bg-white rounded hoverable" style="border:none;border-radius:25px !important">
                <div class="card-body">
                  <div class="media">
                      <img width=80 src="{{asset('images/calen.png')}}" class="align-self-center mr-3" alt="...">
                      <div class="media-body">
                        <h5 class="mt-0">{{$booking->title}} Appointment @ <span style="font-weight: 900">{{$booking->service->title}}</span></h5>
                        <span style="color:blueviolet"><strong style="color:black">From:</strong> {{date("F j, Y, g:i a", strtotime($booking->start))}}</span> <br>
                        <span style="color:blueviolet"><strong style="color:black">To:</strong> {{date("F j, Y, g:i a", strtotime($booking->end))}}</span>
                        <br><br>
                        @if ($booking->confirmed)
                          <span class="btn btn-info">Approved</span>
                          @else
                          <span class="btn btn-warning">Pending Approval</span> <span class="btn btn-danger" data-toggle="modal" data-target="#cancelap">Cancel</span>
                          <div class="modal fade" id="cancelap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Cancel Appointent</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h3>Are you sure you want to do that? This action is irreversible!!</h3>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <form action="/cancel/booking/{{$booking->id}}" method="POST">{{method_field('DELETE')}}@csrf<button type="submit" class="btn btn-danger">Cancel Booking</button></form>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endif
                        
                      
                      </div>
                    </div>
                </div>
            </div>
            </div>
            @endforeach
          @else
          <h2 class="text-center">Nothing Yet</h2>
          @endif
        </div>
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


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  var bookings = []
  var calendarEl = document.getElementById('calendar');
   async function getUser() {

  try {
    const response = await axios.get('http://127.0.0.1:8000/api/bookings');
    
    let data = response.data
    var today = new Date()
    for(let i=0;i<data.length;i++){

    let item = {title: data[i].title, start: data[i].start, end: data[i].end}

    bookings.push(item)
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      initialDate: today,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: bookings
    });
   

    }
  
    
    calendar.render();
  } catch (error) {
    console.error(error);
  }


}

  getUser()

  
 
</script>

<script async>

    
 
</script>
@endsection
