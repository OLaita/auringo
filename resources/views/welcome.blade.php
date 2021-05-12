@extends('layouts.app')
@section('content')
<div style="flex-wrap:wrap" class=" container d-flex justify-content-around">
    @foreach ($categorias as $cat)
        <span style="color:#7E6969; margin:5px"><a style="color:#7E6969" href="#">{{$cat->categoria}}</a></span>
    @endforeach
</div>


<div class="d-flex justify-content-center">
    @foreach ($proyectos as $pro)

    <a href="#" class="text-decoration-none text-body"><div class="card" style="width: 18rem;margin:30px;">
        <img style="height: 200px;" src="{{asset('storage/' .$pro->fotoProyecto)}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h3>{{$pro->title}}</h3>


        <p class="card-text">
        @if (strlen($pro->desCorta) > 50)
            {{substr($pro->desCorta,0,50)."..."}}
        @else
            {{$pro->desCorta}}
        @endif</p>
            <hr>
            <div class="row d-flex justify-content-around">
                <p class="card-text d-flex flex-column"><span>{{ date_diff(new \DateTime($pro->fechaInicio), new \DateTime($pro->fechaFin))->format("%a") }}</span>
                <span>DIAS</span></p>
            <p class="card-text d-flex flex-column"><span>{{ $pro->financiacionActual }}</span>
                <span>de {{$pro->meta}}</span></p>
            </div>

        </div>
    </div></a>

    @endforeach

</div>

@endsection
