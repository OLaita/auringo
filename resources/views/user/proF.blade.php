@foreach ($planuser as $pu)

            @foreach ($finPro::where('id',$pu->idProyecto)->get() as $fp)

            <a href="{{route('proyecto', ['title' => $fp->title])}}" class="text-decoration-none text-body"><div class="card" style="width: 18rem;margin:30px;">
                <img style="height: 200px;" src="{{asset('storage/' .$fp->fotoProyecto)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3>
                        @if (strlen($fp->title) > 17)
                        {{substr($fp->title,0,14)."..."}}
                    @else
                       <strong> {{$fp->title}}</strong>
                    @endif
                </h3>

                <script>
                    $(document).ready(function() {
                        var section = {!! json_encode($fp->financiacionActual) !!};
                  var meta = {!! json_encode($fp->meta) !!};
                  var idproj= {!! json_encode($fp->id) !!};
                  var porcentaje = section * 100;
                  var porcentaje2=porcentaje/meta;

                  $("#financioacion1"+idproj).data("valor",porcentaje2);
                  $("#financioacion1"+idproj).append(Math.trunc(porcentaje2)+"%");

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
                @if (strlen($fp->desCorta) > 50)
                    {{substr($fp->desCorta,0,50)."..."}}
                @else
                    {{$fp->desCorta}}
                @endif</p>
                    <hr>
                    <section class="grafico-barras">
                        <ul>
                     <span class="barra-fondo">
                     <li id="financioacion1{{$fp->id}}" class="barras d-flex" data-valor=""></li>
                     </span>
                     <span class="barra-fondo">
                     </ul>
                    </section>
                    <div class="d-flex justify-content-around">
                        <p class="card-text d-flex flex-column"><span><strong>{{ date_diff(new \DateTime($fp->fechaInicio), new \DateTime($fp->fechaFin))->format("%a") }}</strong></span>
                        <span style="color:#7E6969;"><strong>DIAS MÁS</strong></span></p>
                    <p  class="card-text d-flex flex-column"><span><strong>{{ $fp->financiacionActual }}€</strong></span>
                        <span style="color:#7E6969;"><strong>de {{$fp->meta}}€</strong></span></p>
                    </div>

                </div>
            </div>
        </a>

            @endforeach

        @endforeach
