<style>
    body {
        /* font-family: "Montserrat"; */
        font-size: 16px;
    }

    .menu {
        font-size: 14px;
        letter-spacing: 1px;
        font-weight: bolder;
    }

    .active,
    .menu:hover {
        text-decoration: underline;
        color: white;
    }

    .app a.active {
        text-decoration: underline;
        color: white;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

</style>



<div id="app" class="py-8">
    <header>
        <div
            class="fixed inset-x-0 top-0 text-white bg-blue-700 px-10 md:flex md:items-center md:justify-between md:px-40">
            <div id="myDiv" class="flex items-center justify-between">
                <div>@include('layout.logo')</div>
                {{-- <a href="/dashboard" class="mt-3 md:mx-3 text-green-700 hover:text-white font-bold text-xl">Welcome
                    {{ Auth::user()->name }}</a> --}}
                <div class="md:hidden align-middle">
                    <i class="material-icons align-middle cursor-pointer" @click.prevent="toogle"></i>
                </div>
            </div>
            <div :class="open ? 'block' : 'hidden'" class="flex flex-col text-left md:block md:text-right mt-3 md:mt-0">
                <a href="/users" class="menu mt-3 md:mx-3   text-gray-200">Home</a>
                <a href="/users/billings" class="menu mt-3 md:mx-3   text-gray-200">Billings</a>
                <a href="" class="menu mt-3 md:mx-3  font-bold"></a>
                {{-- <a href="/users/logout" class="menu mt-3 md:mx-3   text-gray-200">Logout</a> --}}
                <div class=" dropdown relativemt-3 md:mx-3 hover:text-red-500 font-bold inline-block">


                    <img src="{{ asset('images/' . Auth::user()->image) }}" alt="" height="30px" width="30px"
                        class="rounded-3xl inline-block">
                    <a class="inline-block">
                        <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </a>



                    <ul class="dropdown-menu absolute hidden text-gray-200 bg-blue-700 rounded-xl"><br>

                        {{-- <li class="">
                            <a class="block px-4 py-2 text-sm hover:bg-gray-400 font-extrabold"
                                href="/users/set-password">Change
                                Password
                            </a>
                        </li> --}}
                        <li class="">
                            <a class="block px-4 py-2 text-sm  hover:bg-gray-400 font-extrabold" href="/users/image">
                                Upload
                                Profile
                            </a>
                        </li>
                        <li class="">
                            <a class="block px-4 py-2 text-sm  hover:bg-gray-400 font-extrabold" href="/users/logout">
                                Logout
                            </a>
                        </li>
                        {{-- <li class="">
                            <a class="block px-4 py-2 text-sm hover:bg-gray-400 font-extrabold"
                                href="/users/set-password">Edit
                                Profile
                            </a>
                        </li> --}}

                        <!-- Authentication -->
                        {{-- <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="block px-4 py-2 text-sm font-extrabold  hover:bg-gray-400"
                                    href="route('logout')" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </a>
                        </li> --}}


                        </form>
                    </ul>
                </div>
                {{-- Logout --}}

            </div>
        </div>
    </header>
</div>


<script>
    // Add active class to the current menu (highlight it)
    // Get the container element
    var menuContainer = document.getElementById("myDiv");

    // Get all buttons with class="btn" inside the container
    var menu = menuContainer.getElementsByClassName("menu");

    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < menu.length; i++) {
        menu[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");

            // If there's no active class
            if (current.length > 0) {
                current[0].className = current[0].className.replace(" active", "");
            }

            // Add the active class to the current/clicked button
            this.className += " active";
        });
    }

</script>

<script>
    $('.myDiv').on('click', 'li', function() {
        $(this).addClass('active').siblings().removeClass('active');
    });

</script>
