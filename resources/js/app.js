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

// Listen for StudentTaskRejected event and disable the Start button
window.Echo.channel('student-tasks')
    .listen('StudentTaskRejected', (e) => {
        console.log('StudentTaskRejected event received:', e);
        // Find the task card by taskId
        if (window.currentUserId && e.userId == window.currentUserId) {
            const cards = document.querySelectorAll('.task-card');
            cards.forEach(function(card) {
                let startBtn = card.querySelector('.task-action.start') || card.querySelector('.start-task-btn');
                if (startBtn && (startBtn.getAttribute('data-id') == e.taskId || card.getAttribute('data-task-id') == e.taskId)) {
                    console.log('Disabling Start button for rejected task:', e.taskId, startBtn);
                    startBtn.setAttribute('disabled', 'disabled');
                    startBtn.style.background = '#e5e7eb';
                    startBtn.style.color = '#888';
                    startBtn.style.cursor = 'not-allowed';
                    startBtn.textContent = 'Start (Rejected)';
                    const badge = card.querySelector('.status-badge');
                    if (badge) {
                        badge.textContent = 'Rejected';
                        badge.className = 'status-badge';
                        badge.style.background = '#fee2e2';
                        badge.style.color = '#b91c1c';
                    }
                }
            });
            
            // Trigger custom event for dashboard updates
            window.dispatchEvent(new CustomEvent('task-rejected', { detail: { taskId: e.taskId } }));
        } else {
            console.log('StudentTaskRejected event ignored: userId mismatch or missing window.currentUserId', e);
        }
    });
console.log('StudentTaskRejected event handler attached.');

// Listen for Community Join Request notifications
window.Echo.private(`App.Models.User.${window.currentUserId}`)
    .notification((notification) => {
        console.log('Community notification received:', notification);
        
        if (notification.type.includes('JoinRequest')) {
            // Update notification count and content
            if (window.updateNotificationCount) {
                window.updateNotificationCount();
            }
            
            // Show a toast notification
            const isAccepted = notification.type.includes('Accepted');
            const message = isAccepted 
                ? `🎉 Join request accepted for "${notification.group_name}"!`
                : `❌ Join request rejected for "${notification.group_name}"`;
            
            showCommunityToast(message, isAccepted ? 'success' : 'error');
        }
    });

function showCommunityToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.textContent = message;
    toast.style.position = 'fixed';
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.background = type === 'success' ? '#10b981' : (type === 'error' ? '#ef4444' : '#3b82f6');
    toast.style.color = '#fff';
    toast.style.padding = '12px 24px';
    toast.style.borderRadius = '8px';
    toast.style.fontWeight = '600';
    toast.style.fontSize = '0.9rem';
    toast.style.zIndex = '10000';
    toast.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
    toast.style.maxWidth = '300px';
    toast.style.wordWrap = 'break-word';
    
    document.body.appendChild(toast);
    
    // Auto remove after 4 seconds
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}

console.log('Community notification handlers attached.');
