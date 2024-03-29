@extends('layout/master')
@section('title', 'Home')
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

    <div class="bg-white rounded-xl mt-4 px-1" style="width: 88%; margin:auto;">
        <div class="md:flex">
            {{-- code for pending dues --}}

            {{-- <h1 class="text-4xl text-gray-700 font-bold m-4">Payment Pending</h1> --}}
            <div class="overflow-y-scroll  mt-4 px-1 bg-white rounded-xl md:mr-20 h-96">
                <h1 class="text-2xl text-gray-700 font-bold m-4">Dues</h1>
                <table class="w-auto leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                ID</th>
                            <th
                                class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Customer Type</th>
                            <th
                                class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Customer Name</th>
                            <th
                                class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
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

            <div class="overflow-y-scroll  mt-4 px-1 bg-white rounded-xl h-96">
                <h1 class="text-2xl text-gray-700 font-bold m-4">Items Stock</h1>
                <table class=" w-auto leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                ID</th>
                            <th
                                class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Item Name</th>
                            <th
                                class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Remaining Quantity</th>
                            <th
                                class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            </th>
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
                                        <button class="bg-blue-700 text-white font-bold px-2 rounded">TimeLine</button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>



        </div>

        {{-- code for top items --}}

        <div class=" mt-4 px-2 pt-2 bg-white rounded-xl mb-5 md:w-1/3 pb-20">
            <h1 class="text-2xl text-gray-700 font-bold m-4 ">Top Items</h1>
            <table class="w-auto leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Item Name</th>
                        <th
                            class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Business</th>
                    </tr>
                </thead>
                @foreach ($inventory as $record)
                    <tbody>
                        <tr>

                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record['name'] }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record['price'] }}
                            </td>

                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection
