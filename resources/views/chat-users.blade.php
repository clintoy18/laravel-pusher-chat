<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <ul>
                @foreach($users as $user)
                    <li class="mb-3">
                        <a href="{{ route('private.chat', $user->id) }}" class="text-blue-600 hover:underline">
                            {{ $user->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
