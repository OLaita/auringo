
          <thead>
            <tr>
              <th>#</th>
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Meta</th>
              <th>Fecha Vencimiento</th>
              <th>Categoria</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($proyectos as $pro)
              <tr>
                <th style="padding-top: 4%;">{{$pro->id}}</th>
                <th><img src="{{asset('storage/' .$pro->fotoProyecto)}}" style="width:100px;height:100px;" class="rounded-circle"></th>
                <td style="padding-top: 4%;"><a href="{{route('proyecto', ['title' => $pro->title])}}">{{$pro->title}}</a></td>
                <td style="padding-top: 4%;">{{$pro->meta}}</td>
                <td style="padding-top: 4%;">{{$pro->fechaFin}}</td>
                <td style="padding-top: 4%;">{{$pro->cate->categoria}}</td>
                <td>
                  <a id="btnBorrar"  href="#borrar{{$pro->id}}" role="button" data-bs-toggle="modal" data-bs-target="#borrar{{$pro->id}}" class="btn btn-danger" type="button">Borrar Proyecto</a>
                  <!-- MODAL BORRAR USUARIO -->
<div class="modal fade" id="borrar{{$pro->id}}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="staticBackdropLabel">Borrar Proyecto</h5>
      <i class="bi bi-x-lg" data-bs-dismiss="modal"></i>
    </div>
    <div class="modal-body">
        <h6>¿Estas seguro?</h6>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form method="POST" action="{{route('delete.pro',['id'=>$pro->id])}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-success">Si</button>
        </form>
    </div>
  </div>
</div>
</div></td>
              </tr>
          @endforeach
          </tbody>
