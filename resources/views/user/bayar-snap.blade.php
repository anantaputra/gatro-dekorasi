<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    @if (env('MIDTRANS_PRODUCTION') == false)
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @else 
    <script type="text/javascript"
      src="https://app.midtrans.com/snap/snap.js"
      data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @endif
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 
  </head>
 
  <body>
 
    <form action="{{ route('update.pembayaran') }}" method="POST" id="submit_form">
      @csrf
      <input type="hidden" name="id" value="{{ $snapToken }}">
      <input type="hidden" name="json" id="json_callback">
    </form>

    <script type="text/javascript">
      window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            // alert("payment success!"); 
            // console.log(result);
            send_response_to_form(result);
            // window.location = "{{ route('user.pesanan') }}";
          },
          onPending: function(result){
            /* You may add your own implementation here */
            // alert("wating your payment!"); 
            // console.log(result);
            send_response_to_form(result);
            // console.log(result)
            // window.location = "{{ route('user.pesanan') }}";
          },
          onError: function(result){
            /* You may add your own implementation here */
            // alert("payment failed!"); console.log(result);
            send_response_to_form(result);
            // window.location = "{{ route('user.pesanan') }}";
          },
          onClose: function(result){
            /* You may add your own implementation here */
            // alert('you closed the popup without finishing the payment');
            // send_response_to_form(result);
            window.location = "{{ route('user.pesanan') }}";
            // console.log(result)
          }
        })

        function send_response_to_form(result) {
          document.getElementById('json_callback').value = JSON.stringify(result);
          $('#submit_form').submit();
        }
    </script>
  </body>
</html>