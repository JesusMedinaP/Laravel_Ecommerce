<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Usuarios
        </h2>
    </x-slot>
</div>

<x-jet-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
    Usuarios
</x-jet-nav-link>
…
<x-jet-responsive-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
    Usuarios
</x-jet-responsive-nav-link>
