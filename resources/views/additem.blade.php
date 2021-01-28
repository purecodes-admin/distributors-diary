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
    <form action="additem" method="POST" name="myForm" onsubmit="return validateForm()" id="addForm">
        @csrf
        <div class="flex flex-col w-1/2">
            <label for="name" class="leading-10 pl-2">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                placeholder="Name">
            <span class="ml-4 font-bold error" id="namemsg" style="color:Red;display:none">Item Name must be filled
                out!</span>

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
            var name = document.forms["myForm"]["name"].value;
            if (name == "") {
                document.getElementById("namemsg").style.display = ""
                return false;
            }

            $.ajax({
                type: 'POST',
                url: '/additem',
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
