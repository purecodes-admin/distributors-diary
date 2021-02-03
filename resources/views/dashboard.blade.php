@extends('layout/master')
@section('title', 'Records List')
@section('content')
    <marquee behavior="alternate" direction="right"
        class="bg-green-500 text-3xl font-bold text-blue-50 rounded-2xl hover:text-white hover:bg-green-900">Welcome
        To The
        Distributors
        Dashboard...!!!
    </marquee>
    <marquee behavior="alternate" direction="left"
        class="bg-blue-500 text-3xl font-bold text-blue-50 border-collapse rounded-2xl hover:text-red-500 hover:bg-purple-500">
        {{-- {{ Auth::user()->name }} --}}
    </marquee>


@endsection
