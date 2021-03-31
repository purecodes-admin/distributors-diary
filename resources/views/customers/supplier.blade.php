@extends('layout/master')
@section('title', 'Suppliers')
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
                <a>Suppliers</a>
            </li>
        </ul>
    </div>


    <div class="bg-white rounded-xl mt-4 px-1" style="width: 88%; margin:auto;">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <h1 class="text-4xl text-gray-700 font-bold pt-2 mt-4 ml-2 text-center mb-2 md:text-left">
            <span class="fa fa-users"></span> Suppliers List
        </h1>


        <div>
            <table class="table-fixed w-full ">
                <thead>
                    <tr>
                        <th
                            class="w-5 md:w-16 px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="w-16 md:w-auto px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Name</th>
                        <th
                            class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Address</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Contact</th>
                        <th
                            class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Discription</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Category</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            actions
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


                            {{-- code fo dropdown Operations --}}

                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                                <div class=" dropdown relativemt-3 md:mx-3 inline-block">
                                    <div class="pb-1">
                                        <button class="bg-gray-200 rounded py-1 pl-2 pr-1" style="outline:none;"> Actions
                                            <a class=" inline-block">
                                                <svg class="fill-current h-4 w-4 inline-block"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </a>
                                        </button>
                                    </div>



                                    <ul class="leading-7 dropdown-menu absolute hidden bg-gray-200 rounded">

                                        <li class=""><a class="pr-20 hover:bg-white block px-2 rounded hover:underline"
                                                href="{{ '/customers/edit/' . $record['id'] }}">
                                                Edit</a>
                                        </li>
                                        <li class=""><a class="pr-20 hover:bg-white block px-2 rounded hover:underline"
                                                href="{{ '/customers/delete/' . $record['id'] }}">
                                                Delete</a>
                                        </li>

                                    </ul>
                                </div>
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
        <span>
            {{ $data->links() }}
        </span>

    </div>
@endsection
