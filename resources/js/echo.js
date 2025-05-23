import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

window.Echo.channel('chat-channel')
    .listen('.message.sent', (e) => {
        console.log('Received message:', e.message);

        const newMessageHTML = `
            <div class="mb-4">
                <strong>${e.message.user.name}:</strong>
                <span>${e.message.message}</span><br>
                <small class="text-gray-500">just now</small>
            </div>
            <hr>
        `;

        const container = document.getElementById('messages-container');
        container.insertAdjacentHTML('beforeend', newMessageHTML);
        container.scrollTop = container.scrollHeight;
    });
    
const currentUserId = Number(document.querySelector('meta[name="user-id"]').content);

window.Echo.private(`chat.user.${currentUserId}`)
    .listen('.private-message', (e) => {
        if (e.sender.id === currentUserId) return; // Ignore own message (already added)

        const container = document.getElementById('private-messages-container');

        const newMessageHTML = `
            <div class="mb-4">
                <strong>${e.sender.name}:</strong>
                <span>${e.message.message}</span><br>
                <small class="text-gray-500">just now</small>
            </div>
            <hr>
        `;

        container.insertAdjacentHTML('beforeend', newMessageHTML);
        container.scrollTop = container.scrollHeight;
    });