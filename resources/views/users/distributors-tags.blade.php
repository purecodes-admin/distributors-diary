@extends('layout/master')
@section('title', 'Items')
@section('content')

    <div class="bg-white rounded-xl mt-4 px-1 pt-1" style="width: 88%; margin:auto;">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <span class="ml-80 font-bold" id="success" style="color:green; display:none;">
            Tag Deleted Successfully...!!!
        </span>
        <span class="ml-80 font-bold" id="danger" style="color:red; display:none;">
            Tag Not Deleted...!!!
        </span>
        <h1 class="text-4xl text-gray-700 font-bold pt-2 mt-4 ml-2">
            <span class="fas fa-tags"></span> Tags List
        </h1>
        <div class="flex md:justify-end justify-start">
            <a href="/users/custom-tags">

                <button class="mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New <i
                        class="fas fa-plus"></i></button>
            </a>
            <form action="distributors-tags">
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
                        actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $tag)
                    <tr id="demo">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $tag->id }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $tag->label }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $tag->slug }}</td>


                        <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">

                            <div class=" dropdown relativemt-3 md:mx-3 inline-block">
                                <div class="pb-1">
                                    @if ($tag->distributor_id)
                                        <button class="bg-gray-200 rounded py-1 pl-2 pr-1" style="outline:none;"> Actions
                                            <a class=" inline-block">
                                                <svg class="fill-current h-4 w-4 inline-block"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </a>
                                        </button>
                                    @endif

                                </div>



                                <ul class="leading-7 dropdown-menu absolute hidden bg-gray-200 rounded">
                                    <li class=""><button style="outline:none;"
                                            class="pr-20 hover:bg-white px-2 rounded hover:underline"
                                            onclick="deletetag({{ $tag->id }})">
                                            Delete</button>
                                    </li>
                                </ul>
                            </div>
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
                    url: '/users/delete-tag/' + id,
                    success: function(response) {
                        document.getElementById("success").style.display = ""
                        var col = document.getElementById("demo-" + id);
                        window.location.reload();
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
