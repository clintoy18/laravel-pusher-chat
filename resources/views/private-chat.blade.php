<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Private Chat with {{ $recipient->name }}
        </h2>
    </x-slot>

    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="recipient-id" content="{{ $recipient->id }}">

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- PRIVATE Messages container -->
                <div class="p-6 h-[400px] overflow-y-auto" id="private-messages-container">
                    @foreach($privateMessages as $msg)
                        <div class="mb-4 {{ $msg->user_id === auth()->id() ? 'text-right' : '' }}">
                            <strong>{{ $msg->user->name }}:</strong>
                            <span>{{ $msg->message }}</span><br>
                            <small class="text-gray-500">{{ $msg->created_at->diffForHumans() }}</small>
                        </div>
                        <hr>
                    @endforeach
                </div>

                <!-- Form -->
                <div class="p-6 border-t border-gray-200 bg-gray-50">
                    <form id="private-chat-form" method="POST" action="{{ route('private.chat.send', $recipient->id) }}">
                        @csrf
                        <div class="flex">
                            <input
                                type="text"
                                name="message"
                                class="flex-1 border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring focus:border-blue-300"
                                placeholder="Type a private message..."
                                required
                            >
                            <button
                                type="submit"
                                class="bg-purple-500 hover:bg-purple-600 text-white font-semibold px-4 py-2 rounded-r-md"
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

<script>
document.getElementById('private-chat-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const url = form.action;
    const messageInput = form.querySelector('input[name="message"]');
    const message = messageInput.value;
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const messagesContainer = document.getElementById('private-messages-container');

    if (!message.trim()) return; // do not send empty messages

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ message: message })
    })
    .then(response => {
        if (!response.ok) throw new Error('Network error');
        return response.json();
    })
    .then(data => {
        // Clear input
        messageInput.value = '';

        // Append new message to container
        const newMessageHTML = `
            <div class="mb-4 text-right">
                <strong>${data.message.user.name}:</strong>
                <span>${data.message.message}</span><br>
                <small class="text-gray-500">just now</small>
            </div>
            <hr>
        `;
        messagesContainer.insertAdjacentHTML('beforeend', newMessageHTML);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to send message.');
    });
});
</script>

