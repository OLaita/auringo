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
                <input placeholder="email" id="email" type="email" class="form-control text-center" name="email" value="{{ $user->email }}" required>
                <p>{{$user->country}}</p>
            </div>
            <div style="margin-top:30px" class="col-md-5 ">
                <div>
                    <h4 style="color:#212529">Biografia</h4>
                    <hr>
                    @if ($user->biografia == null)
                        <textarea style="width:100%" name="biografia" rows="5"></textarea>
                    @else
                    <textarea id="biografia" style="width:100%" id="biografia" name="biografia" rows="5">{{$user->biografia}}</textarea>
                    @endif

                </div>

            </div>

        </div>

    <div style="margin-top:20px">
        <button id="btnUpdate" class="btn btn-success" type="button">Actualizar</button>
        <a id="btnBorrar"  href="#borrar" role="button" data-toggle="modal" class="btn btn-danger" type="button">Borrar Usuario</a>
        <a id="btnCambiar"  href="#cambiarPass" role="button" data-toggle="modal" class="btn btn-warning" type="button">Cambiar Contrseña</a>

    </div>
    <div id="error" class="text-danger">
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
    </div>
</form>
</div>


<!-- MODAL BORRAR USUARIO -->
<div class="modal fade" id="borrar" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Borrar usuario</h5>
        <i class="bi bi-x-lg" data-dismiss="modal"></i>
      </div>
      <div class="modal-body">
          <h6>¿Estas seguro?</h6>
        <form method="POST" action="{{route('user.destroy',$user->id)}}">
        @csrf
        @method('DELETE')

      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-success">Si</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- FIN MODAL BORRAR USUARIO -->

<!-- MODAL CAMBIAR CONTRASEÑA -->
<div class="modal fade" id="cambiarPass" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cambiar COntraseña</h5>
        <i class="bi bi-x-lg" data-dismiss="modal"></i>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('udPass',['id'=>$user->id])}}">
        @csrf
        <div class="form-group row">
            <label for="oldPassword" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Anterior') }}</label>
            <div class="col-md-6">
                <input id="oldPassword" type="password" class="form-control" name="oldPassword" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Cambiar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- FIN MODAL CAMBIAR CONTRSEÑA -->




<script>
    $(document).ready(function(){

        $("#btnUpdate").click(function(){

            var username = $('#username').val();
            username = username.trim().replaceAll(" ", "");
            $('#username').val(username);
            var email = $('#email').val();
            email = email.trim().replaceAll(" ", "");
            $('#email').val(email);
            var biografia = $('#biografia').val();
            if(biografia != null){
                biografia = biografia.trim();
            }
            $('#biografia').val(biografia);

            var ban = false;

            if(username == ""){
                var user = {!! json_encode($user->username) !!};
                $('#username').val(user);
            }

            if(email == ""){
                var em = {!! json_encode($user->email) !!};
                email = $('#email').val(em);
            }

            var expReg = /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/;

            if(expReg.test(email)){
                ban = true;
            }else{
                var em = {!! json_encode($user->email) !!};
                email = $('#email').val(em);
                ban = true;
            }

            if(biografia == ""){
                var bio = null;
                $('#biografia').val(bio);
            }

            if(ban){
                $('#userUpdate').submit();
            }

        });

    });
</script>

@endsection
