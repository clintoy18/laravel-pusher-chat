<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Messages container with ID for JS -->
                <div class="p-6 h-[400px] overflow-y-auto" id="messages-container">
                    @foreach($messages as $message)
                        <div class="mb-4">
                            <strong>{{ $message->user->name }}:</strong>
                            <span>{{ $message->message }}</span><br>
                            <small class="text-gray-500">{{ $message->created_at->diffForHumans() }}</small>
                        </div>
                        <hr>
                    @endforeach
                </div>

                <div class="p-6 border-t border-gray-200 bg-gray-50">
                    <form method="POST" action="{{ route('chat.store') }}">
                        @csrf
                        <div class="flex">
                            <input
                                type="text"
                                name="message"
                                class="flex-1 border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring focus:border-blue-300"
                                placeholder="Type your message..."
                                required
                            >
                            <button
                                type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-r-md"
                            >
                                Send
                            </button>
                        </div>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
