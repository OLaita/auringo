@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div style="background-color:#272932;color:white" class="card">
                <div style="margin-top:20px"class="row justify-content-center">
                <svg height="80"  viewBox="0 0 35 60" width="80" xmlns="http://www.w3.org/2000/svg"><g id="014---Penguin" fill="none"><g id="Icons" transform="translate(1 1)"><path id="Shape" d="m27.81 53.46 5.19 4.54h-12z" fill="#ffdc00"/><path id="Shape" d="m33 22v28l-12 8h-14l7-7 7-10-5-3v-9l-7-12.25 11.27-6.57z" fill="#cfd8dc"/><path id="Shape" d="m30 22.44v27c.0016321.3380647-.1676544.6540662-.45.84l-11.55 7.72h-11l7-7 7-10-5-3v-9l-7-12.25 9.42-5.5 11.26 10.45c.2057808.1908345.3218991.459358.32.74z" fill="#f5f5f5"/><path id="Shape" d="m11 35 3 16-7 7-7-36 9-5.25 7 12.25z" fill="#283593"/><path id="Shape" d="m32 3-8 5-3.69-5.9z" fill="#fec108"/><path id="Shape" d="m27.9 2.68-5.19 3.25-2.4-3.83z" fill="#ffdc00"/><path id="Shape" d="m16 38v-9l-5 6z" fill="#283593"/><g fill="#3f51b5"><path id="Shape" d="m14 51-3-16 10 6z"/><path id="Shape" d="m0 22 24-14-5-8h-10z"/></g></g><path id="Shape" d="m8 60h26c.4156318-.0005971.7875631-.2582244.9342317-.6471183.1466686-.388894.0374929-.8279673-.2742317-1.1028817l-4.21-3.68 4.1-2.74c.2793852-.1839835.4482694-.4954809.45-.83v-28c-.0008916-.2771651-.1167768-.5415282-.32-.73l-11.74-10.91 2.59-1.52 8-5c.3616535-.23004378.5364855-.66498276.4346614-1.08133024s-.4576578-.72150407-.8846614-.75866976l-11.23-.93-1-1.6c-.1831155-.29298545-.5044985-.47069139-.85-.47h-10c-.40734353-.00204015-.77521263.24320592-.93.62-9.83 24-9 21.87-9 22.11s-.54-2.21 7 36.46c.086783.4517743.47058942.7860573.93.81zm23.34-2h-6l3.43-2.28zm1.66-34.56v27l-11.3 7.56h-11.29c6.35-6.35 5.11-5.1 5.32-5.33s1.68-2.37 7.09-10.1c.1583117-.2278668.2148333-.5112655.1560493-.7824303s-.2275885-.5057165-.4660493-.6475697l-4.51-2.71c0-9.2.06-8.57-.14-8.92l-6.5-11.4 9.77-5.7zm-12.43 18.87-5 7.17-2.18-11.48zm-7-6.57 2.48-3v4.47zm16.4-31-4.6 2.87-2.2-3.43zm-19.3-2.74h8.78l4.16 6.66-20.61 11.99zm-1 17.12 6.16 10.77-4.56 5.47c-.1879358.2287694-.2648386.5290567-.21.82l2.9 15.49-5.34 5.33-6.5-33.45z" fill="#000"/></g></svg>
                </div>
                <div style="font-size:24px"class="card-header row justify-content-center">{{ __('Registrate') }}</div>

                <div style="background-color:#272932" class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                    <div id="prim">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="pri form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
