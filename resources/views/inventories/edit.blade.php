@extends('layout/master')
@section('address', 'Update Stock')
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
                <a href="../" class="hover:underline">Inventories</a>
            </li>
            <li class="text-blue-700 hover:text-blue-900">
                <a>Update Stock</a>
            </li>
        </ul>
    </div>


    <h3 style="width: 88%; margin:auto;" class="p-5 font-semibold text-lg underline text-blue-700 hover:text-blue-900">
        <span class="fas fa-user"></span>
        <a>Update Stock</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Stock Updated to Inventory Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Stock Updation is Failed...!!!
        </span>
    </h3>

    <div style="width: 88%; margin:auto;">
        <form action="" method="POST" name="myForm" id="addForm">
            @csrf
            <input type="hidden" name="id" value="{{ $inventory->id }}">

            <div class="flex">
                <div class="flex flex-col w-1/2">
                    <label for="customer_id" class="leading-10 pl-2">Customer Name:</label>
                    <select name="customer_id" id="customer_id"
                        class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">

                        <option value="">Select Name</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" @if ($inventory->customer->id == $customer->id) selected='selected' @endif>{{ $customer->name }}</option>
                        @endforeach

                    </select>
                    <span class="ml-4 error font-bold" id="customermsg" style="color:Red;display:none">Customer ID must be
                        filled
                        out!</span>


                </div>

                <div class="flex flex-col w-1/2">
                    <label for="item_id" class="leading-10 pl-2 ml-2">Item Name:</label>
                    <select name="item_id" id="item_id"
                        class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                        <option value="">Select Item Name</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" @if ($inventory->item->id == $item->id) selected='selected' @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="ml-4 error font-bold" id="itemmsg" style="color:Red;display:none">Item Id must be
                        Selected!</span>

                </div>
            </div>

            <div class="flex">
                <div class="flex flex-col w-1/2">
                    <label for="quantity" class="leading-10 pl-2">Quantity:</label>
                    <input type="text" value="{{ old('quantity', $inventory->quantity) }}" name="quantity"
                        class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        placeholder="Quantity">

                    <span class="ml-4 error font-bold" id="quantitymsg" style="color:Red;display:none">Quantity must be
                        filled
                        out!</span>
                    <span class="ml-4 error font-bold" id="quantitymsg1" style="color:Red;display:none">Quantity must be
                        filled
                        in digits Only!</span>

                </div>

                <div class="flex flex-col w-1/2">
                    <label for="item_id" class="leading-10 pl-2 ml-2">Whole Sale Price:</label>

                    <input value="{{ $item->wholesale_price }}"
                        class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        readonly>
                </div>
            </div>
            <div class="flex">
                <div class="flex flex-col w-1/2">
                    <label for="item_id" class="leading-10 pl-2">Retail Sale Price:</label>
                    <input value="{{ $item->retailsale_price }}"
                        class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        readonly>
                </div>

                <div class="flex flex-col w-1/2">
                    <label for="price" class="leading-10 pl-2 ml-2">Price:</label>
                    <input type="text" value="{{ old('price', $inventory->price) }}" name="price"
                        class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        placeholder="Enter Price">

                    <span class="ml-4 error font-bold" id="pricemsg" style="color:Red;display:none">Price must be filled
                        out!</span> <span class="ml-4 error font-bold" id="pricemsg1" style="color:Red;display:none">Price
                        must be filled
                        out in digits only!</span>

                </div>
            </div>



            <div class="flex flex-col w-1/2 mt-2">
                <button class="disabled:opacity-50 bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                    type="submit" onclick="return UpdateStock(this)">Update
                    Record</button><br>
            </div>

        </form>
    </div>

    <script>
        function UpdateStock(e) {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);
            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';
            var token = document.forms["myForm"]["_token"].value;
            var id = document.forms["myForm"]["id"].value;

            var item_id = document.forms["myForm"]["item_id"].value;
            if (item_id == "") {
                document.getElementById("itemmsg").style.display = ""
                return false;
            }
            var customer_id = document.forms["myForm"]["customer_id"].value;
            if (customer_id == "") {
                document.getElementById("customermsg").style.display = ""
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

            $(e).prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: '/inventories/update',
                data: {
                    item_id: item_id,
                    customer_id: customer_id,
                    quantity: quantity,
                    price: price,
                    _token: token,
                    id: id
                },
                success: function(response) {
                    document.getElementById("success").style.display = ""
                    $("#addForm").trigger("reset");
                },
                error: function(res) {
                    document.getElementById("danger").style.display = ""
                },
                complete: function(res) {
                    $(e).prop('disabled', false);
                }
            });

            return false;

        }

    </script>

@endsection
