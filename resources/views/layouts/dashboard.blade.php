<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/tagsinput.css')}}">
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/cal.min.css')}}">
    <title>Dashboard Cattle Bidder App</title>
    <style>
        a{
            color: black;
            text-decoration: none !important;
        }
        body {
            background-color: #F3F4F6;
        }
        .checked {
        color: orange;
      }
      #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }
      .dis-none{
        
      }

        .upload:hover{
            cursor: pointer;
            filter: opacity(60%);
            transition: 1s;
        }
    </style>
</head>

<body>
    <header>
        <x-dashboard-nav />
        @yield('breadcrumb')
    </header>

    <main>
        @yield('content')
    </main>
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/editor.js')}}"></script>
    <script>
        ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
</script>
<script src="{{asset('js/tagsinput.js')}}"></script>
<script src="{{asset('js/cal.min.js')}}"></script>
<script src="{{asset('js/locales-all.min.js')}}"></script>

@yield('scripts')
</body>


</html>