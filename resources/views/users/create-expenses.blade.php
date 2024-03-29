@extends('layout/master')
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
                <a href="../users/expenses" class="hover:underline">Expenses</a>
            </li>
            <li class="text-blue-700 hover:text-blue-900">
                <a href="">Create Expenses</a>
            </li>
        </ul>
    </div>


    <h3 class="p-5 font-semibold text-lg underline text-blue-700 hover:text-blue-900" style="width: 88%; margin:auto;">
        <span class="fas fa-user"></span>
        <a>Create Your Expenses</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Expense Created Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Expense Creation Failed...!!!
        </span>
    </h3>
    <div style="width: 88%; margin:auto;">
        <form name="myForm" id="addForm">
            @csrf
            <div class="flex flex-col md:w1/2">
                <label for="expense_amount" class="leading-10 pl-2">Expense Amount:</label>
                <input type="text" name="expense_amount" value="{{ old('expense_amount') }}"
                    class="md:w-1/2 ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                    placeholder="Expense Amount">
                <span class="ml-4 font-bold error" id="expense_amountmsg" style="color:Red;display:none">Expense Amount must
                    be
                    filled
                    out!</span>
                <span class="ml-4 font-bold error" id="expense_amountmsg1" style="color:Red;display:none">Expense Amount
                    must be
                    in
                    digits!</span>

            </div>


            <div class="flex flex-col md:w-1/2">
                <label for="tags" class="leading-10 pl-2">Select Tags:</label>
                <select name="tags" id="tags"
                    class="multiple-tags ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    multiple>
                    <option value="">Select Item Name</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->label }}</option>
                    @endforeach
                </select>
                <span class="ml-4 error font-bold" id="tagsmsg" style="color:Red;display:none">Tag must be
                    Selected!</span>

            </div>


            <div class="flex flex-col md:w-1/2 mt-2">
                <button class="disabled:opacity-50 bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                    type="button" onclick="return validateForm(this)">Add</button><br>
            </div>
        </form>
    </div>

    <script>
        function validateForm(e) {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var token = document.forms["myForm"]["_token"].value;
            var expense_amount = document.forms["myForm"]["expense_amount"].value;
            if (expense_amount == "") {
                document.getElementById("expense_amountmsg").style.display = ""
                return false;
            }

            var expense_amount = document.forms["myForm"]["expense_amount"].value;
            if (isNaN(expense_amount)) {
                document.getElementById("expense_amountmsg1").style.display = ""
                return false;
            }

            // var tags = document.forms["myForm"]["tags"].value;
            var tags = $('.multiple-tags').val();
            console.log(tags);
            if (tags == "") {
                document.getElementById("tagsmsg").style.display = ""
                return false;
            }

            $(e).prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: 'add-expense',
                data: {
                    expense_amount: expense_amount,
                    tags: tags,
                    _token: token
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


        $(document).ready(function() {
            $('.multiple-tags').select2({

                placeholder: "Select Tags",
                tags: true,
                tokenSeprators: ['/', ',', ',', ""]
            });
        })

    </script>
@endsection
