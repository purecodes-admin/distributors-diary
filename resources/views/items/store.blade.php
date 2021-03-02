@extends('layout/master')
@section('address', 'Add Items')
@section('content')
    <h3 class="p-5 font-semibold text-lg underline text-green-700     hover:text-green-900">
        <span class="fas fa-user"></span>
        <a>Add Items</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Item Submitted Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Item Submittion Failed...!!!
        </span>
    </h3>
    <form action="add" method="POST" name="myForm" id="addForm">
        @csrf
        <div class="flex flex-col w-1/2">
            <label for="name" class="leading-10 pl-2">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                placeholder="Name">
            <span class="ml-4 font-bold error" id="namemsg" style="color:Red;display:none">Item Name must be filled
                out!</span>

        </div>

        <div class="flex flex-col w-1/2">
            <label for="wholesale_price" class="leading-10 pl-2">Whole Sale Price:</label>
            <input type="text" value="{{ old('wholesale_price') }}" name="wholesale_price"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Enter Whole Sale Price">

            <span class="ml-4 error font-bold" id="pricemsg" style="color:Red;display:none">Whole Sale Price must be filled
                out!</span> <span class="ml-4 error font-bold" id="pricemsg1" style="color:Red;display:none">Whole Sale
                Price
                must be filled
                out in digits only!</span>

        </div>
        <div class="flex flex-col w-1/2">
            <label for="retailsale_price" class="leading-10 pl-2">Retail Sale Price:</label>
            <input type="text" value="{{ old('retailsale_price') }}" name="retailsale_price"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Enter Retail Price">

            <span class="ml-4 error font-bold" id="r_pricemsg" style="color:Red;display:none">Retail Price must be filled
                out!</span> <span class="ml-4 error font-bold" id="r_pricemsg1" style="color:Red;display:none">Retail Price
                must be filled
                out in digits only!</span>

        </div>

        <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-green-700 hover:bg-green-900 font-bold text-white ml-2 py-2 rounded" type="button"
                onclick="return validateForm()">Add</button><br>
        </div>
    </form>

    <script>
        function validateForm() {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var token = document.forms["myForm"]["_token"].value;
            var name = document.forms["myForm"]["name"].value;
            if (name == "") {
                document.getElementById("namemsg").style.display = ""
                return false;
            }
            var wholesale_price = document.forms["myForm"]["wholesale_price"].value;
            if (wholesale_price == "") {
                document.getElementById("pricemsg").style.display = ""
                return false;
            }
            var wholesale_price = document.forms["myForm"]["wholesale_price"].value;
            if (isNaN(wholesale_price)) {
                document.getElementById("pricemsg1").style.display = ""
                return false;
            }
            var retailsale_price = document.forms["myForm"]["retailsale_price"].value;
            if (retailsale_price == "") {
                document.getElementById("r_pricemsg").style.display = ""
                return false;
            }
            var retailsale_price = document.forms["myForm"]["retailsale_price"].value;
            if (isNaN(retailsale_price)) {
                document.getElementById("r_pricemsg1").style.display = ""
                return false;
            }

            $.ajax({
                type: 'POST',
                url: 'add',
                data: {
                    name: name,
                    wholesale_price: wholesale_price,
                    retailsale_price: retailsale_price,
                    _token: token
                },
                success: function(response) {
                    document.getElementById("success").style.display = ""
                    $("#addForm").trigger("reset");
                },
                error: function(res) {
                    document.getElementById("danger").style.display = ""
                }
            });

            return false;

        }

    </script>
@endsection
