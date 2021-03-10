@extends('layout/admin-master')
@section('title', 'Fee Records')
@section('content')
    <h3 class="p-5 font-semibold text-lg underline text-blue-700 hover:text-blue-900">
        <span class="fas fa-user"></span>
        <a>Billings</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Fee Submitted Successfully...!!!
        </span>
        <span id="danger" class=" ml-60 font-bold" style="color:red; display:none;">
            Fee Subbmission Failed...!!!
        </span>
    </h3>
    <form action="" method="POST" name="myForm" id="addForm" onsubmit="return FeeForm()">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="flex flex-col w-1/2">
            <label class="leading-10 pl-2">Payable Amount</label>
            <input type="text" value="{{ $user->payment }}"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                readonly>

        </div>


        <div class="flex flex-col w-1/2">
            <label for="payment" class="leading-10 pl-2">Amount Paid:</label>
            <input type="text" value="{{ old('payment') }}" name="payment"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Amount">
            <span class="ml-4 error font-bold text-sm" id="paymentmsg" style="color:Red;display:none">Amount must be filled
                out!</span>

        </div>


        <div class="flex flex-col w-1/2">
            <label for="mode" class="leading-10 pl-2">Payment Mode:</label>
            <input type="text" value="{{ old('mode') }}" name="mode"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Mode">
            <span class="ml-4 error font-bold text-sm" id="modemsg" style="color:Red;display:none">Payment Mode must be
                filled
                out!</span>

        </div>


        <div class="flex flex-col w-1/2">
            <label for="date" class="leading-10 pl-2">Date:</label>
            <input type="month" value="{{ old('date') }}" name="date"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
            <span class="ml-4 error font-bold text-sm" id="datemsg" style="color:Red;display:none">Date must be
                filled
                out!</span>

        </div>

        <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                type="submit">Pay</button><br>
        </div>

    </form>

    <script>
        function FeeForm() {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            // Code For Remove validation messages after field validate...
            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var token = document.forms["myForm"]["_token"].value;
            var id = document.forms["myForm"]["id"].value;

            var payment = document.forms["myForm"]["payment"].value;
            if (payment == "") {
                document.getElementById("paymentmsg").style.display = ""
                return false;
            }
            var mode = document.forms["myForm"]["mode"].value;
            if (mode == "") {
                document.getElementById("modemsg").style.display = ""
                return false;
            }
            var date = document.forms["myForm"]["date"].value;
            if (date == "") {
                document.getElementById("datemsg").style.display = ""
                return false;
            }


            $.ajax({
                type: 'POST',
                url: '/users/Submit-fee',
                data: {
                    payment: payment,
                    mode: mode,
                    date: date,
                    _token: token,
                    id: id
                },
                success: function(response) {
                    document.getElementById("success").style.display = ""
                    return false;
                },
                error: function(res) {
                    document.getElementById("danger").style.display = ""
                    return false;
                }
            });

            return false;

        }

    </script>
@endsection
