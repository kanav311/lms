@extends('layouts.checkout')
@section('page-title',$method->label)


@section('payment-content')


    <table class="table table-striped">
       <tr>
           <th>{{ __lang('amount') }}</th>
           <td>{{ price(getCart()->getCurrentTotal()) }}</td>
       </tr>
        <tr>
            <th>{{ __lang('invoice-id') }}</th>
            <td>{{ $invoice->id }}</td>
        </tr>

    </table>
    <div class="text-center">

    <script src="https://www.paypal.com/sdk/js?client-id={{  trim(paymentOption($code,'client_id')) }}{!! $funding  !!}&currency={{ strtoupper($invoice->currency->country->currency_code) }}"></script>


    <div id="paypal-button-container"></div>

        <script>

            paypal.Buttons({

                // Order is created on the server and the order id is returned

                createOrder() {

                    return fetch("{{ route('cart.method',['function'=>'aiipltech_send','code'=>$code]) }}", {

                        method: "POST",

                        headers: { "Content-Type": "application/json",},


                    })

                        .then((response) => response.json())

                        .then((order) => order.id);

                },

                // Finalize the transaction on the server after payer approval

                onApprove(data) {

                    return fetch("{{ route('cart.callback',['code'=>$code]) }}", {

                        method: "POST",

                        headers: {

                            "Content-Type": "application/json",

                        },

                        body: JSON.stringify({

                            orderID: data.orderID

                        })

                    })

                        .then((response) => response.json())

                        .then((orderData) => {

                            // Successful capture! For dev/demo purposes:

                            //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                           // const transaction = orderData.purchase_units[0].payments.captures[0];

                            if(orderData.status=='COMPLETED'){
                                $('#paypal-button-container').html('<h3>{{ __('default.payment-completed') }}</h3>');
                                window.location.href = '{{ route('student.student.mysessions') }}';
                            }else{
                                alert('{{ __('default.payment-failed!') }}');
                            }


                            // When ready to go live, remove the alert and show a success message within this page. For example:

                            // const element = document.getElementById('paypal-button-container');

                            // element.innerHTML = '<h3>Thank you for your payment!</h3>';

                            // Or go to another URL:  window.location.href = 'thank_you.html';

                        });

                }

            }).render('#paypal-button-container');

        </script>
    </div>

@endsection
