@extends('layout/admin-master')
@section('title', 'Billings')
@section('content')
    <div class="bg-white rounded-xl mt-4 px-2" style="width: 88%; margin:auto;">

        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <h1 class="text-4xl text-gray-700 font-bold p-2">Invoices</h1>


        {{-- Search Boxes Code --}}

        <div class="">

            <form action="/users/invoices" class="flex justify-between">
                <div>
                    <input type="search" placeholder="Search.." name="search" class="rounded border-none bg-gray-100"
                        value="{{ request('search') }}">
                </div>

                <div>
                    <select name="invoice_type" class="rounded mb-1 bg-gray-100 border-none hidden md:inline-block"
                        onchange="this.form.submit()">
                        <option>Select</option>
                        <option value="paid" {{ request('invoice_type') == 'paid' ? 'selected' : '' }}>Paid Invoices
                        </option>
                        <option value="unpaid" {{ request('invoice_type') == 'unpaid' ? 'selected' : '' }}>Unpaid Invoices
                        </option>
                    </select>
                </div>

                <div class="hidden md:inline-block">
                    From: <input type="date" value="{{ request('searchFrom') }}" placeholder="Search by Date.."
                        name="searchFrom" class="rounded border-none w-auto bg-gray-100 ">
                    To: <input type="date" value="{{ request('searchTo') }}" placeholder="Search by Date.."
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

                    <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Distributor Name</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Amount</th>
                    <th
                        class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Month</th>
                    <th
                        class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Due Date</th>
                    <th
                        class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Has Sent</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Has paid</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        PDF</th>

                </tr>
            </thead>
            @forelse ($data as $record)
                <tbody>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm ">{{ $record->id }}</td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->distributor->name }}
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($record->amount) }}
                        </td>
                        <td class="hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->month }}
                        </td>
                        <td class="hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->due_date }}
                        </td>
                        <td class="hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if ($record->has_sent == 1)

                                <span class="bg-green-50  text-green-300 font-semibold px-2 rounded-xl text-xs">
                                    Yes
                                </span>
                            @else
                                <a class="bg-red-50  text-red-300 font-semibold px-2 rounded-xl text-xs">
                                    No
                                </a>
                            @endif
                        </td>

                        <td class=" px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if ($record->has_paid == '')
                                <span class="bg-red-50  text-red-300 font-semibold px-2 rounded-xl text-xs">
                                    No
                                </span>

                            @else
                                <span class="bg-green-50  text-green-300 font-semibold px-2 rounded-xl text-xs">
                                    Yes
                                </span>
                            @endif
                        </td>

                        <td class=" px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="/storage/{{ $record->pdf }}" download="{{ $record->distributor->name }}-invoice.pdf">
                                PDF <span class="fas fa-download"></span>
                            </a>
                        </td>
                    </tr>
                </tbody>

            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No records found.</td>
                </tr>
            @endforelse
        </table>
        <span>
            {{ $data->links() }}
        </span>
    </div>

@endsection
