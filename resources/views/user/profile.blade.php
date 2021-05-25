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
    <div style="margin-top:5%"class="d-flex justify-content-center flex-direction-column">
        <img style="width:100px"class="rounded-circle" src={{$user->image}}>
    </div>
    <div style="color:#212529" class="d-flex justify-content-center flex-direction-column">
        <h3>{{$user->username}}</h3>
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
                    <p>Aún no tienes biografia</p>
                @else
                <p>{{$user->biografia}}</p>
                @endif

            </div>

        </div>

    </div>
    <h4 style="margin-top:50px;color:#212529" class="d-flex justify-content-between">
    <a role="button" id="mPro">Mis Proyectos</a>
    <a role="button" id="proF">Proyectos Financiados</a>
</h4>
    <hr>

    <div id="projdiv" class="d-flex flex-wrap">



    </div>


    <script>
        $(document).ready(function(){
            $.ajax({
                url:"{{route('perfil3',['user'=>$user->username])}}",
                type: 'GET',
                beforeSend:function () {
                    $("#projdiv").empty().html('<img src="{{asset("storage/l2.svg")}}">');
                },
                success:function(msg){
                    $("#projdiv").empty().html(msg);
                }
            });

            $("#mPro").click(function(){
                $("#projdiv").focus();
                $.ajax({
                    url:"{{route('perfil3',['user'=>$user->username])}}",
                    type: 'GET',
                    beforeSend:function () {
                        $("#projdiv").empty().html('<img src="{{asset("storage/l2.svg")}}">');
                },
                    success:function(msg){
                        $("#projdiv").empty().html(msg);
                    }
                });
            });

            $("#proF").click(function(){
                $("#projdiv").focus();
                $.ajax({
                    url:"{{route('perfil2',['user'=>$user->username])}}",
                    type: 'GET',
                    beforeSend:function () {
                        $("#projdiv").empty().html('<img src="{{asset("storage/l2.svg")}}">');
                },
                    success:function(msg){
                        $("#projdiv").empty().html(msg);
                    }
                });
            });
        });
    </script>

    @endsection
