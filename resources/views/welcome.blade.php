@extends('layout/master2')
@section('title', 'Records List')
@section('content')

    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
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
        <h1 class="text-xl text-yellow-500">
            Welcome To Direct Shot
            (A Distributing Company).....!!!
        </h1>
    </div>


@endsection
