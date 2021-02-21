<!doctype html>
<html lang="en">
 <head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CoreUI CSS -->
 <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
 <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
 <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

 <title>Home</title>
 </head>
 <body class="c-app">
 @include('partials.sidebar')


<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed">
        <ul class="c-header-nav d-md-down-none">
        </ul>
        <ul class="c-header-nav mfs-auto">
        </ul>
        <ul class="c-header-nav" >
            @if(Auth::user()->avatar)
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar"> 
                    <img class="avatar" src="{{ Auth::user()->avatar }}">
                </div>
                </a>
                {{-- <div class="dropdown-menu dropdown-menu-right pt-0">
                </div> --}}
            </li>
            @else
            <li style="padding-right: 10px">
               <span class="username"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;{{ Auth::user()->name }}</span>
            </li>
            @endif
        </ul>
    </header>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                 @yield('content')
            </div>
        </main>
    </div>
    <footer class="c-footer">
        <div><a href="#">DummyTweeter</a> © 2021</div>
        <div class="mfs-auto">Powered by&nbsp;<a href="https://github.com/sayansadhukhan62">SYN</a></div>
    </footer>
</div>



 <!-- Optional JavaScript -->
 <!-- Popper.js first, then CoreUI JS -->
 <script src="https://unpkg.com/@popperjs/core@2"></script>
 <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
 <script src="{{ mix('js/app.js') }}"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
 <script type="module">
    import Swal from 'sweetalert2/src/sweetalert2.js';
 </script>
 <script>
    if (window.location.hash && window.location.hash == '#_=_') {
        if (window.history && history.pushState) {
            window.history.pushState("", document.title, window.location.pathname);
        } else {
            // Prevent scrolling by storing the page's current scroll offset
            var scroll = {
                top: document.body.scrollTop,
                left: document.body.scrollLeft
            };
            window.location.hash = '';
            // Restore the scroll offset, should be flicker free
            document.body.scrollTop = scroll.top;
            document.body.scrollLeft = scroll.left;
        }
    }
</script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

 @yield("js")
 </body>

</html>