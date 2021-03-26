@extends('layout/admin-master')
@section('address', 'Add Tags')
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
                <a href="../users/tags" class="hover:underline">Tags</a>
            </li>
            <li class="text-blue-700 hover:text-blue-900">
                <a href="">Create Tags</a>
            </li>
        </ul>
    </div>



    <h3 style="width: 88%; margin:auto;" class="p-5 font-semibold text-lg underline text-blue-700     hover:text-blue-900">
        <span class="fas fa-user"></span>
        <a>Create New Tags</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Tag Created Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Tag Creation Failed...!!!
        </span>
    </h3>
    <div style="width: 88%; margin:auto;">
        <form name="myForm" id="addForm" method="POST" onsubmit="return validateForm()">
            @csrf
            <div class="flex flex-col md:w-1/2">
                <label for="label" class="leading-10 pl-2">Label:</label>
                <input type="text" name="label" value="{{ old('label') }}"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                    placeholder="Label">
                <span class="ml-4 font-bold error" id="labelmsg" style="color:Red;display:none">Label must be filled
                    out!</span>
                <span class="ml-4 font-bold error" id="labelmsg1" style="color:Red;display:none">Label must be in
                    characters!</span>
                <div id="errors"></div>

            </div>


            <div class="flex flex-col md:w-1/2 mt-2">
                <button class="bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                    type="submit">Add</button><br>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var token = document.forms["myForm"]["_token"].value;
            var label = document.forms["myForm"]["label"].value;
            if (label == "") {
                document.getElementById("labelmsg").style.display = ""
                return false;
            }

            var label = document.forms["myForm"]["label"].value;
            if (!isNaN(label)) {
                document.getElementById("labelmsg1").style.display = ""
                return false;
            }

            $.ajax({
                type: 'POST',
                url: 'add-tags',
                data: {
                    label: label,
                    _token: token
                },
                success: function(response) {
                    document.getElementById("success").style.display = ""
                    $("#addForm").trigger("reset");
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
