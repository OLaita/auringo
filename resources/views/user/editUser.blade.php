@extends('layouts.app')

@section('content')

<div class="container">
    <form id="userUpdate" method="POST" action="{{route('actUser',['id'=>$user->id])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div style="margin-top:5%"class="d-flex justify-content-center flex-direction-column">
            <img style="width:100px"class="rounded-circle" src={{$user->image}}>
        </div>

        <div class="mt-2 form-group row d-flex justify-content-center">
            <div class="col-md-5">
                <input placeholder="username" id="username" type="text" class="form-control text-center" name="username" value="{{ $user->username }}" required autofocus>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between">
            <div style="margin-top:30px" class="col-md-5 ">
                <h4 style="color:#212529">Datos Personales</h4>
                <hr>
                <p>{{$user->name." ".$user->surname}}</p>
                <p>{{$user->email}}</p>
                <p>{{$user->country}}</p>
            </div>
            <div style="margin-top:30px" class="col-md-5 ">
                <div>
                    <h4 style="color:#212529">Biografia</h4>
                    <hr>
                    @if ($user->biografia == null)
                        <textarea name="biografia" rows="10" cols="50"></textarea>
                    @else
                    <textarea name="biografia" rows="5" cols="50">{{$user->biografia}}</textarea>
                    @endif

                </div>

            </div>

        </div>


        <button class="btn btn-info" type="submit">Actualizar</button>
</form>
</div>

@endsection
