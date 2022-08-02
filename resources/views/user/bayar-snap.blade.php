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
 
    <form action="{{ route('update.pembayaran') }}" method="POST" id="submit_form"> <!--form yg memiliki id submit_form-->
      @csrf
      <input type="hidden" name="id" value="{{ $snapToken }}">
      <input type="hidden" name="json" id="json_callback"> <!--element yg memiliki id json_callback-->
    </form>

    <script type="text/javascript">
      window.snap.pay('{{ $snapToken }}', { // ini fungsi yg emg disarankan dipake oleh midtrans jika gunakan snap
          onSuccess: function(result){
            /* You may add your own implementation here */
            // alert("payment success!"); console.log(result)
            send_response_to_form(result); // panggil fungsi send_response_to_form dibawah
          },
          onPending: function(result){
            /* You may add your own implementation here */
            // alert("wating your payment!"); console.log(result)
            send_response_to_form(result); // panggil fungsi send_response_to_form dibawah
          },
          onError: function(result){
            /* You may add your own implementation here */
            // alert("payment failed!"); console.log(result);
            send_response_to_form(result); // panggil fungsi send_response_to_form dibawah
          },
          onClose: function(){
            /* You may add your own implementation here */
            // alert('you closed the popup without finishing the payment');
            window.location = "{{ route('user.pesanan') }}"; // akan diarahkan ke route user.pesanan
          }
        })

        function send_response_to_form(result) { // fungsi send_response_to_form
          document.getElementById('json_callback').value = JSON.stringify(result); // ubah data yg didapat dari midtrans menjadi format JSON dan simpan ke element yg id nya json_callback
          $('#submit_form').submit(); // kirim form yg memiliki id submit_form
        }
    </script>
  </body>
</html>