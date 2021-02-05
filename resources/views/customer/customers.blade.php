@extends('layout/master')
@section('title', 'Records List')
@section('content')

    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
    <div class="mb-3 flex justify-end">
        <a href="/customer/add">

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-4">Add Record</button>

        </a>

    </div>
    <div class="inline-block">
        <h1 class="text-4xl text-green-500 font-bold m-4 inline-block">Customers List</h1>

        <a href="/customer/supplier">
            <button class="bg-yellow-500 px-4 py-2 rounded text-white hover:bg-green-500 font-bold">Suppliers</button>
        </a>
        <a href="/customer/purchaser">
            <button
                class="bg-pink-500 px-4 py-2 rounded text-white hover:bg-green-500 font-bold overflow-hidden">Purchasers</button>
        </a>
    </div>
    <div class="flex justify-end">
        <form action="/customer/search" method="get">
            <input type="search" placeholder="Search.." name="search"
                class="rounded hover:border-blue-600 border-green-500">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
        Customer Record Deleted Successfully...!!!
    </span>
    <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
        Customer Record Not Deleted...!!!
    </span>

    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    ID</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Name</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Address</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Contact</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Email</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Discription</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Category</th>
            </tr>
        </thead>
        @foreach ($data as $record)
            <tbody>
                <tr id="demo">
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->id }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->address }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->contact }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->email }}</td>
                    <td style="overflow-wrap:anywhere;" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $record->discription }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->category }}</td>
                    <td>
                        <a href={{ '/customer/edit/' . $record['id'] }} class="ml-10">
                            <button class="bg-green-500  hover:bg-green-700 text-white font-bold px-2 rounded">Edit</button>
                        </a>
                    </td>
                    <td>
                        <a href="" class="ml-10">
                            <button class="bg-red-500  hover:bg-red-700 text-white font-bold px-2 rounded"
                                onclick="deleteCustomer({{ $record->id }})">Delete</button>
                        </a>
                    </td>
                </tr>
            </tbody>

        @endforeach
    </table>

    <script>
        function deleteCustomer(id) {
            var token = document.getElementById('csrf-token').value;

            if (confirm("Do you Really Want to Delete This Customer?")) {
                $.ajax({
                    type: 'get',
                    url: '/customer/delete/' + id,
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        document.getElementById("success").style.display = ""
                        $('#demo_' + id).remove();
                        // var col = document.getElementById("demo-" + id);
                        //    col.remove();
                        //    console.log(response);


                    },
                    error: function(res) {
                        document.getElementById("danger").style.display = ""
                    }
                });

            }

        }

    </script>
@endsection
