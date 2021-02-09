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
        {{ Auth::user()->name }}
    </marquee>
    <div class="mb-3 flex justify-end">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
        <a href="">

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-4">Add Record</button>

        </a>

    </div>
    <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
        Stock Record Deleted Successfully...!!!
    </span>
    <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
        Stock Record Not Deleted...!!!
    </span>
    <h1 class="text-4xl text-blue-500 font-bold m-4">Items In Stock</h1>

    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">
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
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-red-700">{{ $stock->id }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $stock->item->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $stock->quantity }}</td>
                    {{-- <td>
                    <a href="" class="ml-3">
                        <button class="bg-green-500  hover:bg-green-700 text-white font-bold px-2 rounded">Edit</button>
                    </a>
                </td>
                <td>
                    <a href="" class="ml-3">
                        <button class="bg-red-500  hover:bg-red-700 text-white font-bold px-2 rounded"
                            onclick="">Delete</button>
                    </a>
                </td> --}}
                </tr>
            </tbody>
        @endforeach
    </table>


@endsection
