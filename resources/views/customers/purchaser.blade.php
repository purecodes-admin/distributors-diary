@extends('layout/master')
@section('title', 'Records List')
@section('content')

    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
    <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
        Purchaser Record Deleted Successfully...!!!
    </span>
    <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
        Purchaser Record Not Deleted...!!!
    </span>
    <h1 class="text-4xl text-gray-700 font-bold m-4">Purchasers List</h1>

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
                <!-- <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider col-span-2">Operations</th> -->
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
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href={{ 'edit/' . $record['id'] }} class="ml-10">
                            <button class="bg-green-700  hover:bg-green-900 text-white font-bold px-3 py-2 rounded"><i
                                    class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="" class="ml-10">
                            <button class="bg-red-500  hover:bg-red-700 text-white font-bold px-3 py-2 rounded"
                                onclick="deletePurchaser({{ $record->id }})"><i class="fas fa-trash-alt"></i></button>
                        </a>
                    </td>
                </tr>
            </tbody>

        @endforeach
    </table>

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
