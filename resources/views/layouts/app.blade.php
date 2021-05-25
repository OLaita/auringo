<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.tiny.cloud/1/4qff3yqi8o7hli35q1qev3i1f092oe17f20a471603rpn9gc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('/img/penguin.png') }}">
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('/img/penguin.png') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--    Trumbowyg Editor-->
    <script src="{{ asset('js/trumbowyg/dist/trumbowyg.min.js') }}"></script>
    <script src="{{ asset('js/trumbowyg/dist/langs/es.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/trumbowyg/dist/ui/trumbowyg.min.css') }}">
    <script src="{{ asset('js/trumbowyg/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js') }}"></script>
    <script src="{{ asset('js/trumbowyg/dist/plugins/fontsize/trumbowyg.fontsize.min.js') }}"></script>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <style>

#fom-busc{
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    transition: all 1s;
    width: 50px;
    height: 50px;
    background: white;
    box-sizing: border-box;
    border-radius: 25px;
    border: 4px solid white;
    padding: 5px;
}

#inp-search{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 42.5px;
    line-height: 30px;
    outline: 0;
    border: 0;
    display: none;
    font-size: 1em;
    border-radius: 20px;
    padding: 0 20px;
}

.fa{
    box-sizing: border-box;
    padding: 10px;
    width: 42.5px;
    height: 42.5px;
    position: absolute;
    top: 0;
    right: 0;
    border-radius: 50%;
    color: #272932;
    text-align: center;
    font-size: 1.2em;
    transition: all 1s;
}

#fom-busc:hover{
    width: 200px;
    cursor: pointer;
}

#fom-busc:hover input{
    display: block;
}

#fom-busc:hover .fa{
    background: #272932;
    color: white;
}
.subraya:hover{
    text-decoration: underline;
    color:white;
}
@media ( max-width: 1000px){
  #divdropdown{
    right: auto;
    left: 0;
  }
}

        </style>
</head>
<body>
    <div id="app">



        <nav style="background-color:#272932;"class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <svg height="40" viewBox="0 0 35 60" width="40" xmlns="http://www.w3.org/2000/svg"><g id="014---Penguin" fill="none"><g id="Icons" transform="translate(1 1)"><path id="Shape" d="m27.81 53.46 5.19 4.54h-12z" fill="#ffdc00"/><path id="Shape" d="m33 22v28l-12 8h-14l7-7 7-10-5-3v-9l-7-12.25 11.27-6.57z" fill="#cfd8dc"/><path id="Shape" d="m30 22.44v27c.0016321.3380647-.1676544.6540662-.45.84l-11.55 7.72h-11l7-7 7-10-5-3v-9l-7-12.25 9.42-5.5 11.26 10.45c.2057808.1908345.3218991.459358.32.74z" fill="#f5f5f5"/><path id="Shape" d="m11 35 3 16-7 7-7-36 9-5.25 7 12.25z" fill="#283593"/><path id="Shape" d="m32 3-8 5-3.69-5.9z" fill="#fec108"/><path id="Shape" d="m27.9 2.68-5.19 3.25-2.4-3.83z" fill="#ffdc00"/><path id="Shape" d="m16 38v-9l-5 6z" fill="#283593"/><g fill="#3f51b5"><path id="Shape" d="m14 51-3-16 10 6z"/><path id="Shape" d="m0 22 24-14-5-8h-10z"/></g></g><path id="Shape" d="m8 60h26c.4156318-.0005971.7875631-.2582244.9342317-.6471183.1466686-.388894.0374929-.8279673-.2742317-1.1028817l-4.21-3.68 4.1-2.74c.2793852-.1839835.4482694-.4954809.45-.83v-28c-.0008916-.2771651-.1167768-.5415282-.32-.73l-11.74-10.91 2.59-1.52 8-5c.3616535-.23004378.5364855-.66498276.4346614-1.08133024s-.4576578-.72150407-.8846614-.75866976l-11.23-.93-1-1.6c-.1831155-.29298545-.5044985-.47069139-.85-.47h-10c-.40734353-.00204015-.77521263.24320592-.93.62-9.83 24-9 21.87-9 22.11s-.54-2.21 7 36.46c.086783.4517743.47058942.7860573.93.81zm23.34-2h-6l3.43-2.28zm1.66-34.56v27l-11.3 7.56h-11.29c6.35-6.35 5.11-5.1 5.32-5.33s1.68-2.37 7.09-10.1c.1583117-.2278668.2148333-.5112655.1560493-.7824303s-.2275885-.5057165-.4660493-.6475697l-4.51-2.71c0-9.2.06-8.57-.14-8.92l-6.5-11.4 9.77-5.7zm-12.43 18.87-5 7.17-2.18-11.48zm-7-6.57 2.48-3v4.47zm16.4-31-4.6 2.87-2.2-3.43zm-19.3-2.74h8.78l4.16 6.66-20.61 11.99zm-1 17.12 6.16 10.77-4.56 5.47c-.1879358.2287694-.2648386.5290567-.21.82l2.9 15.49-5.34 5.33-6.5-33.45z" fill="#000"/></g></svg>
              <a class="navbar-brand" href="{{ url('/') }}">Auringo</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                                                          <!--BUSCADOR-->
                                                          <div class="collapse navbar-collapse " style="margin-top:30px;width:20px;height:20px">
                                                            <form id="fom-busc" class="input-group d-flex align-items-center" action="{{route('search')}}" method="GET">
                                                              @csrf
                                                                <input name="search" id="inp-search" type="text">
                                                                <a type="submit"><i class="fa fa-search"></i></a>
                                                              </form>
                                                            </div>
                <ul class="navbar-nav ml-auto">


                  @guest
                  <li class="nav-item active subraya">
                    <a  class="nav-link " href="{{ route('newProyect') }}">{{ __('Empezar Proyecto') }}
                          <span class="sr-only">(current)</span>
                        </a>
                  </li>
                  <li class="nav-item active subraya">
                    <a class="nav-link" href="{{ route('descubrir') }}">{{ __('Descubrir') }}
                        <span class="sr-only">(current)</span></a>
                  </li>

                  <li class="nav-item active subraya">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}
                        <span class="sr-only">(current)</span></a>
                  </li>
             @if (Route::has('register'))
                  <li class="nav-item active subraya">
                      <a  class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}
                        <span class="sr-only">(current)</span></a>
                  </li>
              @endif
          @endguest

          @auth
          <li style="margin-top:3%" class="nav-item active subraya">
            <a  class="nav-link " href="{{ route('newProyect') }}">{{ __('Empezar Proyecto') }}
                  <span class="sr-only">(current)</span>
                </a>
          </li>
          <li style="margin-top:3%" class="nav-item active subraya">
            <a class="nav-link" href="{{ route('descubrir') }}">{{ __('Descubrir') }}
                <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
              <a style="color:white"  id="navbarDropdown" class="nav-link justify-content-end" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  @if(Auth::user()->image == null)
                      <img style="width:40px;height:40px" class="rounded-circle" src="{{ asset('storage/iconuser.png') }}">

                  @else
                  <img style="width:40px;height:40px" class="rounded-circle" src="{{ Auth::user()->image }}">
                  @endif

              </a>

              <div id="divdropdown" style="position:absolute;font-size:17px;"class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <p style="margin-left:6%" >Mi cuenta</p>

                <a style="color:#272932"class="dropdown-item" href="{{ route('perfil',['user'=>Auth::user()->username]) }}">

                <i style="color:#272932;margin-right:10px" class="bi bi-person-circle"></i>{{ __('Perfil') }}
             </a>

             <a class="dropdown-item" href="{{ route('perfil',['user'=>Auth::user()->username]) }}">

             <i style="color:#272932;margin-right:10px" class="bi bi-star-fill"></i>{{ __('Proyectos Financiados') }}
          </a>

          <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">

          <i style="margin-right:10px" class="bi bi-gear-fill"></i>{{ __('Configuración') }}
       </a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">

                    <svg style="margin-right:10px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                      </svg>{{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <p style="margin-left:6%;margin-top:10px">Mis proyectos</p>
                <hr>
               @foreach ($misproyectos as $mpro)
               @if ($mpro->iduser == Auth::user()->id)


               <a href="{{route('proyecto', ['title' => $mpro->title])}}" class="text-decoration-none text-body">
                      <div style="margin:3px" class="d-flex">
                        <img style="width: 70px;height: 52px;margin: 5%;" src="{{asset('storage/'.$mpro->fotoProyecto)}}">
                        <p style="margin-top: 10%;"><strong>{{$mpro->title}}</strong></p>
                      </div>
                    </a>
                    @endif
                @endforeach

                <a class="dropdown-item" href="{{ route('newProyect') }}"><i style="margin-left: 45%;"class="bi bi-plus-circle "></i></a>

             </a>

        </div>
        </li>

          @endauth

                </ul>
              </div>
            </div>
          </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
