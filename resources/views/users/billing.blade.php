@extends('layout/master')
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
                    <td colspan="4" class="text-center py-4">No records found.</td>
                </tr>
            @endforelse
        </table>

        <marquee behavior="alternate" direction="right" class="text-sm">
            {{ Auth::user()->name }} your dues Are Rs:{{ Auth::user()->payment }}
        </marquee>

        <span>
            {{ $data->links() }}
        </span>
    </div>
@endsection
