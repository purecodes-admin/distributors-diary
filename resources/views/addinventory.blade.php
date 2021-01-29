@extends('layout/master')
@section('category', 'Add Stock')
@section('content')
    <h3 class="p-5 font-semibold text-lg underline text-blue-500 hover:text-blue-700">
        <span class="fas fa-user"></span>
        <a>Add Stock</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Stock Add to Inventory Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Stock Addition Failed...!!!
        </span>
    </h3>
    <form action="/store" method="POST" name="myForm" id="addForm" onsubmit=" return AddStock()">
        @csrf
        <div class="flex flex-col w-1/2">
            <label for="item_id" class="leading-10 pl-2">Item ID:</label>
            <select name="item_id" id="item_id"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                <option value="">Select Item_id</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <span class="ml-4 error font-bold" id="itemmsg" style="color:Red;display:none">Item Id must be
                Selected!</span>

        </div>

        <div class="flex flex-col w-1/2">
            <label for="price" class="leading-10 pl-2">Customer Type:</label>
            <select name="category" id="category"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                <option value="">Select Category</option>
                <option value="supplier">Supplier</option>
                <option value="purchaser">Purchaser</option>
            </select>
            <span class="ml-4 error font-bold" id="categorymsg" style="color:Red;display:none">Category must be
                filled
                out!</span>

        </div>


        <div class="flex flex-col w-1/2">
            <label for="customer_id" class="leading-10 pl-2">Supplier/Purchaser ID:</label>
            <select name="customer_id" id="customer_id"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">

                <option value="">Select ID</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach


            </select>
            <span class="ml-4 error font-bold" id="customermsg" style="color:Red;display:none">Customer ID must be
                filled
                out!</span>

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


        <div class="flex flex-col w-1/2">
            <label for="price" class="leading-10 pl-2">Price:</label>
            <input type="text" value="{{ old('price') }}" name="price"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Enter Price">

            <span class="ml-4 error font-bold" id="pricemsg" style="color:Red;display:none">Price must be filled
                out!</span> <span class="ml-4 error font-bold" id="pricemsg1" style="color:Red;display:none">Price
                must be filled
                out in digits only!</span>

        </div>



        <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-blue-500 hover:bg-blue-700 font-bold text-white ml-2 py-2 rounded" type="submit">Confirm
                Order</button><br>
        </div>

    </form>

    <script>
        function AddStock() {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);
            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';
            var token = document.forms["myForm"]["_token"].value;
            var item_id = document.forms["myForm"]["item_id"].value;
            if (item_id == "") {
                document.getElementById("itemmsg").style.display = ""
                return false;
            }

            var category = document.forms["myForm"]["category"].value;
            if (category == "") {
                document.getElementById("categorymsg").style.display = ""
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

            $.ajax({
                type: 'POST',
                url: '/store',
                data: {
                    item_id: item_id,
                    category: category,
                    customer_id: customer_id,
                    quantity: quantity,
                    price: price,
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
