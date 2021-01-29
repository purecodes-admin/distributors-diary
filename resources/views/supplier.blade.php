@extends('layout/master')
@section('title', 'Records List')
@section('content')

    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
    <div class="mb-3 flex justify-end">
        <a href="add">

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-4">Add Record</button>

        </a>

    </div>
    <h1 class="text-4xl text-green-500 font-bold m-4">Suppliers List</h1>

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
                        {{ $record->discription }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->category }}</td>
                    <td>
                        <a href={{ 'edit/' . $record['id'] }} class="ml-10">
                            <button class="bg-green-500  hover:bg-green-700 text-white font-bold px-2 rounded">Edit</button>
                        </a>
                    </td>
                    <td>
                        <a href="" class="ml-10">
                            <button class="bg-red-500  hover:bg-red-700 text-white font-bold px-2 rounded"
                                onclick="deleteSupplier({{ $record->id }})">Delete</button>
                        </a>
                    </td>
                </tr>
            </tbody>

        @endforeach
    </table>

    <script>
        function deleteSupplier(id) {
            var token = document.getElementById('csrf-token').value;

            if (confirm("Do you Really Want to Delete This Supplier?")) {
                $.ajax({
                    type: 'get',
                    url: '/delete/' + id,
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        alert('success here');
                        $('#demo_' + id).remove();
                        // var col = document.getElementById("demo-" + id);
                        //    col.remove();
                        //    console.log(response);


                    },
                    error: function(res) {
                        alert('Error here');
                    }
                });

            }

        }

    </script>
@endsection
