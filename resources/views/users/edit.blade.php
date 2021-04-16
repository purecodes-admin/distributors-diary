@extends(auth()->user()->set_as ? 'layout/admin-master' : 'layout/master')

@section('address', 'Update Records')
@section('content')
    <h3 class="p-5 font-semibold text-lg underline text-blue-700 hover:text-blue-900" style="width: 88%; margin:auto;">
        <span class="fas fa-user"></span>
        <a>Update Profile</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Profile Updated Successfully...!!!
        </span>
        <span id="danger" style="color:red; display:none;">
            Profile Not Updated Successfully...!!!
        </span>
    </h3>
    <div style="width: 88%; margin:auto;">
        <form action="" method="POST" name="myForm" id="addForm">
            @csrf
            {{-- <input type="hidden" name="id" value="{{ $user->id }}"> --}}
            <div class="flex flex-col md:w-1/2">
                <img src="{{ asset('images/' . Auth::user()->image) }}" alt="Profile Picture" height="130px" width="130px"
                    class=" rounded-xl">
            </div>
            <div class="flex flex-col md:w-1/2">
                <label for="name" class="leading-10 pl-2">Name:</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                    placeholder="Name">
                <span class="ml-4 error font-bold" id="namemsg" style="color:Red;display:none">Name must be filled
                    out!</span>

            </div>


            <div class="flex flex-col md:w-1/2">
                <label for="email" class="leading-10 pl-2">Email:</label>
                <input type="email" value="{{ old('email', Auth::user()->email) }}" name="email"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Email">
                <span class="ml-4 error font-bold" id="emailmsg" style="color:Red;display:none">Email must be filled
                    out!</span>


            </div>

            <div class="flex flex-col md:w-1/2">
                <label for="contact" class="leading-10 pl-2">Contact No:</label>
                <input type="text" value="{{ old('contact', Auth::user()->contact) }}" name="contact"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Contact">
                <span class="ml-8 error font-bold" id="contactmsg" style="color:Red;display:none">Contact must be filled
                    out!</span>
                <span class="ml-8 error font-bold" id="contactmsg1" style="color:Red;display:none">Contact must be smaller
                    than 11
                    digits!</span>

            </div>

            <div class="flex flex-col md:w-1/2 mt-2">
                <button class="disabled:opacity-50 bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                    type="submit" onclick="UpdateForm(this)">Update</button><br>
            </div>

        </form>
    </div>

    <script>
        function UpdateForm(e) {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            // Code For Remove validation messages after field validate...
            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var token = document.forms["myForm"]["_token"].value;
            var id = document.forms["myForm"]["id"].value;

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
            var contact = document.forms["myForm"]["contact"].value;
            if (contact == "") {
                document.getElementById("contactmsg").style.display = ""
                return false;
            }
            var contact = document.forms["myForm"]["contact"].value;
            if (contact.length > 11) {
                document.getElementById("contactmsg1").style.display = ""
                return false;
            }

            $(e).prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: '/users/UpdateProfile',
                data: {
                    name: name,
                    email: email,
                    contact: contact,
                    _token: token,
                    id: id
                },
                success: function(response) {
                    document.getElementById("success").style.display = ""
                    return false;
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
