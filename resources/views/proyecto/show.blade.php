  <style>
  .grafico-barras {
        margin-bottom: 1em;
        position: relative;
        width: 80%;
        height: auto;
    }

    .barra-fondo {
        border-radius: 2px;
        background: #DAE4EB;
        margin-bottom: 10px;
        display: block;
    }

    .barras {
        max-width: 100%;
        background-color: cyan;
        .transition(all 1s ease-out);
        border-radius: 2px;
        cursor: pointer;
        margin-bottom: 10px;
        padding-left: .5em;
        position: relative;
        z-index: 2;
        display: block;
        height: 20px;
        width: 0%;
    }
    #imgcarro{
                max-height: 53vh;
            }
    video{

        max-height: 60vh;
    }
    @media (max-width: 1000px) {
        .wrap-chiquito {
                flex-direction: column;
            }

            .miniwidth {
                width: 100%;
            }

            .maxiwidth {
                justify-content: center;
                width: 300%;
            }
            #carrusmini {
                height: 200px;
            }
            #imgcarro{
                height:55vh;
            }
            video{

        max-height:55vh;
        max-width: 100vw;
    }
    }
</style>
@extends('layouts.app')

@section('content')

<div class="container">
    @foreach ($proyectos as $pro)
    <script>
        $(document).ready(function() {
            $act = $(".numAct").length;
            var section = {!!json_encode($pro->section) !!};
            $('#section').html(section);

            $(".vidimg").first().addClass("active");

            $(".noveas").first().addClass("active");

            $(".numAct").each(function() {
                $(this).append($act);
                $act--;
            });

            var section = {!!json_encode($pro->financiacionActual) !!};
            var meta = {!!json_encode($pro->meta) !!};
            var idproj = {!!json_encode($pro->id) !!};
            var porcentaje = section * 100;
            var porcentaje2 = porcentaje / meta;

            $("#financioacion" + idproj).data("valor", porcentaje2);
            $("#financioacion" + idproj).append(Math.trunc(porcentaje2) + "%");

            $('.barras').each(function() {
                var dataWidth = $(this).data('valor');
                $(this).css("width", dataWidth + "%");
                if (dataWidth <= 25) {
                    $(this).css("background-color", "#DD0426");
                } else if (dataWidth > 25 && dataWidth <= 50) {
                    $(this).css("background-color", "#EA7317");
                } else if (dataWidth > 50 && dataWidth <= 75) {
                    $(this).css("background-color", "#F7B32B");
                } else if (dataWidth > 75) {
                    $(this).css("background-color", "#5AFF15");
                }
            });

        });

    </script>

    <div style="text-align:center" class="form-group row d-flex justify-content-center">

        <div class="col-md-5">
            <h1><strong>{{ $pro->title }}</strong></h1>
        </div>
    </div>


    <div style="text-align:center" class="form-group row d-flex justify-content-center">
        <div style="word-wrap: break-word;" class="col-md-6">
            <h3 style="color:#3A3A3A">{{ $pro->desCorta }}</h3>
        </div>
    </div>

    @auth
    @if(Auth::user()->id == $pro->iduser)
    <form action="{{ route('editarProyecto',['title'=>$pro->title]) }}" method="GET">
        @csrf
        <button style="background-color:#272932;border:#272932" class="btn btn-danger">Editar Proyecto</button>
    </form>
    @endif
    @endauth

    <div class="row align-items-start wrap-chiquito">
        <div id="carrusmini" style="height: 20%;margin-top:5%" class="col-md-8 col-sm-12 bg-light d-flex align-items-center flex-column caruselchiquito">

            <div id="carouselExampleControls" class="col-md-10 col-sm-12 carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item vidimg">
                        <img id="imgcarro" src="{{asset("storage/".$pro->fotoProyecto)}}" class="d-block w-100" alt="...">
                    </div>
                    @foreach ($videoImg as $vi)
                    @if ($vi->videoImg == 0)
                    <div class="carousel-item vidimg">
                        <img id="imgcarro" src="{{asset("storage/".$vi->enlace)}}" class="d-block w-100" alt="...">
                    </div>
                    @else
                    <div class="carousel-item vidimg">
                        <video  controls>
                            <source src="{{asset("storage/".$vi->enlace)}}" type="video/mp4">
                        </video>
                    </div>

                    @endif
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 d-flex justify-content-center flex-column">
            <section style="margin-top:10%" class="grafico-barras">
                <ul>
                    <span class="barra-fondo">
                        <li id="financioacion{{$pro->id}}" class="barras d-flex align-items-center" data-valor=""></li>
                    </span>
                    <span class="barra-fondo">
                </ul>
            </section>
            <div class="col-xs-2 d-flex justify-content-center flex-column">
                <div class="">
                    <p style="font-size:25px"><strong>{{ $pro->financiacionActual }}€</strong></p>
                    <p style="color:#7E6969"><strong>RECAUDADOS DE {{$pro->meta}}€</strong></p>

                </div>
            </div>
            <div class="col-xs-4 d-flex  justify-content-center flex-column">
            <p style="font-size:25px"><strong>{{ $totPlanes }}</strong></p>
            <p style="color:#7E6969;"><strong>PATROCINADORES</strong></p>
            </div>
            <div class="col-xs-4 d-flex  justify-content-center flex-column">
                <p class="card-text d-flex flex-column"><span style="font-size:25px"><strong>{{ date_diff(new \DateTime($pro->fechaInicio), new \DateTime($pro->fechaFin))->format("%a") }}</strong></span>
                    <span style="color:#7E6969;"><strong>DIAS MÁS</strong></span>
                </p>
            </div>
            <a href="#planes" style="margin-top:10%;background-color:#272932;border:#272932" type="submit" class="btn btn-primary btnmini">
                {{ __('Apoyar Proyecto') }}
            </a><br><br>
        </div>

    </div>
    @endforeach
    <br><br><br>
    <div style="word-break: break-word;" class="d-flex flex-column flex-wrap col-12">
        <p style="width:100%" id="section"></p>
    </div>

    <div id="planes" class="mt-4">

        <h3>Planes</h3>

        <div class="d-flex align-items-center">
            <div class="d-flex flex-wrap justify-content-around">
                @foreach ($planes as $plan)
                <script>
                    $(document).ready(function() {
                        var i = {!!json_encode($plan->id) !!};
                        $(".ventaj" + i).each(function() {
                            var vent = {!!json_encode($plan->ventajas) !!};
                            $(this).append("<br>" + vent);
                        })

                    })

                </script>

                <div class="card" style="width: 18rem;margin-top:2%">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Contribuir con {{$plan->precio}}€</h5>
                        <h4 class="card-subtitle mb-2">{{$plan->nombre}}</h4>
                        <p class="ventaj{{$plan->id}} card-text">{{$plan->descripcion}}</p>
                        <p class="card-text">Participantes: {{$plan->participantes}}</p>
                        <p class="card-text text-muted">Fecha de entrega estimada:<br> {{$plan->fechaEntrega}}</p>
                        <a style="background-color:#272932;border:#272932;color:white" href="{{route('pagar',['code'=>encrypt($plan->id),'id'=>$plan->id])}}" class="card-text btn btn-info">Pagar</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-4">
            <h3>Novedades</h3>
            @auth
            @if (Auth::user()->id == $proyectos[0]['iduser'])
            <span><a id="btnnovedades" style="color:#272932" href="#staticBackdrop" role="button" data-toggle="modal"><i class="ml-3 bi bi-plus-circle fa-1x"></i></a>
            </span>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Nueva Actualización</h5>
                            <i class="bi bi-x-lg" data-dismiss="modal"></i>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('newAct') }}" enctype="multipart/form-data">
                                @csrf
                                <input name="idPro" value="{{$proyectos[0]['id']}}" hidden>
                                <div class="row">
                                    <div class="col-12 border-right">

                                        <label for="name">Titulo</label>
                                        <input placeholder="Titulo" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        <label for="desc">Descripcion</label>
                                        <textarea style="width:100%" id="desc" name="desc"></textarea>

                                    </div>
                                </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FIN MODAL -->

            @endauth
        @endif

        <div class="d-flex align-items-center">
            <div class="w-100">
                <div id="carouselNovedades" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner slinove">
                        @foreach ($novedades as $chunk)
                        <div class="carousel-item noveas">
                            <div class="d-flex flex-wrap">
                                @foreach ($chunk as $nov)

                                <div class="card nova" style="width: 18rem;margin:20px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$nov->titulo}}<span class="float-right numAct">#</span></h5>
                                        <p class="card-text">{{$nov->descripcion}}</p>
                                        <p class="float-right">{{$nov->fechaActualizacion}}</p>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselNovedades" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselNovedades" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                </div>

            </div>
        </div>

        <div class="mt-4">
            <h3>Comentarios</h3>

            <div class=" text-center w-100">
                <form class="d-flex justify-content-cente align-items-center flex-column" action="{{ route('comment') }}" method="POST">
                    @csrf
                    <input name="idP" value="{{$proyectos[0]['id']}}" hidden>
                    <div class="col-md-6 text-center form-group">
                        <label for="name">Pon un comentario:</label>
                        <textarea maxlength="255" required class="form-control" rows="2" id="comment" name="comment"></textarea>
                    </div>
                    <button type="submit" name="newPost" class="btn btn-primary bg-dark">Submit</button>
                    <br />
                    <br />
                </form><br>
                <div class="flex-column d-flex align-items-center">
                    @foreach ($comments as $comment)
                    <div style="margin-bottom:10px; padding: 10px;word-break: break-word;border: 2px solid grey;" class="w-75 text-left">
                        <div class="d-flex justify-content-between"><div><img style="width:50px" class="rounded-circle" src="{{ $comment->user->image }}"><span style="margin-left:10px;">{{ $comment->user->name }}</span></div>



                            @if ($comment->updated_at == $comment->created_at)
                            <span class="text-muted">Hace:
                                @if ($comment->created_at->diff(now()->toDateTimeString())->i == 0)
                                Ahora
                                @elseif($comment->created_at->diff(now()->toDateTimeString())->h == 0)
                                {{ $comment->created_at->diff(now()->toDateTimeString())->i }} min
                                @elseif($comment->created_at->diff(now()->toDateTimeString())->days == 0)
                                {{ $comment->created_at->diff(now()->toDateTimeString())->h }} horas
                                {{ $comment->created_at->diff(now()->toDateTimeString())->i }} min
                                @elseif($comment->created_at->diff(now()->toDateTimeString())->days <= 2) {{ $comment->created_at->diff(now()->toDateTimeString())->days }} dias {{ $comment->created_at->diff(now()->toDateTimeString())->h }} horas {{ $comment->created_at->diff(now()->toDateTimeString())->i }} min @else mucho @endif </span>
                        </div>
                        <p style="margin-top:20px">{{ $comment->comentario }}</p>
                        @else
                        <span class="text-muted">Hace:
                            @if ($comment->updated_at->diff(now()->toDateTimeString())->i == 0)
                            Ahora
                            @elseif($comment->updated_at->diff(now()->toDateTimeString())->h == 0)
                            {{ $comment->updated_at->diff(now()->toDateTimeString())->i }} min
                            @elseif($comment->updated_at->diff(now()->toDateTimeString())->days == 0)
                            {{ $comment->updated_at->diff(now()->toDateTimeString())->h }} horas
                            {{ $comment->updated_at->diff(now()->toDateTimeString())->i }} min
                            @elseif($comment->updated_at->diff(now()->toDateTimeString())->days <= 2) {{ $comment->updated_at->diff(now()->toDateTimeString())->days }} dias {{ $comment->updated_at->diff(now()->toDateTimeString())->h }} horas {{ $comment->updated_at->diff(now()->toDateTimeString())->i }} min @else mucho @endif </span>
                    </div>
                    <p style="margin-top:20px">{{ $comment->comentario }} <span class="text-muted">(Modificado)</span></p>
                    @endif
                    @auth
                    @if (Auth::user()->hasRole('admin'))
                    <form action="{{ route('com.destroy', $comment->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <td><button class="btn btn-danger">Borrar</button></td>
                    </form>
                    @elseif(Auth::user()->id == $comment->idUser)
                    <form action="{{ route('com.destroy', $comment->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <td><button class="btn btn-danger">Borrar</button></td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Mod
                        </button>
                    </form>
                    @endif
                    @endauth
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="exampleModalLabel">Modificar comentario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('com.update', $comment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <input name="udCom" type="text" value="{{$comment->comentario}}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
