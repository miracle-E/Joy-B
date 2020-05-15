@extends('layouts.default') @section('content')
<div class="kt-pagetitle">
    <h5>Subscribe Subject</h5>
</div>
<!-- kt-pagetitle -->

<div class="kt-pagebody">
    <form id="subject-form" action="{{ route('new-subject') }}" method="POST">
        <script src="https://js.paystack.co/v1/inline.js"></script>
        <button type="button" onclick="payWithPaystack()"> Pay </button>
        <!-- card -->
    </form>
    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
        <div class="row" style="margin-bottom:40px;">
          <div class="col-md-8 col-md-offset-2">
            <p>
                <div>
                    Lagos Eyo Print Tee Shirt
                    ₦ 2,950
                </div>
            </p>
            <input type="hidden" name="email" value="otemuyiwa@gmail.com"> {{-- required --}}
            <input type="hidden" name="orderID" value="345">
            <input type="hidden" name="amount" value="800"> {{-- required in kobo --}}
            <input type="hidden" name="quantity" value="3">
            <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

             <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
            <p>
              <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
              <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
              </button>
            </p>
          </div>
        </div>
    </form>
</div>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    function payWithPaystack(){
      var handler = PaystackPop.setup({
        key: 'pk_test_bfb817b2ac2f9ec1d440fca8f1f161a584d835c5',
        email: 'ekfinbarr@gmail.com',
        amount: 10000,
        // ref: ''+Math.floor((Math.random() * 1000000000) + 1),
        // generates a pseudo-unique reference. Please replace with a reference you generated.
        // Or remove the line entirely so our API will generate one for you
        metadata: {
           custom_fields: [
              {
                  display_name: "Mobile Number",
                  variable_name: "mobile_number",
                  value: "+2348012345678"
              }
           ]
        },
        callback: function(response){
            alert('success. transaction ref is ' + response.reference);
        },
        onClose: function(){
            alert('window closed');
        }
      });
      handler.openIframe();
    }
  </script>

@stop
