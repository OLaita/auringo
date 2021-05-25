@extends('layouts.app')

@section('content')
<div id="smart-button-container">
    <div style="text-align: center;">
      <div id="paypal-button-container"></div>
    </div>
  </div>
<script src="https://www.paypal.com/sdk/js?client-id=ATNoI1w2KPZ7u8OPwY5P4UDPWSlqV6i0z74Z3RKQKA4rsfsauKy-bGvhgMDEx2-LCezECZxuKdZH3sIs&currency=EUR" data-sdk-integration-source="button-factory"></script>
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
          purchase_units: [{"description":"das","amount":{"currency_code":"EUR","value":1}}]
        });
      },

      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          alert('Transaction completed by ' + details.payer.name.given_name + '!');
        });
      },

      onError: function(err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
</script>
@endsection
