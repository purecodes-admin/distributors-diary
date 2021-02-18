@extends('layout/admin-master')
@section('address', 'Add Distributor')
@section('content')
    <h3 class="p-5 font-semibold text-lg underline text-green-700     hover:text-green-900">
        <span class="fas fa-user"></span>
        <a>Admin Login</a>
    </h3>
    @if ($errors->any())
        <div class="text-red-700 ml-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="login" method="POST" name="myForm" id="addForm">
        @csrf
        <div class="flex flex-col w-1/2">
            <label for="email" class="leading-10 pl-2">Email:</label>
            <input type="email" value="{{ old('email') }}" name="email"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Email" required>
        </div>

        <div class="flex flex-col w-1/2">
            <label for="password" class="leading-10 pl-2 ml-4">Password:</label>
            <input type="password" value="{{ old('password') }}" name="password"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Password" required>

        </div>


        <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-green-700 hover:bg-green-900 font-bold text-white ml-2 py-2 rounded"
                type="submit">Login</button><br>
        </div>
    </form>
@endsection
