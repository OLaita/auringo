@extends('layouts.app')

    @section('content')
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

    </style>
    <div class="container">

        <h2 >Destacados</h2>
        <div style="overflow: hidden;" class="d-flex justify-content-center flex-wrap">
            @foreach ($descPro as $dp)

            <a href="{{route('proyecto', ['title' => $dp->title])}}" class="text-decoration-none text-body">
                <div class="card" style="width: 18rem;margin:30px;">
                    <img style="height: 200px;" src="{{asset('storage/' .$dp->fotoProyecto)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3>
                            @if (strlen($dp->title) > 17)
                            {{substr($dp->title,0,14)."..."}}
                            @else
                            <strong> {{$dp->title}}</strong>
                            @endif
                        </h3>

                        <script>
                            $(document).ready(function() {
                                var section = {!!json_encode($dp->financiacionActual)!!};
                                var meta = {!!json_encode($dp->meta)!!};
                                var idproj = {!!json_encode($dp->id)!!};
                                var porcentaje = section * 100;
                                var porcentaje2 = porcentaje / meta;

                                $("#financioacion" + idproj).data("valor", porcentaje2);
                                $("#financioacion" + idproj).append(Math.trunc(porcentaje2) + "%");

                                $('.barras').each(function() {
                                    var dataWidth = $(this).data('valor');
                                    $(this).css("width", dataWidth + "%");
                                    if (dataWidth <= 25) {
                                        $(this).css("background-color", "red");
                                    } else if (dataWidth > 25 && dataWidth <= 50) {
                                        $(this).css("background-color", "orange");
                                    } else if (dataWidth > 50 && dataWidth <= 75) {
                                        $(this).css("background-color", "yellow");
                                    } else if (dataWidth > 75) {
                                        $(this).css("background-color", "green");
                                    }
                                });

                            });

                        </script>

                        <p class="card-text">
                            @if (strlen($dp->desCorta) > 50)
                            {{substr($dp->desCorta,0,50)."..."}}
                            @else
                            {{$dp->desCorta}}
                            @endif
                        </p>
                        <hr>
                        <section class="grafico-barras">
                            <ul>
                                <span class="barra-fondo">
                                    <li id="financioacion{{$dp->id}}" class="barras d-flex" data-valor=""></li>
                                </span>
                                <span class="barra-fondo">
                            </ul>
                        </section>
                        <div class="d-flex justify-content-around">
                            <p class="card-text d-flex flex-column"><span><strong>{{ date_diff(new \DateTime($dp->fechaInicio), new \DateTime($dp->fechaFin))->format("%a") }}</strong></span>
                                <span style="color:#7E6969;"><strong>DIAS MÁS</strong></span>
                            </p>
                            <p class="card-text d-flex flex-column"><span><strong>{{ $dp->financiacionActual }}€</strong></span>
                                <span style="color:#7E6969;"><strong>de {{$dp->meta}}€</strong></span>
                            </p>
                        </div>

                    </div>
                </div>
            </a>

            @endforeach
        </div>

        @foreach ($categorias as $categ)
        <h3 style="color:#212529">{{$categ->categoria}}</h3>
        <!--<div id="carouselCat{{$categ->id}}" class="carousel slide" data-bs-interval="false">
            <div class="carousel-inner slinove">-->
                <div class="d-flex flex-wrap">
                        @foreach ($proyectos as $chunk)
                        <!--<div class="carousel-item cat{{$categ->id}}">
                            <div class="d-flex">-->

                                {{--{{dd($chunk->where('idCategoria', $categ->id))}}--}}
                        @foreach($chunk->where('idCategoria', $categ->id)->take(4) as $pro)

                        <a href="{{route('proyecto', ['title' => $pro->title])}}" class="text-decoration-none text-body">
                            <div class="card" style="width: 13.5rem;margin:30px;">
                                <img style="height: 200px;" src="{{asset('storage/' .$pro->fotoProyecto)}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h3>
                                        @if (strlen($pro->title) > 17)
                                        {{substr($pro->title,0,14)."..."}}
                                        @else
                                        <strong> {{$pro->title}}</strong>
                                        @endif
                                    </h3>

                                    <script>
                                        $(document).ready(function() {
                                            var section = {!!json_encode($pro->financiacionActual)!!};
                                            var meta = {!!json_encode($pro->meta)!!};
                                            var idproj = {!!json_encode($pro->id)!!};
                                            var porcentaje = section * 100;
                                            var porcentaje2 = porcentaje / meta;

                                            $("#financioacion" + idproj).data("valor", porcentaje2);
                                            $("#financioacion" + idproj).append(Math.trunc(porcentaje2) + "%");

                                            $('.barras').each(function() {
                                                var dataWidth = $(this).data('valor');
                                                $(this).css("width", dataWidth + "%");
                                                if (dataWidth <= 25) {
                                                    $(this).css("background-color", "red");
                                                } else if (dataWidth > 25 && dataWidth <= 50) {
                                                    $(this).css("background-color", "orange");
                                                } else if (dataWidth > 50 && dataWidth <= 75) {
                                                    $(this).css("background-color", "yellow");
                                                } else if (dataWidth > 75) {
                                                    $(this).css("background-color", "green");
                                                }
                                            });

                                        });

                                    </script>

                                    <p class="card-text">
                                        @if (strlen($pro->desCorta) > 50)
                                        {{substr($pro->desCorta,0,50)."..."}}
                                        @else
                                        {{$pro->desCorta}}
                                        @endif
                                    </p>
                                    <hr>
                                    <section class="grafico-barras">
                                        <ul>
                                            <span class="barra-fondo">
                                                <li id="financioacion{{$pro->id}}" class="barras d-flex" data-valor=""></li>
                                            </span>
                                            <span class="barra-fondo">
                                        </ul>
                                    </section>
                                    <div class="d-flex justify-content-around">
                                        <p class="card-text d-flex flex-column"><span><strong>{{ date_diff(new \DateTime($pro->fechaInicio), new \DateTime($pro->fechaFin))->format("%a") }}</strong></span>
                                            <span style="color:#7E6969;"><strong>DIAS MÁS</strong></span>
                                        </p>
                                        <p class="card-text d-flex flex-column"><span><strong>{{ $pro->financiacionActual }}€</strong></span>
                                            <span style="color:#7E6969;"><strong>de {{$pro->meta}}€</strong></span>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </a>

                        @endforeach

                   <!--</div>
                </div>-->
                        @endforeach
                    </div>

                <!--<button class="carousel-control-prev" type="button" data-bs-target="#carouselCat{{$categ->id}}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselCat{{$categ->id}}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>-->
        @endforeach

    </div>

    <script>
        $(document).ready(function(){

            for(var i = 1; i<=$(".carousel").length;i++){
                $(".cat"+i).first().addClass("active");
            }

        });
    </script>


    @endsection