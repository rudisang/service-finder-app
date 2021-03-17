<div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
          <a class="navbar-brand" href="/"><img class="" src="{{asset('images/logo.png')}}" width=60
                  alt="reg icon"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="/services">Latest Services</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">About</a>
                  </li>
              </ul>

              <ul class="navbar-nav ">

                  @auth

                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{Auth::user()->name}}
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
                          <a class="dropdown-item" href="{{ url('/dashboard/account') }}">Edit Account</a>
                          <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route('logout') }}">
                              @csrf
                              <a class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit();"
                                  class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                          </form>
                      </div>
                  </li>

                  @else
                  <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                  </li>

                  @endauth
              </ul>
          </div>

      </div>

  </nav>
</div>