@extends('layout/master')
@section('address', 'Add Items')
@section('content')
    <h3 class="p-5 font-semibold text-lg underline text-blue-500     hover:text-blue-700">
        <span class="fas fa-user"></span>
        <a>Add Items</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Item Submitted Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Item Submittion Failed...!!!
        </span>
    </h3>
    <form action="add" method="POST" name="myForm" onsubmit="return validateForm()" id="addForm">
        @csrf

        <div class="flex flex-col w-1/2">
            <label for="item_id" class="leading-10 pl-2">Item Name:</label>
            <select name="item_id" id="item_id"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                <option value="">Select Item Name</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <span class="ml-4 error font-bold" id="itemmsg" style="color:Red;display:none">Item Id must be
                Selected!</span>

        </div>

        <div class="flex flex-col w-1/2">
            <label for="quantity" class="leading-10 pl-2">Quantity:</label>
            <input type="text" value="{{ old('quantity') }}" name="quantity"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Quantity">

            <span class="ml-4 error font-bold" id="quantitymsg" style="color:Red;display:none">Quantity must be
                filled
                out!</span>
            <span class="ml-4 error font-bold" id="quantitymsg1" style="color:Red;display:none">Quantity must be
                filled
                in digits Only!</span>

        </div>

        <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-blue-500 hover:bg--700 font-bold text-white ml-2 py-2 rounded" type="submit">Add</button><br>
        </div>
    </form>

    <script>
        function validateForm() {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var token = document.forms["myForm"]["_token"].value;

            var item_id = document.forms["myForm"]["item_id"].value;
            if (item_id == "") {
                document.getElementById("itemmsg").style.display = ""
                return false;
            }
            var quantity = document.forms["myForm"]["quantity"].value;
            if (quantity == "") {
                document.getElementById("quantitymsg").style.display = ""
                return false;
            }
            var quantity = document.forms["myForm"]["quantity"].value;
            if (isNaN(quantity)) {
                document.getElementById("quantitymsg1").style.display = ""
                return false;
            }

            $.ajax({
                type: 'POST',
                url: 'add',
                data: {
                    name: name,
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
