import axios from 'axios';
window.axios = axios;
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});
window.Echo.channel('video')
    .listen('VideoEvent', (event) => {
        const notificationsContainer = document.getElementById('notifications');
        if (notificationsContainer) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.innerText = `New video created: ${event.video.title}`;
            notificationsContainer.prepend(notification);
        }
    });
