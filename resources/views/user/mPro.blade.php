
@foreach ($proyectos as $pro)

        <a href="{{route('proyecto', ['title' => $pro->title])}}" class="text-decoration-none text-body"><div class="card" style="width: 18rem;margin:30px;">
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
                    var section = {!! json_encode($pro->financiacionActual) !!};
              var meta = {!! json_encode($pro->meta) !!};
              var idproj= {!! json_encode($pro->id) !!};
              var porcentaje = section * 100;
              var porcentaje2=porcentaje/meta;

              $("#financioacion"+idproj).data("valor",porcentaje2);
              $("#financioacion"+idproj).append(Math.trunc(porcentaje2)+"%");

              $('.barras').each(function() {
                 var dataWidth = $(this).data('valor');
                 $(this).css("width", dataWidth + "%");
                 if (dataWidth <=25) { $(this).css("background-color", "#DD0426"); }
                        else if (dataWidth >25 && dataWidth <=50){ $(this).css("background-color", "#EA7317"); }
                        else if (dataWidth >50 && dataWidth<=75) { $(this).css("background-color", "#F7B32B"); }
                        else if (dataWidth >75) { $(this).css("background-color", "#5AFF15"); }
                  });

                });
            </script>

            <p class="card-text">
            @if (strlen($pro->desCorta) > 50)
                {{substr($pro->desCorta,0,50)."..."}}
            @else
                {{$pro->desCorta}}
            @endif</p>
                <hr>
                <section class="grafico-barras">
                    <ul>
                 <span class="barra-fondo">
                 <li id="financioacion{{$pro->id}}" class="barras d-flex align-items-center" data-valor=""></li>
                 </span>
                 <span class="barra-fondo">
                 </ul>
                </section>
                <div class="d-flex justify-content-around">
                    <p class="card-text d-flex flex-column"><span><strong>{{ date_diff(new \DateTime($pro->fechaInicio), new \DateTime($pro->fechaFin))->format("%a") }}</strong></span>
                    <span style="color:#7E6969;"><strong>DIAS M??S</strong></span></p>
                <p  class="card-text d-flex flex-column"><span><strong>{{ $pro->financiacionActual }}???</strong></span>
                    <span style="color:#7E6969;"><strong>de {{$pro->meta}}???</strong></span></p>
                </div>

            </div>
        </div>
    </a>

        @endforeach

