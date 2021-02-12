@extends('layout/master')
@section('title', 'Records List')
@section('content')
    <div class="mb-3 flex justify-end">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

    </div>
    <h1 class="text-4xl text-gray-700 font-bold m-4">Stock Timeline</h1>
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    ID</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Distributor Name</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Item Name</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Customer Name</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Customer Type</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Quantity</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Price</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    Time</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $timeline)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $timeline->id }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $timeline->user->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $timeline->item->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $timeline->customer->name }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $timeline->customer->category }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($timeline->quantity) }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($timeline->price) }}</td>
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

    <script>
        function GetAlert() {

            document.getElementById("danger").style.display = ""
        }

    </script>
    <span>
        {{ $data->links() }}
    </span>
@endsection
