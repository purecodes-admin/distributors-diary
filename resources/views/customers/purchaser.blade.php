@extends('layout/master')
@section('title', 'Records List')
@section('content')

    {{-- code for breadcrumbs --}}
    <style>
        ul.breadcrumbs li+li :before {
            padding: 8px;
            color: black;
            content: "/\00a0";
        }

    </style>
    <div style="width: 88%; margin:auto;">
        <ul class="flex p-3 bg-gray-200 breadcrumbs">
            <li class="mr-2 text-gray-700 hover:text-gray-900">
                <a href="../customers" class="hover:underline">Customers</a>
            </li>
            <li class="text-blue-700 hover:text-blue-900">
                <a href="">Purchasers</a>
            </li>
        </ul>
    </div>

    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
    <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
        Purchaser Record Deleted Successfully...!!!
    </span>
    <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
        Purchaser Record Not Deleted...!!!
    </span>
    <br>
    <h1 class="text-4xl text-gray-700 font-bold m-4" style="width: 88%; margin:auto;">Purchasers List</h1>

    <div style="width: 88%; margin:auto;">
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
                        class="hidden md:table-cell px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Address</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Contact</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell">
                        Email</th>
                    <th
                        class="hidden md:table-cell px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Discription</th>
                    <th
                        class="hidden md:table-cell px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Category</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                        colspan="2">
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $record)
                    <tr id="demo">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->id }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden md:table-cell">
                            {{ $record->address }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->contact }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden md:table-cell">
                            {{ $record->email }}</td>
                        <td style="overflow-wrap:anywhere;"
                            class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden md:table-cell">
                            {{ $record->discription }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden md:table-cell">
                            {{ $record->category }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex">
                                <a href={{ 'edit/' . $record['id'] }} class="ml-10">
                                    <button class="bg-green-700  hover:bg-green-900 text-white font-bold px-1 rounded"><i
                                            class="fas fa-edit"></i></button>
                                </a>
                                <a href="" class="ml-10">
                                    <button class="  bg-red-500  hover:bg-red-700 text-white font-bold px-1 rounded"
                                        onclick="deletePurchaser({{ $record->id }})"><i
                                            class="fas fa-trash-alt"></i></button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>


        </table>
    </div>

    <script>
        function deletePurchaser(id) {
            var token = document.getElementById('csrf-token').value;

            if (confirm("Do you Really Want to Delete This Purchaser?")) {
                $.ajax({
                    type: 'get',
                    url: 'delete/' + id,
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        document.getElementById("success").style.display = ""
                        // $('#demo_'+ id).remove();
                        var col = document.getElementById("demo-" + id);
                        col.remove();
                        console.log(response);


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
@endsection
