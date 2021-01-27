@extends('layout/master')
@section('address','Update Records')
@section('content')
      <h3 class="p-5 font-semibold text-lg underline text-green-500 hover:text-green-700">
        <span class="fas fa-user"></span>
        <a>Update Records</a>
      </h3>
            <form action="/update" method="POST" name="myForm"
              onsubmit="return updateForm()"    id="updateForm">
            @csrf
            <input type="hidden" name="id" value="{{$supplier->id}}">
          <div class="flex">
            <div class="flex flex-col w-1/2">
              <label for="name" class="leading-10 pl-2">Name:</label>
              <input type="text" name="name" value="{{old('name', $supplier->name)}}" class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 " placeholder="Name">
              <span class="ml-4" id="namemsg" style="color:Red;display:none">Name must be filled out!</span>
              
            </div>

            <div class="flex flex-col w-1/2">
              <label for="address" class="leading-10 pl-2 ml-4">Address:</label>
              <input type="text" value="{{old('address', $supplier->address)}}" name="address" class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Address">
              <span class="ml-8" id="addressmsg" style="color:Red;display:none">Address must be filled out!</span>
              
            </div>
          </div>

          <div class="flex">

            <div class="flex flex-col w-1/2">
              <label for="email" class="leading-10 pl-2">Email:</label>
              <input type="email" value="{{old('email', $supplier->email)}}" name="email" class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Email">
              <span class="ml-4" id="emailmsg" style="color:Red;display:none">Email must be filled out!</span>
              
            </div>

            <div class="flex flex-col w-1/2">
              <label for="contact" class="leading-10 pl-2 ml-4">Contact No:</label>
              <input type="text" value="{{old('contact', $supplier->contact)}}" name="contact" class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Contact">
                    <span class="ml-8" id="contactmsg" style="color:Red;display:none">Contact must be filled out!</span>
                    <span class="ml-8" id="contactmsg1" style="color:Red;display:none">Contact must be smaller than 11 digits!</span>
              
            </div>
          </div>
          
          <div class="flex">
            <div class="flex flex-col w-1/2">
              <label for="discription" class="leading-10 pl-2">Discription:</label>
              <textarea  name="discription" class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 " placeholder="Discription" rows="3" >{{old('discription', $supplier->discription)}}</textarea>
                  <span class="ml-4" id="discriptionmsg" style="color:Red;display:none">Discription must be filled out!</span>
                  <span class="ml-4" id="discriptionmsg1" style="color:Red;display:none">Discription must be Greater than 30!</span>
              
            </div>

            <div class="flex flex-col w-1/2">
              <label for="discription" class="leading-10 pl-2 ml-4">Catogery:</label>
              <select name="category" id="category"  class=" px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 ml-4">
                 <option value="">Select Category</option>
                 <option value="supplier" @if($supplier->category=='supplier')selected='selected' @endif > Supplier</option>
                 <option value="purchaser" @if($supplier->category=='purchaser')selected='selected' @endif>Purchaser</option>
              </select>
              <span class="ml-8" id="categorymsg" style="color:Red;display:none">Category must be Selected!</span>
              
            </div> 
            </div>

            <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-green-500 hover:bg-green-700 font-bold text-white ml-2 py-2 rounded" type="submit">Update</button><br>
            </div>

            </form>

           <script>
            function updateForm() 
              {

                var token = document.forms["myForm"]["_token"].value;
                var name = document.forms["myForm"]["name"].value;
                if (name == "") {
                  document.getElementById("namemsg").style.display=""
                  return false;
                }

                var address = document.forms["myForm"]["address"].value;
                if (address == "") {
                  document.getElementById("addressmsg").style.display=""
                  return false;
                }
                var email = document.forms["myForm"]["email"].value;
                if (email == "") {
                  document.getElementById("emailmsg").style.display=""
                  return false;
                }
                var contact = document.forms["myForm"]["contact"].value;
                if (contact == "") {
                  document.getElementById("contactmsg").style.display=""
                  return false;
                }
                var contact = document.forms["myForm"]["contact"].value;
                if (contact.length > 11) {
                  document.getElementById("contactmsg1").style.display=""
                  return false;
                }
                var discription = document.forms["myForm"]["discription"].value;
                if (discription == "") {
                  document.getElementById("discriptionmsg").style.display=""
                  return false;
                }
                var discription  = document.forms["myForm"]["discription"].value;
                if (discription.length  < 30) {
                  document.getElementById("discriptionmsg1").style.display=""
                  return false;
                }
                var category = document.forms["myForm"]["category"].value;
                if (category == "") {
                  document.getElementById("categorymsg").style.display=""
                  return false;
                }

                $.ajax({
                  type: 'post',
                  url: '/update',
                  data: {name:name, address:address, email:email , contact:contact, discription:discription, category:category, _token: token}, 
                  success: function(response) {
                    alert('Data Updated Successfully...!!!');
                    $("#updateForm").trigger("reset");
                  },
                  error: function(res) {
                    alert('Data Not Updated...!!!');
                  }
                });

                return false;

              }
              </script>
@endsection