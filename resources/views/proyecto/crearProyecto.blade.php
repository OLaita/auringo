@extends('layouts.app')

@section('content')
    <style>
        .dropzone {

            height: 50vh;
            border: 1px solid #999;
            border-radius: 3px;
            text-align: center;
        }
        .parteizq {
            width: 40%;
            margin-left:30px;
        }

        @media ( max-width: 600px){
            .wrap-chiquito{
                flex-direction: column;
            }
            .miniwidth{
                width: 100%;
            }
            .maxiwidth{
                justify-content: center;
                width: 300%;
            }
        }

    </style>
    <div class="container">
        <form method="POST" action="{{ route('pro.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row d-flex justify-content-center">


                <div class="col-md-5">
                    <input placeholder="Titulo" id="title" type="text" class="form-control" name="title"
                        value="{{ old('title') }}" required autocomplete="title" autofocus>
                </div>
            </div>

            <div class="form-group row d-flex justify-content-center">
                <div class="col-md-6">
                    <input placeholder="Descripcion Corta" id="descC" type="text" class="form-control" name="descC"
                        value="{{ old('descC') }}" required autocomplete="descC">
                </div>
            </div>
             <div class="container">
               <div class="row align-items-start wrap-chiquito">
                   <div class="col-1"></div>
                   <div class="col-6 d-flex justify-content-center align-items-center miniwidth">
                        <i style="position: absolute;z-index:-2;"class="bi bi-cloud-arrow-up-fill upload-icon fa-5x"></i><br>
                        <input style="opacity:0"class="dropzone " id="upload-input" name="image" type="file" onchange="previewFile()"><br><br>
                        <img id="preview"style="margin-top: 1vh;height: 80%; position: absolute; z-index: -1;max-width: 90%;"src="" height="150" alt="Image preview...">
                    </div>

                    <div class="col-4">
                        <div class="mb-2 ">
                            <label for="meta">Meta</label>
                            <div class="d-flex maxiwidth">
                                <input id="meta" name="meta" placeholder="3000" type="number" class=" form-control"
                                    aria-label="meta" aria-describedby="euros">
                                <span class="input-group-text" id="euros">€</span>
                            </div>
                        </div>
                        <div class="mb-2 ">
                            <label for="cat">Categoria</label>
                            <select id="cat" name="cat" class="form-control maxiwidth" aria-label="">
                                <option selected>Categorias</option>
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->categoria }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="fechaFin">Fecha final</label>
                            <input name="fechaFin" id="fechaFin" value="{{ now()->format('Y-m-d') }}" type="date"
                                class="form-control maxiwidth">
                        </div>
                        <div class="row mt-4 form-group row d-flex justify-content-center">
                        <div class=" mb-4">
                            <button type="submit" class="btn btn-primary btnmini">
                                {{ __('Crear Proyecto') }}
                            </button>
                        </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>
        </div>

                <div>
                    <div class="d-flex flex-column">
                        <label for="des">Descripción</label>
                        <textarea id="des" class="description" name="description" required></textarea>
                    </div>

                    <div class="row mt-4 form-group row d-flex justify-content-center">
                        <div class="col-md-6">
                            <label class="" for="ib">IBAN</label>
                            <input id="ib" type="text" class="form-control" name="iban" required>

                        </div>
                    </div>
                </div>
        </form>
    </div>

    <script>

    $('#des').trumbowyg({
                            lang: 'es',
                                btns: [
                                ['viewHTML'],
                                ['undo', 'redo'],
                                ['fontfamily','fontsize'],
                                ['formatting'],
                                ['strong', 'em'],
                                ['link'],
                                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                                ['unorderedList', 'orderedList'],
                                ['horizontalRule'],
                                ['fullscreen']
                            ]
                        });

    /*
tinymce.init({
            selector: 'textarea.description',
            width: 1000,
            height: 300,
            language: "es_ES",
            plugins: 'lists',
            toolbar: 'undo redo | fontselect | styleselect | bold italic | align | numlist bullist'
        });*/

        function myFunction(x) {
            if (x.matches) { // If media query matches
           /*     tinymce.init({
            selector: 'textarea.description',
            width: 200,
            height: 100,
            language: "es_ES",
            plugins: 'lists',
            toolbar: 'undo redo | fontselect | styleselect | bold italic | align | numlist bullist'
        });*/
            } else {
          /* tinymce.init({
            selector: 'textarea.description',
            width: 1000,
            height: 300,
            language: "es_ES",
            plugins: 'lists',
            toolbar: 'undo redo | fontselect | styleselect | bold italic | align | numlist bullist'
        });*/
            }
        }


        function previewFile() {
  var preview = document.querySelector('#preview');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}


    </script>
@endsection
