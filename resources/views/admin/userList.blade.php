
          <thead>
            <tr>
              <th>#</th>
              <th>Image</th>
              <th>Username</th>
              <th>Email</th>
              <th>Name</th>
              <th>Rol</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <th>{{$user->id}}</th>
                <th><img src="{{$user->image}}" style="width:100px;height:100px;" class="rounded-circle"></th>
                <td><a href="{{ route('perfil',['user'=>$user->username]) }}">{{$user->username}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{$user->name." ".$user->surname}}</td>
                <td>{{$user->roles->rol}}</td>
                <td>
                  <a id="btnBorrar"  href="#borrar{{$user->id}}" role="button" data-bs-toggle="modal" data-bs-target="#borrar{{$user->id}}" class="btn btn-danger" type="button">Borrar Usuario</a>
                  <!-- MODAL BORRAR USUARIO -->
<div class="modal fade" id="borrar{{$user->id}}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="staticBackdropLabel">Borrar usuario</h5>
      <i class="bi bi-x-lg" data-bs-dismiss="modal"></i>
    </div>
    <div class="modal-body">
        <h6>¿Estas seguro?</h6>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form method="POST" action="{{route('deleteUser',['id'=>$user->id])}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-success">Si</button>
        </form>
    </div>
  </div>
</div>
</div>
                  <div class="accordion accordion-flush" id="accordionPassword">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush{{$user->id}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$user->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                          Cambiar Contraseña
                        </button>
                      </h2>
                      <div id="collapse{{$user->id}}" class="accordion-collapse collapse" aria-labelledby="flush{{$user->id}}" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <form method="POST" action="{{route('reset.password',['id'=>$user->id])}}">
                            @csrf
                            <div class="form-group">
                            </div>
                            <div class="form-group ">
                                <label for="password" class=" col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="w-100">
                                    <input type="password" class="password form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class=" col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="w-100">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning">Cambiar</button>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>

          @endforeach
          </tbody>



