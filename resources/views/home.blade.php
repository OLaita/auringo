@extends('layouts.app')

@section('content')
<div style="flex-wrap:wrap" class=" container d-flex justify-content-around">
    @foreach ($categorias as $cat)
        <span style="color:#7E6969; margin:5px"><a style="color:#7E6969" href={{route("buscarCategoria",['name'=>$cat->categoria])}}>{{$cat->categoria}}</a></span>
    @endforeach
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
