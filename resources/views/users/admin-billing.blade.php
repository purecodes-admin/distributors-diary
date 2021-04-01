@extends('layout/admin-master')
@section('title', 'Billings')
@section('content')
    <div class="bg-white rounded-xl mt-4 px-2">

        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
        <h1 class="text-4xl text-gray-700 font-bold p-2">Billings</h1>
        <span class="ml-60 font-bold text-center" id="success" style="color:green; display:none;">
            Bill Record Deleted Successfully...!!!
        </span>
        <span class="ml-60 font-bold text-center" id="danger" style="color:red; display:none;">
            Bill Record Not Deleted...!!!
        </span>


        {{-- Search Boxes Code --}}

        <div class="">

            <form action="/users/billings" class="flex justify-between">
                <div>
                    <input type="search" placeholder="Search.." name="search" class="rounded border-none bg-gray-100"
                        value="{{ request('search') }}">
                </div>
                <div class="hidden md:block">
                    From: <input type="month" value="{{ request('searchFrom') }}" placeholder="Search by Date.."
                        name="searchFrom" class="rounded border-none w-auto bg-gray-100">
                    To: <input type="month" value="{{ request('searchTo') }}" placeholder="Search by Date.."
                        name="searchTo" class="rounded border-none w-auto bg-gray-100">
                    <button type="submit" style="outline: none;"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>



        <table class="min-w-full leading-normal table-fixed">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="  hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Admin</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Distributor</th>
                    <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Payment</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Mode</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Date</th>
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
                            {{ $record->admin->name }}</td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->user->name }}</td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($record->payment) }}
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->mode }}
                        </td>
                        <td class=" px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->date }}
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
@endsection
