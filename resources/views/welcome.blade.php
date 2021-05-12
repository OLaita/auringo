@extends('layouts.app')
@section('content')
<div style="width:100vw;justify-content:space-evenly"class="container d-flex">
    @foreach ($categorias as $cat)
        <span style="color:#7E6969">{{$cat->categoria}}</span>
    @endforeach

</div>

<div class="d-flex justify-content-center">
    @foreach ($proyectos as $pro)

    <div class="card" style="width: 18rem;margin:30px;">
        <img src="{{$pro->fotoProyecto}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h3>{{$pro->title}}</h3>
        <p class="card-text">{{$pro->descCorta}}</p>
        </div>
    </div>

    @endforeach

</div>

@endsection
