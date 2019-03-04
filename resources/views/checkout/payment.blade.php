@extends('layouts.center-layout')

@section('content')
    <div class="container">


        Proceed with Payment at this screen

        <div id="checkoutBtn"></div>
        <!-- Load the required checkout.js script -->
        <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>

        <!-- Load the required Braintree components. -->
        <script src="https://js.braintreegateway.com/web/3.39.0/js/client.min.js"></script>
        <script src="https://js.braintreegateway.com/web/3.39.0/js/paypal-checkout.min.js"></script>

        <script>
            paypal.Button.render({
                braintree: braintree,
                client: {
                    production: 'CLIENT_TOKEN_FROM_SERVER',
                    sandbox: '{{$clientToken}}'
                },
                env: 'sandbox',
                commit: true, // This will add the transaction amount to the PayPal button

                payment: function (data, actions) {
                    return actions.braintree.create({
                        flow: 'checkout', // Required
                        amount: 10.00, // Required
                        currency: 'USD', // Required
                        enableShippingAddress: false,

                    });
                },

                onAuthorize: function (payload) {
                    alert(payload);

                    $.post("{{route('confirmPaymentStep')}}",
                        {
                            paymentNo: payload.nonce,
                            data: payload,
                            "_token": "{{ csrf_token() }}",
                        },
                        function(data, status){
                            alert("Data: " + data + "\nStatus: " + status);
                        });


                },
            }, '#checkoutBtn');
        </script>
    </div>
@endsection
