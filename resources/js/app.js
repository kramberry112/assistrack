import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();


import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Insert your actual Pusher app key and cluster below
window.PUSHER_APP_KEY = 'eba69cf76b183d503f57';
window.PUSHER_APP_CLUSTER = 'ap1'; 

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: window.PUSHER_APP_KEY,
    cluster: window.PUSHER_APP_CLUSTER || 'mt1',
    forceTLS: true,
});
