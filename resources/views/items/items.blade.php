@extends('layout/master')
@section('title', 'Items')
@section('content')

    <div class="bg-white rounded-xl mt-4  pt-1" style="width: 88%; margin:auto;">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Item Deleted Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Item Not Deleted...!!!
        </span>
        <h1 class="text-4xl text-gray-700 font-bold pt-2 mt-4 ml-2">
            <span class="fas fa-shopping-cart"></span> Items List
        </h1>
        <div class="flex justify-end">
            <a href="/items/add">

                <button class="mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New <i
                        class="fas fa-plus"></i></button>
            </a>
            <form action="items">
                <input type="search" placeholder="Search.." name="search" class="rounded border-none bg-gray-100 mr-10"
                    value="{{ request('search') }}">
            </form>
        </div>
        <table class="min-w-full table-fixed">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Name</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Whole Sale Price</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Retail Price</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        actions
                    </th>
                </tr>
            </thead>
            @forelse ($data as $item)
                <tbody>
                    <tr id="demo">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $item->id }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $item->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ number_format($item->wholesale_price) }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ number_format($item->retailsale_price) }}</td>

                        {{-- code fo dropdown Operations --}}

                        <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">

                            <div class=" dropdown relativemt-3 md:mx-3 inline-block">
                                <div class="pb-1">
                                    <button class="bg-gray-200 rounded py-1 pl-2 pr-1" style="outline:none;"> Actions
                                        <a class=" inline-block">
                                            <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                            </svg>
                                        </a>
                                    </button>
                                </div>



                                <ul class="leading-7 dropdown-menu absolute hidden bg-gray-200 rounded">

                                    <li class=""><a class="pr-20 hover:bg-white block px-2 rounded hover:underline"
                                            href="{{ '/items/edit/' . $item['id'] }}">
                                            Edit</a>
                                    </li>
                                    <li class=""><button style="outline:none;"
                                            class="pr-20 hover:bg-white px-2 rounded hover:underline"
                                            onclick="deleteitem({{ $item->id }})">
                                            Delete</button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>

            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No records found.</td>
                </tr>
            @endforelse
        </table>

        <script>
            function deleteitem(id) {
                window.setTimeout("document.getElementById('success').style.display='none';", 4000);
                window.setTimeout("document.getElementById('danger').style.display='none';", 4000);
                var token = document.getElementById('csrf-token').value;

                if (confirm("Do you Really Want to Delete This Item?")) {
                    $.ajax({
                        type: 'get',
                        url: '/items/delete/' + id,
                        success: function(response) {
                            // $('#demo_'+ id).remove();
                            document.getElementById("success").style.display = ""
                            var col = document.getElementById("demo-" + id);
                            window.location.reload();
                            Toaster.show("The record is deleted");
                            col.fadeToggle();
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
