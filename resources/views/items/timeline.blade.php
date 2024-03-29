@extends('layout/master')
@section('title', 'Stock timeline')
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
                <a href="../home" class="hover:underline">Home</a>
            </li>
            <li class="text-blue-700 hover:text-blue-900">
                <a>Stock Timeline</a>
            </li>
        </ul>
    </div>

    <div class="mb-3 flex justify-end">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

    </div>
    <div class="bg-white rounded-xl mt-4 px-2 pt-1" style="width: 88%; margin:auto;">
        <h1 class="text-4xl text-gray-700 font-bold m-4">Stock Timeline</h1>
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class=" hidden md:table-cell px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Distributor Name</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Item Name</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Customer Name</th>
                    <th
                        class=" hidden md:table-cell px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Customer Type</th>
                    <th
                        class=" hidden md:table-cell px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Quantity</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Price</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $timeline)
                    <tr>
                        <td class="hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $timeline->id }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $timeline->user->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $timeline->item->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $timeline->customer->name }}</td>
                        <td class="hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $timeline->customer->category }}
                        </td>
                        <td class=" hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ number_format($timeline->quantity) }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($timeline->price) }}
                        </td>
                        <td title="{{ $timeline->created_at }}" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $timeline->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
        function GetAlert() {

            document.getElementById("danger").style.display = ""
        }

    </script>
    <span>
        {{ $data->links() }}
    </span>
@endsection
