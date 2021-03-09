@extends('layout/admin-master')
@section('address', 'Add Distributor')
@section('content')
    <h3 class="p-5 font-semibold text-lg underline text-blue-700     hover:text-blue-900">
        <span class="fas fa-user"></span>
        <a>Add Distributor</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Distributor Added Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Distributor Submittion Failed...!!!
        </span>
    </h3>
    <div id="errors"></div>
    {{-- <span id="email" style="color:red; display:none;"> --}}
    {{-- The email has already been taken.!!! --}}
    {{-- </span> --}}
    <form action="add" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex">
            <div class="flex flex-col w-1/2">
                <label for="name" class="leading-10 pl-2 ml-2">Name:</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                    placeholder="Name" required>
            </div>


            <div class="flex flex-col w-1/2">
                <label for="email" class="leading-10 pl-2 ml-4">Email:</label>
                <input type="email" value="{{ old('email') }}" name="email"
                    class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Email" required>
                @error('email')
                    <span class="text-red-600 ml-4 font-bold text-sm">** {{ $message }}</span>
                @enderror
            </div>
        </div>


        <div class="flex">
            <div class="flex flex-col w-1/2">
                <label for="password" class="leading-10 pl-2 ml-2">Password:</label>
                <input type="password" value="{{ old('password') }}" name="password"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Password" required>
                @error('password')
                    <span class="text-red-600 ml-4 font-bold text-sm">** {{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col w-1/2">
                <label for="password_confirmation" class="leading-10 pl-2 ml-4">Confirm Password:</label>
                <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation"
                    class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Confirm Password" required>
                @error('password')
                    <span class="text-red-600 ml-4 font-bold text-sm">** {{ $message }}</span>
                @enderror
            </div>
        </div>


        <div class="flex">
            <div class="flex flex-col w-1/2">
                <label for="contact" class="leading-10 pl-2 ml-2">Contact No:</label>
                <input type="text" value="{{ old('contact') }}" name="contact"
                    class="ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Contact" required>
                @error('contact')
                    <span class="text-red-600 ml-4 font-bold text-sm">** {{ $message }}</span>
                @enderror

            </div>



            <div class="flex flex-col w-1/2">
                <label for="image" class="leading-10 pl-2 ml-4">Image:</label>
                <input type="file" name="image"
                    class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    required>

            </div>
        </div>


        <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                type="submit">Add</button><br>
        </div>
    </form>

    {{-- <script>
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
            // if (password.length < 8) {
            //     document.getElementById("passwordmsg1").style.display = ""
            //     return false;
            // }
            var password_confirmation = document.forms["myForm"]["password_confirmation"].value;
            if (password_confirmation == "") {
                document.getElementById("password_confirmationmsg").style.display = ""
                return false;
            }
            if (password != password_confirmation) {
                document.getElementById("password_confirmationmsg1").style.display = ""
                return false;
            }
            var image = document.forms["myForm"]["image"].value;
            if (image == "") {
                document.getElementById("imagemsg").style.display = ""
                return false;
            }

            document.getElementById('errors').innerHTML = 'loading...';

            $.ajax({
                type: 'POST',
                url: 'add',
                data: {
                    name: name,
                    email: email,
                    password: password,
                    image: image,
                    _token: token
                },
                success: function(response) {
                    document.getElementById("success").style.display = ""
                    $("#addForm").trigger("reset");
                },
                error: function(res) {
                    console.log(res);
                    let errors = res.responseJSON.errors;

                    console.log(errors);
                    let html = '<div style="color: red;">';
                    for (error in errors) {
                        for (err in errors[error]) {
                            html += '<p>' + errors[error][err] + '</p>';
                        }
                    }
                    html += '</div>';

                    document.getElementById('errors').innerHTML = html;
                    document.getElementById("danger").style.display = ""
                }
            });

            return false;

        }

    </script> --}}
@endsection
