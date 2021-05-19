@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex">
    <div class="col-md-6">
        <div class="d-none">
            <form id="paygood" action="{{route('masplan',['plan'=>$plan])}}" method="PUT">
                @csrf
                @method('PUT')
            </form>
        </div>
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
    <div class="col-md-6">
    <div id="smart-button-container">
        <div style="text-align: center;">
          <div id="paypal-button-container" data-description={{$plan->nombre}} data-price={{$plan->precio}}></div>
        </div>
      </div>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR" data-sdk-integration-source="button-factory"></script>
    <script>
      function initPayPalButton() {
        paypal.Buttons({
          style: {
            shape: 'rect',
            color: 'blue',
            layout: 'vertical',
            label: 'pay',

          },

          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{"description":$("#paypal-button-container").data("description"),"amount":{"currency_code":"EUR","value":$("#paypal-button-container").data("price")}}]
            });
          },

          onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
              alert('Transaction completed by ' + details.payer.name.given_name + '!');
              $('#paygood').submit();
            });

          },

          onError: function(err) {
            console.log(err);
          }
        }).render('#paypal-button-container');
      }
      initPayPalButton();
    </script>
    </div>
</div>
</div>
@endsection
