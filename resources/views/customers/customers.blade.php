@extends('layout/master')
@section('title', 'Records List')
@section('content')
    <div class="bg-white rounded-xl mt-4 px-1">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <h1 class="text-4xl text-gray-700 font-bold pt-2 mt-4 ml-2">
            <span class="fa fa-users"></span> Customers List
        </h1>

        <div class="md:flex justify-between mt-8">
            <div class="flex justify-start">
                <a href="/customers/suppliers">
                    <button
                        class="hidden md:block ml-6 bg-blue-700 px-2 py-1 rounded text-white font-bold mr-2">Suppliers</button>
                </a>
                <a href="/customers/purchasers">
                    <button
                        class="hidden md:block bg-blue-700 px-2 py-1 rounded text-white font-bold overflow-hidden">Purchasers</button>
                </a>
            </div>
            <div class="flex justify-end">

                <a href="/customers/add">

                    <button class="mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New <i
                            class="fas fa-plus"></i></button>
                </a>

                <form action="customers">
                    <input type="search" placeholder="Search.." name="search" value="{{ request('search') }}"
                        class="rounded border-none bg-gray-100">
                    {{-- <button type="submit"><i class="fa fa-search"></i></button> --}}
                </form>
            </div>
        </div>

        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Customer Record Deleted Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Customer Record Not Deleted...!!!
        </span>
        <div>
            <table class="table-fixed w-full ">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Name</th>
                        <th
                            class=" hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Address</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Contact</th>
                        <th
                            class=" hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Discription</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Category</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $record)
                        <tr id="demo">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->name }}</td>
                            <td class=" hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $record->address }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->contact }}</td>
                            <td style="overflow-wrap:anywhere;"
                                class=" hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $record->email }}</td>
                            <td style="overflow-wrap:anywhere;"
                                class=" hidden md:table-cell  px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $record->discription }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->category }}</td>

                            <td class="pl-2 pr-10 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href={{ '/customers/edit/' . $record['id'] }}>
                                    <button class="bg-green-700  hover:bg-green-900 text-white font-bold px-1 rounded"><i
                                            class="fas fa-edit"></i></button>
                                </a> &nbsp;
                                <a href="">
                                    <button class="  bg-red-500  hover:bg-red-700 text-white font-bold px-1 rounded"
                                        onclick="deleteCustomer({{ $record->id }})"><i class="fas fa-trash-alt"></i></button>
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <script>
            function deleteCustomer(id) {
                var token = document.getElementById('csrf-token').value;

                if (confirm("Do you Really Want to Delete This Customer?")) {
                    $.ajax({
                        type: 'get',
                        url: '/customers/delete/' + id,
                        data: {
                            _token: token
                        },
                        success: function(response) {
                            document.getElementById("success").style.display = ""
                            $('#demo_' + id).remove();
                        },
                        error: function(res) {
                            document.getElementById("danger").style.display = ""
                        }
                    });

                }

            }

        </script>
        <span>
            {{ $data->links() }}
        </span>

    </div>
@endsection
