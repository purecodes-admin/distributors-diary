@extends('layout/master2')
@section('title', 'The Distributors')
@section('content')

    {{-- @if (Route::has('login'))
        <div class="fixed top-0 right-0 px-6 py-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif


    <!-- This example requires Tailwind CSS v2.0+ -->
    {{-- hero section --}}
    <div class="relative bg-white overflow-hidden" x-data="{open: false}">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                    <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
                        <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                            <div class="flex items-center justify-between w-full md:w-auto">
                                <a href="#">
                                    <span class="sr-only">Workflow</span>
                                    <img class="h-8 w-auto sm:h-10" src="/images/purecodes.png">
                                </a>
                                <div class="-mr-2 flex items-center md:hidden">
                                    <button @click="open=true" type="button"
                                        class="btn1 bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                        aria-expanded="false">
                                        <span class="sr-only">Open main menu</span>
                                        <!-- Heroicon name: outline/menu -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">

                            <a href="#features" class="font-medium text-gray-500 hover:text-gray-900">Features</a>

                            <a href="#contact" class="font-medium text-gray-500 hover:text-gray-900">Contact Us</a>

                            <a href="login" class="font-medium text-indigo-600 hover:text-indigo-500">Log in</a>
                        </div>
                    </nav>
                </div>

                {{-- Code For Mobile Menu --}}

                <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">

                    <div x-transition:enter="duration-150 ease-out" x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        x-description="Mobile menu, show/hide based on menu open state."
                        class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden" x-ref="panel"
                        @click.away="open = false" x-show="open">

                        <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="px-5 pt-4 flex items-center justify-between">
                                <div>
                                    <img class="h-8 w-auto" src="/images/purecodes.png" alt="">
                                </div>
                                <div class="-mr-2">
                                    <button type="button" @click="open=false"
                                        class="btn2 bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                        <span class="sr-only">Close main menu</span>
                                        <!-- Heroicon name: outline/x -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="px-2 pt-2 pb-3 space-y-1" x-show="open" x-on:click.away="close">
                                <a href="#"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Features</a>

                                <a href="#"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Contact
                                    Us</a>

                            </div>
                            <a href="{{ route('login') }}"
                                class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100">
                                Log in
                            </a>
                        </div>
                    </div>
                </div>

                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Software to manage your</span>
                            <span class="block text-indigo-600 xl:inline">distribution system</span>
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            This Software manages your distribution system, your customers, items, bill invoices, top items
                            and many more.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('login') }}"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                    Get started
                                </a>
                            </div>
                            {{-- <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                                    Live demo
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixqx=XRR6TJaxJK&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80"
                alt="">
        </div>
    </div>


    {{-- code for feature section --}}

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="py-12 bg-white" id="features">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    A better way of distribution
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    We are providing you a better way of distribution which is more reliable and efficient way.
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/globe-alt -->

                                <span class="fas fa-file-invoice-dollar"></span>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Automatic Invoicing</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Automatic invoicing system is integratred to manage your bill invoices on monthly basis.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/scale -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">No hidden fees</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            No hidden fees or charges are applied on using the software.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/lightning-bolt -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">User Friendly</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Try it now! All in one Software, totally user friendly and reliable, manage all your data.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/annotation -->
                                <span class="fas fa-mobile-alt"></span>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Mobile Responsive</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            This is a mobile responsive software, so due to responsiveness this is more user friendly
                            software and easy to use.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    {{-- code for CTA Section --}}

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-indigo-700">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">Manage your productivity.</span>
                <span class="block">Start using distribution system today.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-indigo-200">Manage your productivity and your business with one click get
                started with us and enjoy the journey.</p>
            <a href="{{ route('login') }}"
                class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto">
                Sign up for free
            </a>
        </div>
    </div>


    {{-- Code for Contact Section --}}

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white" id="contact">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
            <div class="divide-y-2 divide-gray-200">
                <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                    <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                        Get in touch
                    </h2>
                    <div class="mt-8 grid grid-cols-1 gap-12 sm:grid-cols-2 sm:gap-x-8 sm:gap-y-12 lg:mt-0 lg:col-span-2">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Collaborate
                            </h3>
                            <dl class="mt-2 text-base text-gray-500">
                                <div>
                                    <dt class="sr-only">
                                        Email
                                    </dt>
                                    <dd>
                                        info@purecodes.net
                                    </dd>
                                </div>
                                <div class="mt-1">
                                    <dt class="sr-only">
                                        Contact number
                                    </dt>
                                    <dd>
                                        0333-9644730
                                    </dd>
                                </div>
                            </dl>
                        </div>

                    </div>
                </div>
                <div class="mt-16 pt-16 lg:grid lg:grid-cols-3 lg:gap-8">
                    <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                        Locations
                    </h2>
                    <div class="mt-8 grid grid-cols-1 gap-12 sm:grid-cols-2 sm:gap-x-8 sm:gap-y-12 lg:mt-0 lg:col-span-2">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Peshawar
                            </h3>
                            <div class="mt-2 text-base text-gray-500">
                                <p>
                                    Spinzer IT plaza, Block A, Fourth floor, Office F-30.
                                </p>
                                <p class="mt-1">
                                    Peshawar
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Code For Footer Section --}}

    <!-- This example requires Tailwind CSS v2.0+ -->
    <footer class="bg-white" aria-labelledby="footerHeading">
        <h2 id="footerHeading" class="sr-only">Footer</h2>
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <img class="h-10" src="/images/purecodes.png" alt="Company name">
                    <p class="text-gray-500 text-base">
                        Making the world a better place through constructing elegant hierarchies.
                    </p>
                    <div class="flex space-x-6">
                        <a href="https://www.facebook.com/Pure-Codes-software-solutions-107742607507894/"
                            class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                PureCodes
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="#features" class="text-base text-gray-500 hover:text-gray-900">
                                        Features
                                    </a>
                                </li>

                                <li>
                                    <a href="#contact" class="text-base text-gray-500 hover:text-gray-900">
                                        Contact Us
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-200 pt-8">
                <p class="text-base text-gray-400 xl:text-center">
                    &copy; 2021 PureCodes. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
@endsection
