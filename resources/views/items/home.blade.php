@extends('layout/master')
@section('title', 'Records List')
@section('content')

    <div class="mb-3 flex justify-end">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

    </div>
    <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
        Stock Record Deleted Successfully...!!!
    </span>
    <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
        Stock Record Not Deleted...!!!
    </span>
    <div class="flex justify-between">
        <h1 class="text-4xl text-gray-700 font-bold m-4">Dues</h1>
        <h1 class="text-4xl text-gray-700 font-bold m-4 ml-40">Items Stock</h1>
        <h1 class="text-4xl text-gray-700 font-bold m-4 ">Top Items</h1>

    </div>
    <div class="flex justify-between">
        {{-- code for pending dues --}}

        {{-- <h1 class="text-4xl text-gray-700 font-bold m-4">Payment Pending</h1> --}}
        <div class="overflow-y-scroll h-96 mr-5">
            <table class="w-auto leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Customer Type</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Customer Name</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Payment</th>
                    </tr>
                </thead>
                @foreach ($dues as $payment)
                    <tbody>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $payment->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $payment->category }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $payment->name }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $payment->dues }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>


        {{-- code for Item in stock --}}

        <div class="ml-5 overflow-y-scroll h-96">
            {{-- <h1 class="text-4xl text-gray-700 font-bold m-4">Items In Stock</h1> --}}
            <table class=" w-auto leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Item Name</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Remaining Quantity</th>
                    </tr>
                </thead>
                @foreach ($data as $stock)
                    <tbody>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $stock->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $stock->name }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $stock->stock }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href={{ '/items/timeline/' . $stock['id'] }} class="ml-3">
                                    <button class="bg-green-700 text-white font-bold px-2 rounded">TimeLine</button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>

        {{-- code for top items --}}

        <div class="">
            <table class="w-auto leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Item Name</th>
                    </tr>
                </thead>
                @foreach ($inventory as $record)
                    <tbody>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->item->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->item->name }}
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>

    </div>
@endsection
