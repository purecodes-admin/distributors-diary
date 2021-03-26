@extends('layout/admin-master')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="bg-white rounded-xl mt-4 px-2" style="width: 88%; margin:auto;">

        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <h1 class="text-4xl text-gray-700 font-bold m-4 pt-4">Distributors List</h1>

        <div class="flex justify-end">

            <a href="/users/add">

                <button class="mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New <i
                        class="fas fa-plus"></i></button>
            </a>

            <form action="users">
                <input type="search" placeholder="Search.." name="search" value="{{ request('search') }}"
                    class="rounded border-none bg-gray-100">
            </form>
        </div>

        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Distributor Record Deleted Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Distributor Record Not Deleted...!!!
        </span>

        <table class="min-w-full">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Name</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Email</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Image</th>
                    <th
                        class=" hidden md:table-cell px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Dues</th>
                    <th
                        class=" hidden md:table-cell px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Date & Time</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Operations
                    </th>
                </tr>
            </thead>
            @forelse ($data as $record)
                <tbody>
                    <tr id="demo">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->id }}</td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->name }}</td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->email }}</td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <img src="{{ asset('images/' . $record->image) }}" alt="image" height="100px" width="100px">
                        </td>

                        <td class=" hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->payment }}</td>

                        <td title="{{ $record->created_at }}" style="overflow-wrap:anywhere;"
                            class="hidden md:table-cell  px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->created_at->diffForHumans() }}
                        </td>

                        {{-- code fo dropdown Operations --}}

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                            <div class=" dropdown relativemt-3 md:mx-3 hover:text-red-500 font-bold inline-block">
                                Operations
                                <a class="inline-block">
                                    <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </a>

                                <ul class="dropdown-menu absolute hidden text-gray-200 bg-white rounded-b-xl">

                                    <li class="">
                                        @if ($record->payment)
                                            <a class=" text-gray-700 px-1 rounded hover:underline"
                                                href={{ '/users/billings/' . $record->id }}>
                                                Add Payment
                                            </a>
                                        @endif
                                    </li>
                                    <li class=""><a class=" text-gray-700 px-1 rounded hover:underline"
                                            href="{{ '/users/edit-distributor/' . $record->id }}">
                                            Edit</a>
                                    </li>
                                    <li class=""><a class=" text-gray-700 px-1 rounded hover:underline"
                                            onclick="deleteDistributor({{ $record->id }})">
                                            Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>

            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No records found.</td>
                </tr>
            @endforelse
        </table>

        <script>
            function deleteDistributor(id) {
                var token = document.getElementById('csrf-token').value;

                if (confirm("Do you Really Want to Delete This Distributor?")) {
                    $.ajax({
                        type: 'get',
                        url: '/users/delete/' + id,
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
