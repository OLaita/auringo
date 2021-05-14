@extends('layouts.app')

@section('content')



    <div class="container">
        @foreach ($proyectos as $pro)
            <script>

                $(document).ready(function() {
                    var section = {!! json_encode($pro->section) !!};
                    $('#section').html(section);


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


                });

            </script>

            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <h1>{{ $pro->title }}</h1>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <h3>{{ $pro->desCorta }}</h3>
                </div>
            </div>

            <div class="form-group row d-flex justify-content-center">
                <div style="height: 350px;" class="col-6 bg-light d-flex align-items-center flex-column">
                    <img src="{{ asset('storage/' . $pro->fotoProyecto) }}">
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center flex-column">

                    <div class="col-xs-2 mb-4 d-flex align-items-center justify-content-center flex-column">
                        <p>Meta</p>
                        <div class="d-flex">
                            <p>{{ $pro->meta }}€</p>
                        </div>
                    </div>

                    <p>Categoria</p>
                    <p>{{ $pro->cate->categoria }}</p>
                    <div class="col-xs-4 d-flex align-items-center justify-content-center flex-column">
                        <p>Fecha final</p>
                        <p>{{ $pro->fechaFin }}</p>
                    </div>

                </div>
            </div>

            <div class="d-flex flex-column">
                <p id="section"></p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p>IBAN</p>
                    <p>{{ $pro->iban }}</p>
                </div>
            </div>
        @endforeach

        <div class="mt-4">

            <h3>Planes</h3>

            <div class="d-flex">
                <div></div>


<!-- Button trigger modal -->
<a id="btnplanes" style="color:#272932"href="#staticBackdrop" role="button" data-toggle="modal"><i class="bi bi-plus-circle fa-4x"></i></a>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <i class="bi bi-x-lg" data-dismiss="modal"></i>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('newPlan') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-6 border-right">

                <label for="name">Nombre</label>
                <input placeholder="Nombre" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                <label for="desc">Descripcion</label>
                <textarea id="desc" name="desc"></textarea>

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
    </div>




@endsection
