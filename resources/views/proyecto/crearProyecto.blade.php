@extends('layouts.app')

@section('content')
<div class="container">
<form method="POST" action="{{ route('pro.store') }}" enctype="multipart/form-data">
@csrf

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
    <div style="height: 350px;" class="col-6 bg-light d-flex align-items-center flex-column">
        <label class="form-label" for="customFile"><i class="bi bi-image fa-10x"></i></label>
        <input type="file" name="image" class="form-control" id="customFile">
        <span class="mt-3 lead" >Imagen principal del proyecto</span>
    </div>
    <div class="col-6 d-flex justify-content-center align-items-center flex-column">

        <div class="col-xs-2 mb-4 d-flex align-items-center justify-content-center flex-column">
            <label for="meta">Meta</label>
        <div class="d-flex">
            <input id="meta" name="meta" placeholder="3000" type="number" class="form-control" aria-label="meta" aria-describedby="euros">
            <span class="input-group-text" id="euros">€</span>
        </div>
        </div>

        <label for="cat">Categoria</label>
        <select id="cat" name="cat" class="form-select mb-4" aria-label="">
            <option selected>Categorias</option>
            @foreach ($categorias as $cat)
                <option value="{{$cat->id}}">{{$cat->categoria}}</option>
            @endforeach

        </select>
        <div class="col-xs-4 d-flex align-items-center justify-content-center flex-column">
            <label for="fechaFin">Fecha final</label>
            <input name="fechaFin" id="fechaFin" value="{{now()->format('Y-m-d')}}" type="date" class="form-control">
        </div>

    </div>
    </div>

    <div class="d-flex flex-column">
    <label for="des">Descripción</label>
    <textarea id="des" class="description" name="description" required></textarea>
    </div>

    <div class="row mt-4">
    <div class="col-md-6">
        <label class="" for="ib">IBAN</label>
        <input id="ib" type="text" class="form-control" name="iban" required>
    </div>
    <div class="col-md-6">
        <button type="submit" class="btn btn-primary">
            {{ __('Crear Proyecto') }}
        </button>
    </div>
    </div>

</form>
</div>

<script>

tinymce.init({
        selector:'textarea.description',
        width: 900,
        height: 500,
        language: "es_ES",
        plugins: 'lists',
        toolbar: 'undo redo | fontselect | styleselect | bold italic | align | numlist bullist'
});

</script>
@endsection
