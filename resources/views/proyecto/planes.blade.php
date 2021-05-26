@extends('layouts.app')

@section('content')



    <div class="container">

        <div class="mt-4">

            <h3>Planes</h3>

            <div class="d-flex flex-wrap align-items-center">
                <div class="d-flex flex-wrap">
                    @foreach ($planes as $plan)
                    <script>

                        $(document).ready(function() {
                            var i = {!! json_encode($plan->id) !!};
                            $(".ventaj"+i).each(function(){
                                var vent = {!! json_encode($plan->ventajas) !!};
                                $(this).append("<br>"+vent);
                            })

                        })
                    </script>

                    <div class="card" style="width: 18rem; margin:10px">
                        <div class="card-body">
                          <h5 class="card-title text-muted">Contribuir con {{$plan->precio}}€</h5>
                          <h4 class="card-subtitle mb-2">{{$plan->nombre}}</h4>

                          <p class="ventaj{{$plan->id}} card-text">{{$plan->descripcion}}</p>

                          <form method="POST" action="{{ route("planDes",['id' => $plan->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="card-link btn btn-danger" type="submit">Eliminar</button>
                          </form>
                        </div>
                      </div>
                    @endforeach
                </div>

<!-- Button trigger modal -->
<a id="btnplanes" style="color:#272932"href="#staticBackdrop" role="button" data-toggle="modal"><i class="ml-3 bi bi-plus-circle fa-4x"></i></a>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Nuevo Plan</h5>
        <i class="bi bi-x-lg" data-dismiss="modal"></i>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('newPlan') }}" enctype="multipart/form-data">
        @csrf
            <input name="idPro" value="{{$proyectos[0]['id']}}" hidden>
        <div class="row">
            <div class="col-6 border-right">

                <label for="name">Nombre</label>
                <input placeholder="Nombre" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                <label for="desc">Descripcion</label>
                <textarea style="width:100%"id="desc" name="desc"></textarea>

                <label for="price">Precio</label>
                <input placeholder="10" id="price" type="number" class="form-control" name="price" value="{{ old('price') }}" required autocomplete="price">

                <label for="fEnt">Fecha Entrega</label>
                <input id="fEnt" type="date" class="form-control" name="fEnt" value="{{now()->format('Y-m-d')}}" required autocomplete="fEnt">



            </div>
            <div class="col-6">
                <div id="ven">
                <label for="ventajas">Ventajas</label>
                <input placeholder="Ventajas" id="ventajas" type="text" class="form-control vent" name="ventajas0" required>
                <input id="hid" name="allVent" type="text" hidden>
                </div>
                <a id="btnventajas" style="color:#272932" role="button"><i class="bi bi-plus-circle fa-2x"></i></a>

            </div>
        </div>



      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

                <!-- FIN MODAL -->

            </div>

        </div>

        <div class="mt-4">

            <h3>Imagenes y Videos</h3>
            <div style="justify-content:center"class="d-flex flex-wrap">
            @foreach ($videoImg as $vi)
                @if ($vi->videoImg == 0)
                <div style="margin:10px" class="flex-wrap">
                    <img style="max-width:300px;max-height: 180px;"src="{{asset("storage/".$vi->enlace)}}">
                    <form method="POST" action="{{ route("imgVidDes",['id' => $vi->id]) }}">
                        @csrf

                        @method('DELETE')
                        <button style="margin-top:10px" class="btn btn-danger" type="submit">Eliminar</button>
                      </form>
                    </div>
                @else
                <div style="margin:10px" class="flex-wrap">
                <video style="max-width:300px;max-height: 180px;" width="400" controls>
                    <source src="{{asset("storage/".$vi->enlace)}}" type="video/mp4">
                  </video>
                  <form method="POST" action="{{ route("imgVidDes",['id' => $vi->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                  </form>
                </div>
                @endif
            @endforeach
                </div>
            <form style="margin-top:30px" method="POST" action="{{ route('newMedia') }}" enctype="multipart/form-data">
                @csrf
                <input name="proId" value="{{$proyectos[0]['id']}}" hidden>
            <input id="campoFile" accept="video/*,image/*" name="media" type="file" value="" />
            @error('media')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit">Subir</button>
            </form>
        </div>


        <a style="margin-top:15px"  href="{{route('proyecto', ['title' => $proyectos[0]['title']])}}" class="btn btn-success">Finalizar</a>


    </div>

    <script>
$(document).ready(function(){

    $("#btnplanes").click(function(){
                        $('#staticBackdrop').modal({backdrop: 'static', keyboard: false})
                    })


                    $("#btnventajas").click(function(){
                        var i = 0;
                        $(".vent").each(function(){
                            i++;
                        })
                        $("#ven").append('<input placeholder="Ventajas" id="ventajas" type="text" class="form-control vent" name="ventajas'+i+'">');
                    })

                    $("#ven").change(function(){
                        var i = 0;
                        var t = "<ul>";
                        $(".vent").each(function(){
                            t += "<li>"+$("input[name=ventajas"+i+"]").val()+"</li>";
                            i++;
                        })
                            t += "</ul>";
                        $("#hid").val(t);
                    })

})
    </script>



@endsection
