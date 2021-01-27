@extends('layout/master')
@section('address','Update Records')
@section('content')
      <h3 class="p-5 font-semibold text-lg underline text-green-500 hover:text-green-700">
        <span class="fas fa-user"></span>
        <a>Update Records</a>
      </h3>
            <form action="/updateitem" method="POST" name="myForm"
              onsubmit="return validateForm()"    id="updateForm">
            @csrf
            <input type="hidden" name="id" value="{{$item->id}}">
            <div class="flex flex-col w-1/2">
              <label for="name" class="leading-10 pl-2">Name:</label>
              <input type="text" name="name" value="{{old('name', $item->name)}}" class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 " required>
              
            </div>

            <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-green-500 hover:bg-green-700 font-bold text-white ml-2 py-2 rounded" type="submit">Update</button><br>
            </div>
            </form>
@endsection