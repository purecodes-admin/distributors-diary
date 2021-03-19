@extends('layout/master')
@section('title', 'Expenses')
@section('content')

    <div class="bg-white rounded-xl mt-4 px-1 pt-1">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <span class="ml-80 font-bold" id="success" style="color:green; display:none;">
            Tag Deleted Successfully...!!!
        </span>
        <span class="ml-80 font-bold" id="danger" style="color:red; display:none;">
            Tag Not Deleted...!!!
        </span>

        {{-- code for add button and heading --}}
        <div class="flex">
            <div>
                <h1 class="text-4xl text-gray-700 font-bold pt-2 mt-4 ml-2 mb-5">
                    <span class="fas fa-dollar-sign "></span> Your Expenses
                </h1>
            </div>
            <div>
                <a href="/users/create-expense">

                    <button class=" mt-9 ml-5 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New <i
                            class="fas fa-plus"></i>
                    </button>
                </a>
            </div>
        </div>

        {{-- code for search boxes --}}

        <div>
            <form action="expenses" class="flex justify-between">
                <div>
                    <select name="tag_type"
                        class="multiple-tags ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        onchange="this.form.submit()" multiple>
                        <option>Select</option>

                        <option value="">Select Item Name</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ request('tag_type') == '{{ $tag->id  ?>' }}'
                                ? 'selected' : '' }}>
                                {{ $tag->label }}</option>
                        @endforeach
                        {{-- <option value="paid" {{ request('invoice_type') == 'paid' ? 'selected' : '' }}>Paid Invoices
                        </option>
                        <option value="unpaid" {{ request('invoice_type') == 'unpaid' ? 'selected' : '' }}>Unpaid Invoices
                        </option> --}}
                    </select>

                </div>
                <div>
                    From: <input type="date" value="{{ request('searchFrom') }}" placeholder="Search by Date.."
                        name="searchFrom" class="rounded border-none w-auto bg-gray-100">
                    To: <input type="date" value="{{ request('searchTo') }}" placeholder="Search by Date.."
                        name="searchTo" class="rounded border-none w-auto bg-gray-100">
                    <button type="submit" style="outline: none;"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>

        <table class="min-w-full table-fixed">
            <thead>
                <tr id="demo">
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Amount</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Date</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Tags</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $expense)
                    <tr id="demo">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $expense->id }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $expense->expense_amount }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $expense->date }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{-- {{ $expense->tags->each->label }} --}}
                            @foreach ($expense->tags as $tag)
                                <span
                                    class="bg-green-50  text-green-300 font-semibold px-2 rounded-xl text-xs">{{ $tag->label }}</span>

                            @endforeach
                        </td>

                        {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            @if ($expense->distributor_id)
                                <a href="" class="ml-4">
                                    <button class="bg-red-500  hover:bg-red-700 text-white font-bold px-1 rounded"
                                        onclick="deletetag({{ $expense->id }})"><i class="fa fa-trash-alt"></i></button>
                                </a>
                            @endif
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <span>
            {{ $data->links() }}
        </span>
    </div>

    <script>
        function deletetag(id) {
            window.setTimeout("document.getElementById('success').style.display='none';", 4000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 4000);
            var token = document.getElementById('csrf-token').value;

            if (confirm("Do you Really Want to Delete This Tag?")) {
                $.ajax({
                    type: 'get',
                    url: '/users/delete-tag/' + id,
                    success: function(response) {
                        document.getElementById("success").style.display = ""
                        var col = document.getElementById("demo-" + id);
                        col.fadeToggle();
                    },
                    error: function(res) {
                        document.getElementById("danger").style.display = ""
                    }
                });

            }

        }

        // code for multiple select 2

        $(document).ready(function() {
            $('.multiple-tags').select2({

                placeholder: "Select Tags",
                tags: true,
                tokenSeprators: ['/', ',', ',', ""]
            });
        })

    </script>
@endsection
