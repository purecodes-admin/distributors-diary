@extends('layout/master2')
@section('title', 'Records List')
@section('content')

    @if (Route::has('login'))
        <div class="fixed top-0 right-0 px-6 py-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="flex justify-center">
        <h1 class="text-xl text-gray-700">
            Welcome To PureCodes
            (A Distributing Company).....!!!
        </h1>
    </div>


@endsection
