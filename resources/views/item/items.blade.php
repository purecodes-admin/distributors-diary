@extends('layout/master')
@section('title', 'Records List')
@section('content')


    <div class="mb-3 flex justify-end">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
        <a href="/item/add">

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-4">Add New Item</button>
        </a>

    </div>
    <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
        Item Deleted Successfully...!!!
    </span>
    <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
        Item Not Deleted...!!!
    </span>
    <h1 class="text-4xl text-blue-500 font-bold m-4">Items List</h1>

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
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider col-span-2">
                    Operations</th>
            </tr>
        </thead>
        @foreach ($data as $item)
            <tbody>
                <tr id="demo">
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $item->id }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $item->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href={{ '/item/edit/' . $item['id'] }} class="ml-4">
                            <button class="bg-green-500  hover:bg-green-700 text-white font-bold px-2 rounded">Edit</button>
                        </a>
                        <!-- </td>
                                                                                                                                                                                        <td> -->
                        <a href="" class="ml-4">
                            <button class="bg-red-500  hover:bg-red-700 text-white font-bold px-2 rounded"
                                onclick="deleteitem({{ $item->id }})">Delete</button>
                        </a>
                    </td>
                </tr>
            </tbody>

        @endforeach
    </table>

    <script>
        function deleteitem(id) {
            window.setTimeout("document.getElementById('success').style.display='none';", 4000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 4000);
            var token = document.getElementById('csrf-token').value;

            if (confirm("Do you Really Want to Delete This Item?")) {
                $.ajax({
                    type: 'get',
                    url: '/item/delete/' + id,
                    success: function(response) {
                        // $('#demo_'+ id).remove();
                        document.getElementById("success").style.display = ""
                        var col = document.getElementById("demo-" + id);
                        col.fadeToggle();
                        // $("success.very-slow").fadeToggle(7000);
                        // col.fadeOut("slow");
                        // $("p").fadeOut();
                    },
                    error: function(res) {
                        document.getElementById("danger").style.display = ""
                    }
                });

            }

        }

    </script>


@endsection
