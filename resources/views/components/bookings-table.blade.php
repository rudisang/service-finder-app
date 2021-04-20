<div>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Start</th>
          <th scope="col">End</th>
          <th scope="col">User</th>
          <th scope="col">Status</th>
          <th scope="col"><form method="GET" action="/dashboard/bookings"><input class="form-control" placeholder="search" type="search" name="search" id=""></form></th>
        </tr>
      </thead>
      <tbody>
          @foreach($bookings as $booking)
        
          <tr>
            <th scope="row">{{$booking->id}}</th>
            <td>{{$booking->title}}</td>
            <td>{{date("F j, Y, g:i a", strtotime($booking->start))}}</td>
            <td>{{date("F j, Y, g:i a", strtotime($booking->end))}}</td>
            <td>{{$booking->user->name}} {{$booking->user->surname}}</td>
            <td>@if($booking->confirmed) <span class="btn btn-info">Approved</span> @else <span class="btn btn-warning">Pending</span> @endif</td>
            <td><a href="" data-toggle="modal" data-target="#modal{{$booking->id}}" class="btn btn-warning">Action</a></td>
          </tr>
         
          <div class="modal fade" id="modal{{$booking->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Booking Action</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="/service/book/approve/{{$booking->id}}" method="post">
                    {{ method_field('PATCH') }}
                    @csrf
                      <div class="form-group">
                          <label for="">Message (optional)</label>
                          <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                        <select name="approve" id="" class="form-control" required>
                            <option value="" selected disabled>Select Action</option>
                            <option value="1">Approve</option>
                            <option value="0">Reject</option>
                        </select>
                    </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
              </div>
            </div>
          </div>

          @endforeach

  

      </tbody>
    </table>
</div>