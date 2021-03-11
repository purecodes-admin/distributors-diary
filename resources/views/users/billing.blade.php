@extends('layout/master')
@section('title', 'Billings')
@section('content')
    <marquee behavior="alternate" direction="right" class="text-sm">
        {{ Auth::user()->name }} your dues Are Rs:{{ Auth::user()->payment }}
    </marquee>
    <div class="bg-white rounded-xl mt-4 px-2">

        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <h1 class="text-4xl text-gray-700 font-bold p-2">Billings</h1>

        <span class="ml-60 font-bold text-center" id="success" style="color:green; display:none;">
            Bill Record Deleted Successfully...!!!
        </span>
        <span class="ml-60 font-bold text-center" id="danger" style="color:red; display:none;">
            Bill Record Not Deleted...!!!
        </span>
        <table class="min-w-full leading-normal table-fixed">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>

                    <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Payment</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Mode</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Date</th>
                </tr>
            </thead>
            @forelse ($data as $record)
                <tbody>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm ">{{ $record->id }}</td>

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
