@extends('layout/master')
@section('address', 'Update Records')
@section('content')

    {{-- code for breadcrumbs --}}
    <style>
        ul.breadcrumbs li+li :before {
            padding: 8px;
            color: black;
            content: "/\00a0";
        }

    </style>
    <div style="width: 88%; margin:auto;">
        <ul class="flex p-3 bg-gray-200 breadcrumbs">
            <li class="mr-2 text-gray-700 hover:text-gray-900">
                <a href="../" class="hover:underline">Items</a>
            </li>
            <li class="text-blue-700 hover:text-blue-900">
                <a href="">Edit Item</a>
            </li>
        </ul>
    </div>


    <h3 style="width: 88%; margin:auto;" class="p-5 font-semibold text-lg underline text-blue-700 hover:text-blue-900">
        <span class="fas fa-user"></span>
        <a>Update Items</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Item Updated Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Item Updation Failed...!!!
        </span>
    </h3>

    <div style="width: 88%; margin:auto;">
        <form action="" method="POST" name="myForm" onsubmit="return validateForm()" id="updateForm">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <div class="flex flex-col md:w-1/2">
                <label for="name" class="leading-10 pl-2">Name:</label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                <span class="ml-4 font-bold error" id="namemsg" style="color:Red;display:none">Item Name must be filled
                    out!</span>

            </div>

            <div class="flex flex-col md:w-1/2">
                <label for="wholesale_price" class="leading-10 pl-2">Whole Sale Price:</label>
                <input type="text" value="{{ old('wholesale_price', $item->wholesale_price) }}" name="wholesale_price"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Enter Whole sale Price">

                <span class="ml-4 error font-bold" id="pricemsg" style="color:Red;display:none">Price must be filled
                    out!</span> <span class="ml-4 error font-bold" id="pricemsg1" style="color:Red;display:none">Price
                    must be filled
                    out in digits only!</span>

            </div>

            <div class="flex flex-col md:w-1/2">
                <label for="retailsale_price" class="leading-10 pl-2">Retail Sale Price:</label>
                <input type="text" value="{{ old('retailsale_price', $item->retailsale_price) }}" name="retailsale_price"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Enter Retail Price">

                <span class="ml-4 error font-bold" id="r_pricemsg" style="color:Red;display:none">Retail Price must be
                    filled
                    out!</span> <span class="ml-4 error font-bold" id="r_pricemsg1" style="color:Red;display:none">Retail
                    Price
                    must be filled
                    out in digits only!</span>

            </div>

            <div class="flex flex-col md:w-1/2 mt-2">
                <button class="bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                    type="submit">Update</button><br>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var id = document.forms["myForm"]["id"].value;
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
                url: '/items/update',
                data: {
                    // the second one is variable
                    name: name,
                    wholesale_price: wholesale_price,
                    retailsale_price: retailsale_price,
                    _token: token,
                    id: id
                },
                success: function(response) {
                    document.getElementById("success").style.display = ""
                },
                error: function(res) {
                    document.getElementById("danger").style.display = ""
                }
            });

            return false;

        }

    </script>
@endsection
