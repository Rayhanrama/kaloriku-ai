<div class="w-64 h-screen bg-blue-600 text-white fixed top-0 left-0 flex flex-col shadow-lg">
    <div class="text-2xl font-bold p-6 border-b border-blue-500">Kaloriku</div>
    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-500">Dashboard</a>
        <a href="{{ route('makanan.index') }}" class="block px-4 py-2 rounded hover:bg-blue-500">Makanan</a>
        <a href="{{ route('aktivitas.index') }}" class="block px-4 py-2 rounded hover:bg-blue-500">Aktivitas</a>
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded hover:bg-blue-500">Edit Profil</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left px-4 py-2 rounded hover:bg-blue-500">Logout</button>
        </form>
    </nav>
</div>
