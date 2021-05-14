@extends('layouts.app')

@section('content')
    <style>
        .dropzone {
            width: 80%;
            height: 50vh;
            border: 1px solid #999;
            border-radius: 3px;
            text-align: center;
        }

        .upload-icon {
            margin: 25px 2px 2px 2px;
        }

        .upload-input {
            position: absolute;
    top: 210px;
    left: 10%;
    width: 40%;
    height: 50%;
    opacity: 0;
        }

        .parteizq {
            width: 40%;
            margin-left:30px;
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
            <div class="d-flex flex-wrap">
                <div style="width: 60%;" class="row align-items-center justify-content-center flex-wrap">
                    <div class="dropzone">
                        <i class="bi bi-cloud-arrow-up-fill upload-icon fa-5x"></i><br>
                        <input class="upload-input"id="upload-input" name="image" type="file" onchange="previewFile()"><br><br>
                        <img id="preview"style="max-width:100%"src="" height="150" alt="Image preview...">
                    </div>
                </div>
                <div class="parteizq">
                    <div class="col-lg-8">
                        <div class="col-xs-2 mb-4 flex-column">
                            <label for="meta">Meta</label>
                            <div class="d-flex">
                                <input id="meta" name="meta" placeholder="3000" type="number" class="form-control"
                                    aria-label="meta" aria-describedby="euros">
                                <span class="input-group-text" id="euros">€</span>
                            </div>
                        </div>
                        <div class="col-xs-2 mb-4 flex-column">
                            <label for="cat">Categoria</label>
                            <select id="cat" name="cat" class="form-control" aria-label="">
                                <option selected>Categorias</option>
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->categoria }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-xs-2 mb-4 flex-column">
                            <label for="fechaFin">Fecha final</label>
                            <input name="fechaFin" id="fechaFin" value="{{ now()->format('Y-m-d') }}" type="date"
                                class="form-control">
                        </div>
                        <div class="col-xs-2 mb-4 flex-column">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Crear Proyecto') }}
                            </button>
                        </div>
                    </div>
                </div>


                <div>
                    <div class="d-flex flex-column">
                        <label for="des">Descripción</label>
                        <textarea id="des" class="description" name="description" required></textarea>

                        <script>ClassicEditor
                            .create( document.querySelector( '#des' ),{
                                toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'underline',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'undo',
						'redo',
						'fontFamily',
						'fontSize',
						'fontColor'
					]
				},
                language: 'es',
                            } )

                            .catch( error => {
                            console.error( error );
                            } );</script>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label class="" for="ib">IBAN</label>
                            <input id="ib" type="text" class="form-control" name="iban" required>

                        </div>
                    </div>
                </div>
        </form>
    </div>

    <script>/*
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
