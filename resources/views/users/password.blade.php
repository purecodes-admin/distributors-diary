@extends(auth()->user()->set_as ? 'layout/admin-master' : 'layout/master')

@section('address', 'Add Distributor')
@section('content')

    <h3 class="p-5 font-semibold text-lg underline text-blue-700  hover:text-blue-900" style="width: 88%; margin:auto;">
        <span class="fas fa-user"></span>
        <a>Change Password</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Your Password is Updated Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Your Password is Not Updated...!!!
        </span>
    </h3>
    <div id="errors"></div>

    <div style="width: 88%; margin:auto;">
        <form method="post" name="myForm" id="addForm">
            @csrf
            <input type="hidden" name="id" value="">
            <div class="flex flex-col md:w-1/2">
                <label for="old_password" class="leading-10 pl-2 ml-4">Old Password:</label>
                <input type="password" value="{{ old('password') }}" name="old_password"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Old Password">
                <span class="ml-4 error font-bold" id="old_passwordmsg" style="color:Red;display:none">Old Password must be
                    filled
                    out!</span>
                <span class="ml-4 error font-bold" id="old_passwordmsg1" style="color:Red;display:none">The password must be
                    at
                    least 8 characters.</span>

            </div>
            <div class="flex flex-col md:w-1/2">
                <label for="password" class="leading-10 pl-2 ml-4">New Password:</label>
                <input type="password" value="{{ old('password') }}" name="password"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="New Password">
                <span class="ml-4 error font-bold" id="passwordmsg" style="color:Red;display:none">Password must be filled
                    out!</span>
                <span class="ml-4 error font-bold" id="passwordmsg1" style="color:Red;display:none">The password must be at
                    least 8 characters.</span>

            </div>

            <div class="flex flex-col md:w-1/2">
                <label for="c_password" class="leading-10 pl-2 ml-4">Confirm New Password:</label>
                <input type="password" value="{{ old('password') }}" name="c_password"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Confirm New Password">
                <span class="ml-4 error font-bold" id="c_passwordmsg" style="color:Red;display:none">Password must be filled
                    out!</span>
                <span class="ml-4 error font-bold" id="c_passwordmsg1" style="color:Red;display:none">The password
                    confirmation
                    does not match!</span>

            </div>

            <div class="flex flex-col md:w-1/2 mt-2">
                <button class="disabled:opacity-50 bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                    type="button" onclick="validateForm(this)">Set Password</button><br>
            </div>
        </form>
    </div>

    <script>
        function validateForm(e) {

            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            // Code For Remove validation messages after field validate...
            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var token = document.forms["myForm"]["_token"].value;

            var old_password = document.forms["myForm"]["old_password"].value;
            if (old_password == "") {
                document.getElementById("old_passwordmsg").style.display = ""
                return false;
            }
            if (old_password.length < 8) {
                document.getElementById("old_passwordmsg1").style.display = ""
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


            $(e).prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: 'set',
                data: {
                    old_password: old_password,
                    password: password,
                    _token: token
                },
                success: function(response) {
                    document.getElementById("success").style.display = ""
                    $("#addForm").trigger("reset");
                },
                error: function(res) {
                    console.log(res);
                    let errors = res.responseJSON.message;
                    console.log(errors);

                    let html = '<div style="color: red;">';
                    html += '<p>' + errors + '</p>';
                    html += '</div>';

                    document.getElementById('errors').innerHTML = html;
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
