@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('googleLogin',$user->id) }}">
                        @csrf
                        @method('PUT')

                    <div id="prim">
                        <input id="id" type="text" class="pri form-control" name="id" value="{{ $user->provider_id }}" required autocomplete="id" hidden>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="pri form-control  @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="pri form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname">

                                <!--@error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Pais') }}</label>

                            <div class="col-md-6">
                                <select name="country" class="form-control">
                                @foreach($p as $pais)
                                    <option value="{{$pais}}">{{$pais}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="next" class="btn btn-primary">
                                    {{ __('Siguiente') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="seg" class="d-none">
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input disabled id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required autocomplete="email">

                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="prev" type="button" class="btn btn-primary">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        $("#next").click(function(){
            $b = false;
            $(".pri").each(function(){
                if($.trim($(this).val()) == ""){
                    $b = true;
                }
            })

            if(!$b){
                $("#prim").addClass("d-none");
                $("#seg").removeClass("d-none");
            }

        })
        $("#prev").click(function(){
            $("#seg").addClass("d-none");
            $("#prim").removeClass("d-none");
        })
    });

</script>
@endsection
