@extends('layout/master')
@section('title', 'Records List')
@section('content')


    <div class="mb-3 flex justify-end">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
        <a href="create">

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-4">Add Record</button>

        </a>

    </div>
    <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
        Stock Record Deleted Successfully...!!!
    </span>
    <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
        Stock Record Not Deleted...!!!
    </span>
    <h1 class="text-4xl text-blue-500 font-bold m-4">Inventory</h1>

    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">
                    ID</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Customer Type</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Customer Name</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Item Name</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Quantity</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Price</th>
            </tr>
        </thead>
        @foreach ($data as $record)

            <tbody>
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-red-700">{{ $record->id }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->customer->category }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->customer->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->item->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->quantity }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->price }}</td>
                    <td>
                        <a href={{ 'edit/' . $record->id }} class="ml-3">
                            <button class="bg-green-500  hover:bg-green-700 text-white font-bold px-2 rounded">Edit</button>
                        </a>
                    </td>
                    <td>
                        <a href="" class="ml-3">
                            <button class="bg-red-500  hover:bg-red-700 text-white font-bold px-2 rounded"
                                onclick="deleteStock({{ $record->id }})">Delete</button>
                        </a>
                    </td>
                </tr>
            </tbody>

        @endforeach
    </table>

    <script>
        function deleteStock(id) {
            // Token is Not Required in Delete Function
            // var token = document.getElementById('csrf-token').value; 
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            if (confirm("Do you Really Want to Delete This Stock Record?")) {
                $.ajax({
                    type: 'get',
                    url: 'delete/' + id,
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
@endsection
