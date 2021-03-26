@extends('layout/admin-master')
@section('title', 'Items')
@section('content')

    <div class="bg-white rounded-xl mt-4 px-1 pt-1" style="width: 88%; margin:auto;">
        <input type=" hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <span class="ml-80 font-bold" id="success" style="color:green; display:none;">
            Tag Deleted Successfully...!!!
        </span>
        <span class="ml-80 font-bold" id="danger" style="color:red; display:none;">
            Tag Not Deleted...!!!
        </span>
        <h1 class="text-4xl text-gray-700 font-bold pt-2 mt-4 ml-2">
            <span class="fas fa-tags"></span> Tags List
        </h1>
        <div class="flex justify-end">
            <a href="/users/create-tags">

                <button class="mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New <i
                        class="fas fa-plus"></i></button>
            </a>
            <form action="tags">
                <input type="search" placeholder="Search.." name="search" class="rounded border-none bg-gray-100"
                    value="{{ request('search') }}">
            </form>
        </div>
        <table class="min-w-full table-fixed">
            <thead>
                <tr id="demo">
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Label</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        slug</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $tag)
                    <tr id="demo">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $tag->id }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $tag->label }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $tag->slug }}</td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            <a href="" class="ml-4">
                                <button class="bg-red-500  hover:bg-red-700 text-white font-bold px-1 rounded"
                                    onclick="deletetag({{ $tag->id }})"><i class="fa fa-trash-alt"></i></button>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <span>
            {{ $data->links() }}
        </span>
    </div>

    <script>
        function deletetag(id) {
            window.setTimeout("document.getElementById('success').style.display='none';", 4000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 4000);
            var token = document.getElementById('csrf-token').value;

            if (confirm("Do you Really Want to Delete This Tag?")) {
                $.ajax({
                    type: 'get',
                    url: '/users/remove-tag/' + id,
                    success: function(response) {
                        document.getElementById("success").style.display = ""
                        var col = document.getElementById("demo-" + id);
                        col.fadeToggle();
                    },
                    error: function(res) {
                        document.getElementById("danger").style.display = ""
                    }
                });

            }

        }

    </script>
@endsection
