import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();


import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
console.log('Initializing Echo and Pusher...');

// Insert your actual Pusher app key and cluster below
window.PUSHER_APP_KEY = 'eba69cf76b183d503f57'; // Use your actual key from .env
window.PUSHER_APP_CLUSTER = 'ap1';

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: window.PUSHER_APP_KEY,
    cluster: window.PUSHER_APP_CLUSTER || 'mt1',
    forceTLS: true,
});
console.log('Echo initialized, subscribing to channel student-tasks...');
    // --- CSRF token global setup for fetch ---
    // Patch fetch to always include CSRF token for POST, PUT, DELETE
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
        const _fetch = window.fetch;
        window.fetch = function(input, init = {}) {
            if (init.method && ['POST','PUT','DELETE'].includes(init.method.toUpperCase())) {
                init.headers = Object.assign({}, init.headers, {
                    'X-CSRF-TOKEN': csrfToken
                });
            }
            return _fetch(input, init);
        };
    }
    // --- End CSRF token global setup ---

// Listen for StudentTaskVerified event and enable the Start button
window.Echo.channel('student-tasks')
    .listen('StudentTaskVerified', (e) => {
        console.log('StudentTaskVerified event received:', e);
        // Find the task card by taskId
        if (window.currentUserId && e.userId == window.currentUserId) {
            const cards = document.querySelectorAll('.task-card');
            cards.forEach(function(card) {
                let startBtn = card.querySelector('.task-action.start') || card.querySelector('.start-task-btn');
                if (startBtn && (startBtn.getAttribute('data-id') == e.taskId || card.getAttribute('data-task-id') == e.taskId)) {
                    console.log('Enabling Start button for task:', e.taskId, startBtn);
                    startBtn.removeAttribute('disabled');
                    startBtn.removeAttribute('style');
                    startBtn.setAttribute('data-verified', '1');
                    startBtn.style.background = '#22c55e';
                    startBtn.style.color = '#fff';
                    startBtn.style.cursor = 'pointer';
                    const badge = card.querySelector('.status-badge');
                    if (badge) {
                        badge.textContent = 'Verified';
                        badge.className = 'status-badge status-completed';
                    }
                }
            });
        } else {
            console.log('StudentTaskVerified event ignored: userId mismatch or missing window.currentUserId', e);
        }
    });
console.log('StudentTaskVerified event handler attached.');
