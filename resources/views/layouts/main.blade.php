<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/fullcalendar.min.css')}}">
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Raleway&display=swap" rel="stylesheet">
    @livewireStyles

    <title>Health and Beauty</title>
    <style>
      @media only screen and (max-width: 600px) {
  #service-logo {
    width: 100px !important;
    margin-top:50px !important;
    margin-bottom:30px !important;
    margin-left:-40px !important;
  }
}
      .main-container{
			margin: 0 auto;
			text-align: center;
			padding: 10px;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}
.inner-content{
  margin: 25px 0;
}
		.inner-content  input[type="radio"]{
			display: none;
		}
		.inner-content i{
			color: #dddddd;
			font-size: 36px;
			cursor: pointer;
		}
		.inner-content  input[type="radio"]:checked ~ label  i{
			color: #FFD700;
		}
		.inner-content {
			direction: rtl;
			width: 100%;
		}
		.inner-content h3 {
		    margin: 0 0 15px 0;
		    font-size: 24px;
		}
      .checked {
        color: orange;
      }
        #map {
            display:block;
            margin:0;
            height: 88vh;
            width:100%;
            }
        .trim{
            max-height: 85vh;
        }

        body {
            background-color: #ffffff;
            font-family: 'Raleway', sans-serif;
        }

        .dis-none{
            
        }

        .dim{
            filter: brightness(50%);
        }

        h1,h2,h3,h4,h5,h6{
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body style="@yield('bg')">
   <header>
       <x-navigation-bar />

   </header>

   <main>
       @yield('content')
   </main>

 
   <livewire:scripts />

   <script src="{{asset('js/jquery.min.js')}}"></script>
   <script src="{{asset('js/bootstrap.popper.min.js')}}"></script>
   <script src="{{asset('js/bootstrap.min.js')}}"></script>
   <script src="{{asset('js/main.min.js')}}"></script>
   <script src="{{asset('js/locales-all.min.js')}}"></script>
   @yield('scripts')
   
  
</body>
</html>   

 