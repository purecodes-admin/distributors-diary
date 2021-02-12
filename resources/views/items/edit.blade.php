@extends('layout/master')
@section('address', 'Update Records')
@section('content')
    <h3 class="p-5 font-semibold text-lg underline text-green-700 hover:text-green-900">
        <span class="fas fa-user"></span>
        <a>Update Items</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Item Updated Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Item Updation Failed...!!!
        </span>
    </h3>
    <form action="" method="POST" name="myForm" onsubmit="return validateForm()" id="updateForm">
        @csrf
        <input type="hidden" name="id" value="{{ $item->id }}">
        <div class="flex flex-col w-1/2">
            <label for="name" class="leading-10 pl-2">Name:</label>
            <input type="text" name="name" value="{{ old('name', $item->name) }}"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
            <span class="ml-4 font-bold error" id="namemsg" style="color:Red;display:none">Item Name must be filled
                out!</span>

        </div>

        <div class="flex flex-col w-1/2">
            <label for="price" class="leading-10 pl-2">Price:</label>
            <input type="text" value="{{ old('price', $item->price) }}" name="price"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Enter Price">

            <span class="ml-4 error font-bold" id="pricemsg" style="color:Red;display:none">Price must be filled
                out!</span> <span class="ml-4 error font-bold" id="pricemsg1" style="color:Red;display:none">Price
                must be filled
                out in digits only!</span>

        </div>

        <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-green-700 hover:bg-green-900 font-bold text-white ml-2 py-2 rounded"
                type="submit">Update</button><br>
        </div>
    </form>

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
            var price = document.forms["myForm"]["price"].value;
            if (price == "") {
                document.getElementById("pricemsg").style.display = ""
                return false;
            }
            var price = document.forms["myForm"]["price"].value;
            if (isNaN(price)) {
                document.getElementById("pricemsg1").style.display = ""
                return false;
            }

            $.ajax({
                type: 'POST',
                url: '/items/update',
                data: {
                    name: name,
                    price: price,
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
