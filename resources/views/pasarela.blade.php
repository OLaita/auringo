@extends('layouts.app')

@section('content')
<div class="container">
<div class="row d-flex">
    <div class="col-md-6">
                    <script>
                        $(document).ready(function() {
                            var i = {!! json_encode($plan->id) !!};
                            $(".ventaj"+i).each(function(){
                                var vent = {!! json_encode($plan->ventajas) !!};
                                $(this).append("<br>"+vent);
                            })

                        })
                    </script>

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title text-muted">Contribuir con {{$plan->precio}}€</h5>
                          <h4 class="card-subtitle mb-2">{{$plan->nombre}}</h4>
                          <p class="ventaj{{$plan->id}} card-text">{{$plan->descripcion}}</p>
                          <p class="card-text">Participantes: {{$plan->participantes}}</p>
                          <p class="card-text text-muted">Fecha de entrega estimada:<br> {{$plan->fechaEntrega}}</p>
                        </div>
                      </div>
    </div>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">

                @if (Session::has('success'))
                <div class="alert alert-primary text-center">
                    <p>{{ Session::get('success') }}</p>
                </div>
                @endif

                <form role="form" action="{{ route('make-payment') }}" method="post" class="stripe-payment"
                    data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                    id="stripe-payment">
                    @csrf
                <input hidden value="{{$plan->precio}}" name="dineros">
                <input hidden value="{{$plan->nombre}}" name="nombre">
                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Nombre</label> <input class='form-control'
                                size='4' type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Numero de la tarjeta</label> <input autocomplete='off'
                                class='form-control card-num' size='20' type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label>
                            <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 595'
                                size='4' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Mes Expiración</label> <input
                                class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Año Expiración</label> <input
                                class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-md-12 hide error form-group'>
                            <div class='alert-danger alert'>Fix the errors before you begin.</div>
                        </div>
                    </div>

                    <div class="row">
                        <button class="btn btn-success btn-lg btn-block" type="submit">Pagar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function () {
        var $form = $(".stripe-payment");
        $('form.stripe-payment').bind('submit', function (e) {
            var $form = $(".stripe-payment"),
                inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeRes);
            }

        });

        function stripeRes(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });

</script>
@endsection
