@extends('layouts.app')

@section('content')
<div class="container">
@foreach ($proyectos as $pro)
            <script>

                $(document).ready(function() {
                    var section = {!! json_encode($pro->section) !!};
                    $('#section').html(section);

                    $(".carousel-item").first().addClass("active");

                });

            </script>

            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <h1>{{ $pro->title }}</h1>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <h3>{{ $pro->desCorta }}</h3>
                </div>
            </div>

            <div class="form-group row d-flex justify-content-center">
                <div style="height: 350px;" class="col-6 bg-light d-flex align-items-center flex-column">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                        <div class="carousel-inner">
                        @foreach ($videoImg as $vi)

                        @if ($vi->videoImg == 0)
                    <div class="carousel-item">
                        <img src="{{asset("storage/".$vi->enlace)}}" class="d-block w-100" alt="...">
                    </div>
                    @else
                    <div class="carousel-item">
                        <video width="400" controls>
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
                <div class="col-6 d-flex justify-content-center align-items-center flex-column">

                    <div class="col-xs-2 mb-4 d-flex align-items-center justify-content-center flex-column">
                        <p>Meta</p>
                        <div class="d-flex">
                            <p>{{ $pro->meta }}€</p>
                        </div>
                    </div>

                    <p>Categoria</p>
                    <p>{{ $pro->cate->categoria }}</p>
                    <div class="col-xs-4 d-flex align-items-center justify-content-center flex-column">
                        <p>Fecha final</p>
                        <p>{{ $pro->fechaFin }}</p>
                    </div>

                </div>
            </div>

            <div class="d-flex flex-column">
                <p id="section"></p>
            </div>
        @endforeach

        <div class="mt-4">

            <h3>Planes</h3>

            <div class="d-flex align-items-center">
                <div class="d-flex">
                    @foreach ($planes as $plan)
                    <script>

                        $(document).ready(function() {
                            var i = {!! json_encode($plan->id) !!};
                            $(".ventaj"+i).each(function(){
                                var vent = {!! json_encode($plan->ventajas) !!};
                                $(this).append("<br>"+vent);
                            })

                        })
                    </script>

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title text-muted">Contribuir con {{$plan->precio}}€</h5>
                          <h4 class="card-subtitle mb-2">{{$plan->nombre}}</h4>
                          <p class="ventaj{{$plan->id}} card-text">{{$plan->descripcion}}</p>
                          <p class="card-text">Participantes: {{$plan->participantes}}</p>
                          <p class="card-text text-muted">Fecha de entrega estimada:<br> {{$plan->fechaEntrega}}</p>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h3>Novedades</h3>

            <div class="d-flex align-items-center">
                <div class="d-flex">
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h3>Comentarios</h3>

            <div class="bg-primary text-white text-center w-75">
                <form class="d-flex justify-content-cente align-items-center flex-column"
                    action="{{ route('comment') }}" method="POST">
                    @csrf
                    <input name="idP" value="{{$proyectos[0]['id']}}" hidden>
                    <div class="col-md-6 text-center form-group">
                        <label for="name">Pon un comentario:</label>
                        <textarea maxlength="255" required class="form-control" rows="2" id="comment"
                            name="comment"></textarea>
                    </div>
                    <button type="submit" name="newPost" class="btn btn-primary bg-dark">Submit</button>
                    <br />
                    <br />
                </form><br>
                <div class="flex-column d-flex align-items-center">
                    @foreach ($comments as $comment)
                        <div style="margin-bottom:10px; padding: 10px;" class="w-75 bg-dark text-white text-left">
                            <div class="d-flex justify-content-between"><span>{{ $comment->user->name }}</span>
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
                                </form>
                                @endif
                            @endauth
                                <span class="text-muted">Hace:
                                    @if ($comment->created_at->diff(now()->toDateTimeString())->i == 0)
                                        Ahora
                                    @elseif($comment->created_at->diff(now()->toDateTimeString())->h == 0)
                                        {{ $comment->created_at->diff(now()->toDateTimeString())->i }} min
                                    @elseif($comment->created_at->diff(now()->toDateTimeString())->days == 0)
                                        {{ $comment->created_at->diff(now()->toDateTimeString())->h }} horas
                                        {{ $comment->created_at->diff(now()->toDateTimeString())->i }} min
                                    @elseif($comment->created_at->diff(now()->toDateTimeString())->days <= 2)
                                            {{ $comment->created_at->diff(now()->toDateTimeString())->days }} dias
                                            {{ $comment->created_at->diff(now()->toDateTimeString())->h }} horas
                                        {{ $comment->created_at->diff(now()->toDateTimeString())->i }} min @else mucho
                                            @endif
                                </span>
                            </div><br>
                            <p>{{ $comment->comentario }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</div>

@endsection
