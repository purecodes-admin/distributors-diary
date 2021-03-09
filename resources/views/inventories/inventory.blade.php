@extends('layout/master')
@section('title', 'Records List')
@section('content')
    <div class="bg-white rounded-xl mt-4 px-2">

        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
        <h1 class="text-4xl text-gray-700 font-bold p-2">Inventory</h1>
        <span class="ml-60 font-bold text-center" id="success" style="color:green; display:none;">
            Stock Record Deleted Successfully...!!!
        </span>
        <span class="ml-60 font-bold text-center" id="danger" style="color:red; display:none;">
            Stock Record Not Deleted...!!!
        </span>

        @if (Session::has('message'))
            <p class="text-center text-red-600 font-bold">{{ Session::get('message') }}</p>
        @endif
        @if (Session::has('payment'))
            <p class="text-center text-green-700 font-bold">{{ Session::get('payment') }}</p>
        @endif
        <div class="mb-3 flex justify-end">
            <a href="/inventories/create">
                <button class=" mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New <i
                        class="fas fa-plus"></i></button>
            </a>
            <form action="/inventories">
                <input type="text" value="{{ request('search') }}" placeholder="Search by Date.." name="search"
                    class="rounded border-none w-auto bg-gray-100">
                <input id="from" type="hidden" name="from" />
                <input id="to" type="hidden" name="to" />
                <button type="submit" style="outline: none;"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="  hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Customer Type</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Customer Name</th>
                    <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Item Name</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Quantity</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Unit Price</th>
                    <th
                        class=" hidden md:table-cell px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Price</th>
                    <th
                        class=" hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Date & Time</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    </th>
                </tr>
            </thead>
            @forelse ($data as $record)
                <tbody>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm ">{{ $record->id }}</td>
                        <td class=" hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->customer->category }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->customer->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->item->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($record->quantity) }}
                        </td>
                        <td class=" px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ number_format($record->unit_price) }}
                        </td>
                        <td class="hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ number_format($record->price) }}
                        </td>
                        <td title="{{ $record->created_at }}"
                            class=" hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->created_at->diffForHumans() }}</td>

                        <td class=" w-40 px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if (!$record->payment)
                                <a href={{ '/inventories/payment/' . $record->id }} class="ml-3">
                                    <button class="bg-green-700  hover:bg-green-900 text-white font-bold px-1 rounded"
                                        id="payment" type="submit"><i class="fas fa-hand-holding-usd"></i></button>
                                </a>
                            @endif
                            <a href={{ '/inventories/edit/' . $record->id }} class="ml-3">
                                <button class="bg-green-700  hover:bg-green-900 text-white font-bold px-1 rounded"><i
                                        class="fas fa-edit"></i></button>
                            </a>
                            <a href="" class="ml-3">
                                <button class="bg-red-500  hover:bg-red-700 text-white font-bold px-1 rounded"
                                    onclick="deleteStock({{ $record->id }})"><i class="fas fa-trash-alt"></i></button>
                            </a>
                        </td>
                    </tr>
                </tbody>

            @empty
                <tr>
                    <td colspan="8" class="text-center py-4">No records found.</td>
                </tr>
            @endforelse
        </table>

        <script>
            function deleteStock(id) {
                // Token is Not Required in Delete Function
                // var token = document.getElementById('csrf-token').value; 
                window.setTimeout("document.getElementById('success').style.display='none';", 3000);
                window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

                if (confirm("Do you Really Want to Delete This Stock Record?")) {
                    $.ajax({
                        type: 'get',
                        url: '/inventories/delete/' + id,
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

    <script>
        $(function() {
            $('input[name="search"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                document.getElementById('from').value = start.format('YYYY-MM-DD');
                document.getElementById('to').value = end.format('YYYY-MM-DD');
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' +
                    end
                    .format('YYYY-MM-DD'));
            });
        });

    </script>
@endsection
