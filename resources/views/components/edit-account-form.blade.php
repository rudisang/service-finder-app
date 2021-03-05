<div>
    <div class="card" style="border: none">
        <div class="card-body">
          <h5 class="card-title">Edit Details</h5>
          <hr>
           <div style="max-width:70%;margin:auto">
            <form>
                 @csrf
                 <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" id="name" aria-describedby="emailHelp">
                  </div>

                  <div class="mb-3">
                    <label for="surname" class="form-label">Surname</label>
                    <input type="text" name="surname" class="form-control" value="{{Auth::user()->surname}}" id="surname">
                  </div>

                  <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input type="number" name="mobile" class="form-control" value="{{Auth::user()->mobile}}" id="mobile">
                  </div>

                  <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" value="{{Auth::user()->age}}" id="age">
                  </div>

                  <div class="mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Gender</label>
                        <select name="gender" class="form-control" id="exampleFormControlSelect1">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                  </div>

                  <div class="mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Account Type</label>
                        <select name="role_id" class="form-control" id="exampleFormControlSelect1">
                          <option>Bidder</option>
                          <option>Seller</option>
                        </select>
                      </div>
                  </div>
   
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
           </div>
        </div>
      </div>
</div>