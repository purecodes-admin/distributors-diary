@extends('layout/master')
@section('title', 'Customers')
@section('content')


    <div class="bg-white rounded-xl mt-4 px-1" style="width: 88%; margin:auto;">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <h1 class="text-4xl text-gray-700 font-bold pt-2 mt-4 ml-2 text-left">
            <span class="fa fa-users"></span> Customers List
        </h1>

        {{-- code for success message --}}
        @if (Session::has('message'))
            <div class="flex justify-between md:w-2/6 text-green-800 px-3 py-3 rounded-md font-bold  text-center mx-auto"
                style="background-color: #F2FAF7;">
                <p class="self-center">
                    <span class="fas fa-check-circle" style="color: #32C48D;"></span> Success!
                    {{ Session::get('message') }}
                </p>
                <strong class="self-center text-2xl cursor-pointer alert-del" style="color: #32C48D;">
                    &times;
                </strong>
            </div>
        @endif

        {{-- code for error message --}}
        @if (Session::has('error'))
            <div class="flex justify-between md:w-2/6 text-red-800 px-3 py-3 rounded-md font-bold  text-center mx-auto"
                style="background-color: #FDF2F2;">
                <p class="self-center">
                    <span class="fas fa-check-circle" style="color: #F98A8A;"></span> Failed!
                    {{ Session::get('error') }}
                </p>
                <strong class="self-center text-2xl cursor-pointer alert-del" style="color: #F98A8A;">
                    &times;
                </strong>
            </div>
        @endif


        {{-- code for drop down and search box --}}

        <div class="flex justify-between mt-8">
            <form action="customers">

                <div>
                    <select name="customer_type" class="rounded mb-1 bg-gray-100 border-none" onchange="this.form.submit()">
                        <option>Select</option>
                        <option value="suppliers" {{ request('customer_type') == 'suppliers' ? 'selected' : '' }}>
                            Suppliers
                        </option>
                        <option value="purchasers" {{ request('customer_type') == 'purchasers' ? 'selected' : '' }}>
                            Purchasers
                        </option>
                    </select>
                </div>
            </form>

            <div class="flex md:justify-end justify-end">

                <a href="/customers/add">

                    {{-- for md view --}}
                    <button
                        class=" hidden md:block mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New
                        <i class="fas fa-plus"></i>
                    </button>
                    {{-- for mobile view --}}
                    <button class=" md:hidden mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">
                        <i class="fas fa-plus"></i>
                    </button>
                </a>

                <form action="customers">
                    <input type="search" placeholder="Search.." name="search" value="{{ request('search') }}"
                        class="rounded border-none bg-gray-100">
                    {{-- <button type="submit"><i class="fa fa-search"></i></button> --}}
                </form>
            </div>
        </div>

        {{-- <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Customer Record Deleted Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Customer Record Not Deleted...!!!
        </span> --}}
        <div>
            <table class="table-fixed w-full ">
                <thead>
                    <tr>
                        <th
                            class="w-5 md:w-16 px-5 py-3 border-b-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="w-16 md:w-auto px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Name</th>
                        <th
                            class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Address</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Contact</th>
                        <th
                            class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="hidden md:table-cell px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Discription</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Category</th>
                        <th
                            class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $record)
                        <tr id="demo">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->name }}</td>
                            <td class=" hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $record->address }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->contact }}</td>
                            <td style="overflow-wrap:anywhere;"
                                class=" hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $record->email }}</td>
                            <td style="overflow-wrap:anywhere;"
                                class=" hidden md:table-cell  px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $record->discription }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->category }}</td>


                            {{-- code fo dropdown Operations --}}

                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                                <div class=" dropdown relativemt-3 md:mx-3 inline-block">
                                    <div class="pb-1">
                                        <button class="bg-gray-200 rounded py-1 pl-2 pr-1" style="outline:none;"> Actions
                                            <a class=" inline-block">
                                                <svg class="fill-current h-4 w-4 inline-block"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </a>
                                        </button>
                                    </div>



                                    <ul class="leading-7 dropdown-menu absolute hidden bg-gray-200 rounded">

                                        <li class=""><a class="pr-20 hover:bg-white block px-2 rounded hover:underline"
                                                href="{{ '/customers/edit/' . $record['id'] }}">
                                                Edit</a>
                                        </li>

                                        <li class=""><a class="pr-20 hover:bg-white block px-2 rounded hover:underline"
                                                href="{{ '/customers/delete/' . $record['id'] }}">
                                                Delete</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <span>
            {{ $data->links() }}
        </span>

    </div>



    {{-- code for close alert --}}
    <script>
        var alert_del = document.querySelectorAll('.alert-del');

        alert_del.forEach((x) => {
            x.addEventListener('click', () =>
                x.parentElement.classList.add('hidden')
            );
        });

    </script>

    {{-- <script>
        function deleteCustomer(id) {
            var token = document.getElementById('csrf-token').value;

            if (confirm("Do you Really Want to Delete This Customer?")) {
                $.ajax({
                    type: 'get',
                    url: '/customers/delete/' + id,
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        document.getElementById("success").style.display = ""
                        $('#demo_' + id).remove();
                        window.location.reload();
                    },
                    error: function(res) {
                        document.getElementById("danger").style.display = ""
                    }
                });

            }

        }

    </script> --}}

@endsection
