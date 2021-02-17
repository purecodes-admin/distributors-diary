@extends('layout/master')
@section('address', 'Add Distributor')
@section('content')
    <h3 class="p-5 font-semibold text-lg underline text-green-700     hover:text-green-900">
        <span class="fas fa-user"></span>
        <a>Add Distributor</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Distributor Added Successfully...!!!
        </span>
        <span id="danger" style="color:red; display:none;">
            Distributor Submittion Failed...!!!
        </span>
    </h3>
    <form action="" method="POST" name="myForm" id="addForm">
        @csrf
        <div class="flex flex-col w-1/2">
            <label for="name" class="leading-10 pl-2">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                placeholder="Name">
            <span class="ml-4 error font-bold" id="namemsg" style="color:Red;display:none">Name must be filled
                out!</span>

        </div>
        <div class="flex flex-col w-1/2">
            <label for="email" class="leading-10 pl-2">Email:</label>
            <input type="email" value="{{ old('email') }}" name="email"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Email">
            <span class="ml-4 error font-bold" id="emailmsg" style="color:Red;display:none">Email must be filled!
                out!</span>
            <span class="ml-4 error font-bold" id="emailmsg2" style="color:Red;display:none">

            </span>
        </div>
        <div class="flex flex-col w-1/2">
            <label for="password" class="leading-10 pl-2 ml-4">Password:</label>
            <input type="password" value="{{ old('password') }}" name="password"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Password">
            <span class="ml-4 error font-bold" id="passwordmsg" style="color:Red;display:none">Password must be filled
                out!</span>
            <span class="ml-4 error font-bold" id="passwordmsg1" style="color:Red;display:none">The password must be at
                least 8 characters.</span>

        </div>

        <div class="flex flex-col w-1/2">
            <label for="c_password" class="leading-10 pl-2 ml-4">Confirm Password:</label>
            <input type="password" value="{{ old('c_password') }}" name="c_password"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Confirm Password">
            <span class="ml-4 error font-bold" id="c_passwordmsg" style="color:Red;display:none">Password must be filled
                out!</span>
            <span class="ml-4 error font-bold" id="c_passwordmsg1" style="color:Red;display:none">The password confirmation
                does not match!</span>

        </div>



        <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-green-700 hover:bg-green-900 font-bold text-white ml-2 py-2 rounded" type="button"
                onclick="validateForm()">Add</button><br>
        </div>
    </form>

    <script>
        function validateForm() {

            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            // Code For Remove validation messages after field validate...
            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var token = document.forms["myForm"]["_token"].value;
            var name = document.forms["myForm"]["name"].value;
            if (name == "") {
                document.getElementById("namemsg").style.display = ""
                return false;
            }
            var email = document.forms["myForm"]["email"].value;
            if (email == "") {
                document.getElementById("emailmsg").style.display = ""
                return false;
            }
            var password = document.forms["myForm"]["password"].value;
            if (password == "") {
                document.getElementById("passwordmsg").style.display = ""
                return false;
            }
            if (password.length < 8) {
                document.getElementById("passwordmsg1").style.display = ""
                return false;
            }
            var c_password = document.forms["myForm"]["c_password"].value;
            if (c_password == "") {
                document.getElementById("c_passwordmsg").style.display = ""
                return false;
            }
            if (password != c_password) {
                document.getElementById("c_passwordmsg1").style.display = ""
                return false;
            }


            $.ajax({
                type: 'POST',
                url: 'add',
                data: {
                    name: name,
                    email: email,
                    password: password,
                    _token: token
                },
                success: function(response) {
                    document.getElementById("success").style.display = ""
                    $("#addForm").trigger("reset");
                },
                error: function(res) {
                    console.log(res)
                    var errors = res;
                    console.log(res.responseJSON.message);
                    console.log(res.responseJSON.email);

                    document.getElementById("danger").style.display = ""
                }
            });

            return false;

        }

    </script>
@endsection
