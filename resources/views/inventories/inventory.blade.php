@extends('layout/master')
@section('title', 'Inventory')
@section('content')

    <style>
        .menu {
            font-size: 14px;
            letter-spacing: 1px;
            font-weight: bolder;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

    </style>

    <div class="bg-white rounded-xl mt-4 px-1" style="width: 88%; margin:auto;">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <h1 class="text-4xl text-gray-700 font-bold pt-2 mt-4 ml-2 text-center md:text-left">
            Inventory
        </h1>

        {{-- code for search boxes --}}
        <div class="mb-3 flex md:justify-end justify-center">
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

        {{-- code for success and error messages --}}

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


        <div>
            <table class="table-fixed w-full ">
                <thead>
                    <tr>
                        <th
                            class="w-10 px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Customer Type</th>
                        <th
                            class=" px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Customer Name</th>
                        <th
                            class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Item Name</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Quantity</th>
                        <th
                            class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Unit Price</th>
                        <th
                            class=" hidden md:table-cell px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Price</th>
                        <th
                            class=" hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Date & Time</th>
                        <th
                            class="w-36 px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $record)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm ">{{ $record->id }}</td>
                            <td class=" hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $record->customer->category }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->customer->name }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->item->name }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ number_format($record->quantity) }}
                            </td>
                            <td class="hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ number_format($record->unit_price) }}
                            </td>
                            <td class="hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ number_format($record->price) }}
                            </td>
                            <td title="{{ $record->created_at }}"
                                class=" hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $record->created_at->diffForHumans() }}</td>

                            {{-- code fo dropdown Operations --}}

                            <td class="hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <button class="bg-gray-200 action">Actions
                                </button>
                                <ul class="actionlist hidden">
                                    <li>Payment</li>
                                    <li>Edit</li>
                                    <li>Delete</li>
                                </ul>
                            </td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <span>
                {{ $data->links() }}
            </span>
        </div>

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

                // drop down actions
                $('.action').on('click', function(event) {
                    $(event.target).next('ul').css('display', 'block');

                });


            });


            // for dropdown button
            // var button = document.getElementsByClassName("dropbtn");
            // var list = document.getElementsByClassName("actionlist");
            // list.style.display = "none";
            // button.addEventListener("click", (event) => {
            //     if (list.style.display == "none") {
            //         list.style.display == "block";
            //     } else {
            //         list.style.display == "none";
            //     }
            // })

        </script>
    @endsection
