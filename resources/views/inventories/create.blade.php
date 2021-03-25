@extends('layout/master')
@section('category', 'Add Stock')
@section('content')


    {{-- code for breadcrumbs --}}
    <style>
        ul.breadcrumbs li+li :before {
            padding: 8px;
            color: black;
            content: "/\00a0";
        }

    </style>

    <ul class="flex p-3 bg-gray-200 breadcrumbs">
        <li class="mr-2 text-gray-700 hover:text-gray-900">
            <a href="../inventories" class="hover:underline">Inventories</a>
        </li>
        <li class="text-blue-700 hover:text-blue-900">
            <a href="">Add Inventory</a>
        </li>
    </ul>


    <h3 class="p-5 font-semibold text-lg underline text-blue-700 hover:text-blue-900">
        <span class="fas fa-user"></span>
        <a>Add Inventory</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Stock Add to Inventory Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Stock Addition Failed...!!!
        </span>
    </h3>
    {{-- server side errors like Out of Stock in this div --}}
    <div id="errors"></div>
    <form action="store" method="POST" name="myForm" id="addForm" onsubmit=" return AddStock()">
        @csrf
        <div class="flex">
            <div class="flex flex-col w-1/2">
                <label for="type" class="leading-10 pl-2">Customer Type:</label>

                <select onchange="change(this.value)" name="category" id="category" style=" text-decoration:none;"
                    class="ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                    <option value="">Select Category</option>
                    <option value="supplier" {{ request()->get('category') == 'supplier' ? 'selected' : '' }}>Supplier
                    </option>
                    <option value="purchaser" {{ request()->get('category') == 'purchaser' ? 'selected' : '' }}>Purchaser
                    </option>
                </select>
                <span class="ml-4 error font-bold" id="categorymsg" style="color:Red;display:none">Category must be
                    filled
                    out!</span>

            </div>
            <div class="flex flex-col w-1/2">
                <label for="customer_id" class="leading-10 pl-2 ml-2">Customer Name:</label>
                <select name="customer_id" id="sub_category"
                    class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">

                    <option value="">Select Name</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>

                    @endforeach


                </select>
                <span class="ml-4 error font-bold" id="customermsg" style="color:Red;display:none">Customer ID must be
                    filled
                    out!</span>

            </div>
        </div>

        <div class="flex">
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
                <label for="quantity" class="leading-10 pl-2 ml-2">Quantity:</label>
                <input type="text" value="{{ old('quantity') }}" name="quantity"
                    class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Quantity">

                <span class="ml-4 error font-bold" id="quantitymsg" style="color:Red;display:none">Quantity must be
                    filled
                    out!</span>
                <span class="ml-4 error font-bold" id="quantitymsg1" style="color:Red;display:none">Quantity must be
                    filled
                    in digits Only!</span>

            </div>
        </div>

        <div class="w-1/2">
            <label for="price" class="leading-10 pl-2">Price:</label><br>
            <input type="radio" value="whole_sale" name="total_price"
                class=" ml-2 mr-2 border focus:ring-gray-500 focus:border-gray-900 sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 t_price">Whole
            Sale Price <br>
            <input type="radio" value="retail_price" name="total_price"
                class=" ml-2 mr-2 border focus:ring-gray-500 focus:border-gray-900 sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 t_price">Retail
            Price<br>
            <input type="text" value="{{ old('price') }}" name="price" id="price"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Enter Price">


            <span class="ml-4 error font-bold" id="pricemsg" style="color:Red;display:none">Price must be filled
                out!</span>
            <span class="ml-4 error font-bold" id="pricemsg1" style="color:Red;display:none">
                Price
                must be filled
                out in digits only!</span>

        </div>

        <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded" type="submit">Confirm
                Order</button><br>
        </div>

    </form>

    <script>
        $(".t_price").change(function() {
            var price = $(this).val();

            $.ajax({
                type: 'get',
                url: 'prices?id=' + $("#item_id").val(),
                success: function(response) {

                    if (price == 'whole_sale') {
                        $("#price").val(response.wholesale_price);
                    }
                    if (price == 'retail_price') {
                        $("#price").val(response.retailsale_price);
                    }

                    // $("#price").val(response.price);
                    console.log(response)

                },
                error: function(res) {
                    console.log(res)

                }

            });

        });

        function change(cat) {
            window.location = window.location.pathname + "?category=" + cat;
        }

        function AddStock() {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);
            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';
            var token = document.forms["myForm"]["_token"].value;

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
                url: 'store',
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
                    $("#category").val($("#category option:first").val());
                },
                error: function(res) {
                    console.log(res);
                    let errors = res.responseJSON.message;

                    let html = '<div style="color: red; font-weight:bold; margin-left:20px;">';
                    html += '<p>' + errors + '</p>';
                    html += '</div>';

                    document.getElementById('errors').innerHTML = html;
                    document.getElementById("danger").style.display = ""
                }
            });

            return false;

        }

    </script>

@endsection
