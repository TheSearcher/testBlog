<nav>
    <div class="container mx-auto px-6 py-2 flex justify-between items-center">
        <a class="font-bold text-2xl lg:text-4xl"
           href="{{route('index')}}">
            ENDY OFO
        </a>
        <div class="block lg:hidden">
            <button
                class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600
                 hover:text-gray-800 hover:border-teal-500 appearance-none focus:outline-none">
                <svg
                    class="fill-current h-3 w-3"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:block">
            <ul class="inline-flex">
                <li>
                    <a class="px-4 font-bold" href="{{route('index')}}">Home</a>
                </li>
                @if (Auth::guest())
                <li>
                    <a class="px-4 hover:text-gray-800" href="{{route('login')}}">
                        Login
                    </a >
                </li>
                <li>
                    <a class="px-4 hover:text-gray-800" href="{{route('register')}}">
                        Register
                    </a >
                </li>
                @else
                    @auth
                        @if(auth()->user()->can('authenticated-user-can-access') )
                            <li>
                                <a class="px-4 hover:text-gray-800" href="{{route('dashboard.user.dashboard')}}">
                                    Dashboard
                                </a >
                            </li>
                        @else
                            <li>
                                <a class="px-4 hover:text-gray-800" href="{{route('dashboard.dashboard')}}">
                                    Dashboard
                                </a >
                            </li>
                        @endif
                    @endauth
                    @auth
                        @if(auth()->user()->can('authenticated-user-can-access') )
                            <li>
                                <a class="px-4 hover:text-gray-800" href="{{route('dashboard.user.post.create')}}">
                                    Add Blog
                                </a>
                            </li>
                        @endif
                    @endauth

                    <li>
                        <a class="px-4 hover:text-gray-800" href="{{route('logs.outs')}}">
                               Logout
                         </a >
                    </li>
                    @endif
            </ul>
        </div>
    </div>
</nav>
