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
            margin-left: 30px;
        }

        @media (max-width: 1000px) {
            .wrap-chiquito {
                flex-direction: column;
            }

            .miniwidth {
                width: 100%;
            }

            .maxiwidth {
                justify-content: center;
                width: 300%;
            }
        }

    </style>
    <div class="container">
        <form id="proUpdate" method="POST" action="{{route('pro.update',$pro->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row d-flex justify-content-center">


                <div class="col-md-5">
                    <input placeholder="Titulo" id="title" type="text" class="form-control" name="title" value="{{ $pro->title }}" required autofocus>
                </div>
            </div>

            <div class="form-group row d-flex justify-content-center">
                <div class="col-md-6">
                    <input placeholder="Descripcion Corta" id="descC" type="text" class="form-control" name="descC" value="{{ $pro->desCorta }}" required>
                </div>
            </div>
            <div class="container">
                <div class="row align-items-start wrap-chiquito">
                    <div class="col-1"></div>
                    <div class="col-6 d-flex justify-content-center align-items-center miniwidth">
                        @if ($pro->fotoProyecto != null)
                            <img style="margin-top: 1vh;height: 80%; position: absolute; z-index: 2;max-width: 90%;" src="{{asset('storage/'.$pro->fotoProyecto)}}">
                            <a href="{{route('imgDel',['id'=>$pro->id])}}" role="button" style="position:absolute;z-index:10;" class="btn btn-danger">Cambiar imagen</a>
                        @endif
                        <img style="position: absolute;z-index:-2;" class="bi bi-cloud-arrow-up-fill upload-icon fa-5x"><br>
                        <input style="opacity:0" class="dropzone " id="upload-input" name="image" type="file" onchange="previewFile()"><br><br>
                        <img id="preview" style="margin-top: 1vh;height: 80%; position: absolute; z-index: -1;max-width: 90%;" src="" height="150" alt="Image preview...">
                    </div>

                    <div class="col-4">
                        <div class="mb-2 ">
                            <label for="meta">Meta</label>
                            <div class="d-flex maxiwidth">
                                <input value="{{$pro->meta}}" min="1" max="99999999" id="meta" name="meta" placeholder="3000" type="number" class=" form-control" aria-label="meta" aria-describedby="euros">
                                <span class="input-group-text" id="euros">€</span>
                            </div>
                        </div>
                        <div class="mb-2 ">
                            <label for="cat">Categoria</label>
                            <input value="{{$pro->cate->categoria}}" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="fechaFin">Fecha final</label>
                            <input name="fechaFin" id="fechaFin" value="{{ $pro->fechaFin }}" type="date" class="form-control maxiwidth">
                        </div>
                        <div class="row mt-4 form-group row d-flex justify-content-center">
                            <div class=" mb-4">
                                <button id="btnSubmit" style="background-color:#272932;border:#272932" type="button" class="btn btn-primary btnmini">
                                    {{ __('Actualizar Proyecto') }}
                                </button>
                            </div>
                            <div id="al" class="d-none alert alert-danger" role="alert">
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
                        <input value="{{$pro->iban}}" id="ib" type="text" class="form-control" name="iban" required>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>

        $("#btnSubmit").click(function() {
            $("#al").addClass("d-none");
            $("#al").html("");
            var error = false;
            var now = new Date();
            var d = new Date($('input[type="date"]').val());
            var now = new Date(now.getFullYear(), now.getMonth(), now.getDate());

            if (d < now) {
                error = true;
                $("#al").append("<ul><li>La fecha final del proyecto no puede ser inferior a la actual</li></ul>");
            }

            if ($('#title').val().trim() == "") {
                error = true;
                $("#al").append("<ul><li>El titulo esta vacio</li></ul>");
            }

            if ($('#descC').val().trim() == "") {
                error = true;
                $("#al").append("<ul><li>La descripcion esta vacia</li></ul>");
            }

            if ($('#meta').val().trim() == "") {
                error = true;
                $("#al").append("<ul><li>La meta esta vacia</li></ul>");
            }

            if (!fn_ValidateIBAN($("#ib").val())) {
                error = true;
                $("#al").append("<ul><li>El IBAN esta mal</li></ul>");
            }


            if (error) {
                $("#al").removeClass("d-none");
            } else {
                $("#proUpdate").submit();
            }


        });

        function fn_ValidateIBAN(IBAN) {

            //Se pasa a Mayusculas
            IBAN = IBAN.toUpperCase();
            //Se quita los blancos de principio y final.
            IBAN = IBAN.trim();
            IBAN = IBAN.replace(/\s/g, ""); //Y se quita los espacios en blanco dentro de la cadena

            var letra1, letra2, num1, num2;
            var isbanaux;
            var numeroSustitucion;
            //La longitud debe ser siempre de 24 caracteres
            if (IBAN.length != 24) {
                return false;
            }

            // Se coge las primeras dos letras y se pasan a números
            letra1 = IBAN.substring(0, 1);
            letra2 = IBAN.substring(1, 2);
            num1 = getnumIBAN(letra1);
            num2 = getnumIBAN(letra2);
            //Se sustituye las letras por números.
            isbanaux = String(num1) + String(num2) + IBAN.substring(2);
            // Se mueve los 6 primeros caracteres al final de la cadena.
            isbanaux = isbanaux.substring(6) + isbanaux.substring(0, 6);

            //Se calcula el resto, llamando a la función modulo97, definida más abajo
            resto = modulo97(isbanaux);
            if (resto == 1) {
                return true;
            } else {
                return false;
            }
        }

        function modulo97(iban) {
            var parts = Math.ceil(iban.length / 7);
            var remainer = "";

            for (var i = 1; i <= parts; i++) {
                remainer = String(parseFloat(remainer + iban.substr((i - 1) * 7, 7)) % 97);
            }

            return remainer;
        }

        function getnumIBAN(letra) {
            ls_letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            return ls_letras.search(letra) + 10;
        }

        var section = {!!json_encode($pro->section)!!};
        $("#des").html(section);

        $('#des').trumbowyg({
            lang: 'es',
            btns: [
                ['viewHTML'],
                ['undo', 'redo'],
                ['fontfamily', 'fontsize'],
                ['formatting'],
                ['strong', 'em'],
                ['link'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['fullscreen']
            ]
        });






        function previewFile() {
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
        }
    </script>
    @endsection
