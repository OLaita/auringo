@extends('layouts.app')

@section('content')
<div class="container">
<form method="POST" action="{{ route('pro.store') }}">
@csrf
@method('POST')

<div class="form-group row d-flex justify-content-center">

    <div class="col-md-5">
        <input placeholder="Titulo" id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
    </div>
</div>

<div class="form-group row d-flex justify-content-center">
<div class="col-md-6">
    <input placeholder="Descripcion Corta" id="descC" type="text" class="form-control" name="descC" value="{{ old('descC') }}" required autocomplete="descC">
</div>
</div>

<div class="form-group row d-flex justify-content-center">
    <div style="height: 350px;" class="col-6 bg-dark d-flex align-items-center flex-column">
        <label class="form-label" for="customFile"><i class="bi bi-image fa-10x"></i></label>
        <input type="file" class="form-control" id="customFile" />
        <span>Imagen principal del proyecto</span>
    </div>
    <div class="col-6">

    </div>
    </div>


</form>
</div>
@endsection
