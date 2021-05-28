@extends('layouts.app')

@section('content')

<div class="container">
    <form id="userUpdate" method="POST" action="{{route('actUser',['id'=>$user->id])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

<div class="d-flex justify-content-center">
        <div style="margin-top:5%"class="d-flex justify-content-center flex-direction-column">
            <img style="width:100px" class="rounded-circle" src={{$user->image}}>
        </div>
        <i style="margin-top:70px;margin-right:30px;margin-left:30px;" class="bi bi-arrow-left-right fa-3x"></i>
        <div class="d-flex justify-content-center align-items-center miniwidth" style="width:100px;height:100px;margin-top: 50px;">
            <input id="avatar" style="opacity:0;height: 100px;width: 100px;position: absolute;" class="dropzone file" id="upload-input" name="avatar" type="file">
            <img id="preview" style="width:100px;height:100px;" class="rounded-circle" src="" alt="Nueva imagen">
        </div>
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
        <a id="btnBorrar"  href="#borrar" role="button" data-bs-toggle="modal" data-bs-target="#borrar" class="btn btn-danger" type="button">Borrar Usuario</a>
        <a id="btnCambiar"  href="#cambiarPass"  data-bs-target="#cambiarPass" role="button" data-bs-toggle="modal" class="btn btn-warning" type="button">Cambiar Contrseña</a>

    </div>
    <div id="error" class="text-danger">
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
    </div>
</form>
</div>


<!-- MODAL BORRAR USUARIO -->
<div class="modal fade" id="borrar" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Borrar usuario</h5>
        <i class="bi bi-x-lg" data-bs-dismiss="modal"></i>
      </div>
      <div class="modal-body">
          <h6>¿Estas seguro?</h6>
        <form method="POST" action="{{route('user.destroy',$user->id)}}">
        @csrf
        @method('DELETE')

      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit" class="btn btn-success">Si</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- FIN MODAL BORRAR USUARIO -->

<!-- MODAL CAMBIAR CONTRASEÑA -->
<div class="modal fade" id="cambiarPass" tabindex="-1" aria-labelledby="staticBackdropLabe" aria-hidden="true">  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabe">Cambiar COntraseña</h5>
        <i class="bi bi-x-lg" data-bs-dismiss="modal"></i>
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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

        $("#avatar").change(function(){
            var preview = document.querySelector('#preview');
            var file = document.querySelector('input[type=file]').files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        })

    });
</script>

@endsection
