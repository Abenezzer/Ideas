<nav>
    <div class="navbar bg-base-100 shadow-sm">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="-1"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li><a href="/ideas">Ideas</a></li>

                </ul>
            </div>
            <a href="/" class="btn btn-ghost text-xl">Ideas</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="/ideas">Ideas</a></li>

            </ul>
        </div>
        <div class="navbar-end gap-x-2">

            @auth
                <form action="/logout" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">Logout</button>
                </form>
            @else
                <a href="/login" class="btn btn-primary">Login</a>
                <a href="/register" class="btn btn-accent">Register</a>

            @endauth


        </div>
    </div>
</nav>
