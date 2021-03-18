@extends('layout/master')
@section('address', 'Add Tags')
@section('content')
    <h3 class="p-5 font-semibold text-lg underline text-blue-700     hover:text-blue-900">
        <span class="fas fa-user"></span>
        <a>Create Custom Tags</a>
        <span class="ml-60 font-bold" id="success" style="color:rgb(71, 134, 71); display:none;">
            Tag Created Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Tag Creation Failed...!!!
        </span>
    </h3>
    <form method="POST" name="myForm" id="addForm" onsubmit=" return validateForm()">
        @csrf
        <div class="flex flex-col w-1/2">
            <label for="label" class="leading-10 pl-2">Label:</label>
            <input type="text" name="label" value="{{ old('label') }}"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                placeholder="Label">
            <span class="ml-4 font-bold error" id="labelmsg" style="color:Red;display:none">Label must be filled
                out!</span>
            <span class="ml-4 font-bold error" id="labelmsg1" style="color:Red;display:none">Label must be in
                characters!</span>

        </div>


        <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                type="submit">Add</button><br>
        </div>
    </form>

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
                url: 'add-custom-tags',
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
                    document.getElementById("danger").style.display = ""
                }
            });

            return false;

        }

    </script>
@endsection
