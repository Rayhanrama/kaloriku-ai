<nav class="bg-blue-600 h-16 px-6 text-white flex justify-between items-center shadow fixed top-0 left-0 right-0 z-10">
    <div class="text-2xl font-bold">Kaloriku</div>
    <div class="flex items-center gap-6">
        @guest
            <a href="{{ route('login') }}" class="hover:underline">Login</a>
            <a href="{{ route('register') }}" class="hover:underline">Register</a>
        @else
            <span class="font-medium">{{ Auth::user()->name }}</span>
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="hover:underline">Logout</button>
            </form>
        @endguest
    </div>
</nav>
