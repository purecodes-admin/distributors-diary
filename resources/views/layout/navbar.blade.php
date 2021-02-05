<style>
    body {
        /* font-family: "Montserrat"; */
        font-size: 16px;
    }

</style>



<div id="app">
    <header>
        <div class="text-white bg-gray-900 py-5 px-10 md:flex md:items-center md:justify-between md:px-40">
            <div class="flex items-center justify-between">
                <div>@include('layout.logo')</div>
                <a href="/dashboard" class="mt-3 md:mx-3 text-green-500 hover:text-white font-bold text-xl">Welcome
                    {{ Auth::user()->name }}</a>
                <div class="md:hidden align-middle">
                    <i class="material-icons align-middle cursor-pointer" @click.prevent="toogle">menu</i>
                </div>
            </div>
            <div :class="open ? 'block' : 'hidden'" class="flex flex-col text-left md:block md:text-right mt-3 md:mt-0">
                <a href="/dashboard" class="mt-3 md:mx-3 hover:text-blue-500 font-bold">Home</a>
                <a href="/customer" class="mt-3 md:mx-3 hover:text-blue-500 font-bold">Customers</a>
                {{-- <a href="/customer/supplier" class="mt-3 md:mx-3 hover:text-blue-500 font-bold">Suppliers</a>
                <a href="/customer/purchaser" class="mt-3 md:mx-3 hover:text-blue-500 font-bold">Purchasers</a> --}}
                <a href="/item" class="mt-3 md:mx-3 hover:text-green-500 font-bold">Items</a>
                <a href="/stock" class="mt-3 md:mx-3 hover:text-green-500 font-bold">Stock</a>
                <div class="mt-3 md:mx-3 hover:text-red-500 font-bold inline-block">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </form>
                </div>
                {{-- Logout --}}

            </div>
        </div>
    </header>
</div>
