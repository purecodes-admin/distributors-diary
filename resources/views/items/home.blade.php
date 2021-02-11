@extends('layout/master')
@section('title', 'Records List')
@section('content')
    {{-- <marquee behavior="alternate" direction="right" class="bg-blue-800 text-3xl font-bold rounded-2xl text-white">Welcome
        To The
        Distributors
        Dashboard...!!!
    </marquee>
    <marquee behavior="alternate" direction="left"
        class="bg-blue-800 text-3xl font-bold text-white border-collapse rounded-2xl ">
        {{ Auth::user()->name }}
    </marquee> --}}
    <div class="mb-3 flex justify-end">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

    </div>
    <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
        Stock Record Deleted Successfully...!!!
    </span>
    <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
        Stock Record Not Deleted...!!!
    </span>
    <h1 class="text-4xl text-gray-700 font-bold m-4">Items In Stock</h1>

    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    ID</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Item Name</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Remaining Quantity</th>
            </tr>
        </thead>
        @foreach ($data as $stock)
            <tbody>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $stock->id }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $stock->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $stock->stock }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href={{ '/items/timeline/' . $stock['id'] }} class="ml-3">
                            <button class="bg-green-700 text-white font-bold px-2 rounded">TimeLine</button>
                        </a>
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
    <span>
        {{ $data->links() }}
    </span>

@endsection
