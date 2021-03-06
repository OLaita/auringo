@extends('layouts.app')
@section('content')
<div style="flex-wrap:wrap" class=" container d-flex justify-content-around">
    @foreach ($categorias as $cat)
        <span style="color:#7E6969; margin:5px"><a id="categorias"  style="color:#7E6969" href={{route("buscarCategoria",['name'=>$cat->categoria])}}>{{$cat->categoria}}</a></span>
    @endforeach
</div>
<style>
@import "lesshat";

/* Mixings &  Variables */
@barHeight: 20px;
@borders: #717D95;
@primary: #59BAC0;

.transition (@property) {
  -webkit-transition: @property;
  -moz-transition: @property;
  -o-transition: @property;
  transition: @property
}

.transform(@degree) {
  transform:rotate(@degree);
  -ms-transform:rotate(@degree);
  -webkit-transform:rotate(@degree);
}

*{
  box-sizing: border-box;
}

.grafico-barras{
	margin-bottom: 1em;
	position: relative;
	width: 80%;
	height: auto;
}

.barra-fondo{
  border-radius: 2px;
    background: #DAE4EB;
    margin-bottom: 10px;
    display: block;
}

.barras{
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

#midfild{
    background-color: #E73748;
    margin-top:4%;
}
#midtext{
        width:40%;
    }
 .iconend{
     max-width: 70px;
 }
 #icozone{
     margin-top:5%;
 }

@media ( max-width: 600px){
    #categorias{
        width: 100vh;
    }
    #midtext{
        margin:4%;
        width:90%;
        text-align: center;
    }
    #midfild{
        flex-direction: column-reverse;
}
    .miniico{
        width: 100vw;
        margin-left: 40%;
        margin-top: 15%;
    }
    #cohete{
        max-width: 50%;
        margin-left: 15%;
    }
}
    </style>
<hr>
    <div style="margin-top:3%;" class="container">
<h3 style="margin-top:4%;color:#212529">{{$categoria->categoria}}</h3>
<div style="overflow: hidden;"class="d-flex justify-content-center flex-wrap">


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
             </ul>
            </section>
            <div class="d-flex justify-content-around">
                <p class="card-text d-flex flex-column"><span><strong>{{ date_diff(new \DateTime($pro->fechaInicio), new \DateTime($pro->fechaFin))->format("%a") }}</strong></span>
                <span style="color:#7E6969;"><strong>D??as </strong></span></p>
            <p  class="card-text d-flex flex-column"><span><strong>{{ $pro->financiacionActual }}???</strong></span>
                <span style="color:#7E6969;"><strong>de {{$pro->meta}}???</strong></span></p>
            </div>

        </div>
    </div>
</a>

    @endforeach

</div>
</div>
</div>

@endsection
