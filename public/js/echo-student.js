document.addEventListener('DOMContentLoaded', function() {
    if (typeof window.LaravelEcho !== 'undefined') {
        window.Echo = new window.LaravelEcho({
            broadcaster: 'pusher',
            key: 'eba69cf76b183d503f57',
            cluster: 'mt1',
            forceTLS: true
        });

        window.Echo.channel('student-tasks')
            .listen('StudentTaskCreated', function(e) {
                // Only update if the current user is the owner of the task
                if (window.currentUserId && e.task.user_id == window.currentUserId) {
                    var card = document.querySelector('.task-card[data-id="' + e.task.id + '"]');
                    if (card) {
                        var startBtn = card.querySelector('.task-action.start');
                        if (startBtn) {
                            startBtn.disabled = false;
                            startBtn.style.background = '#22c55e';
                            startBtn.style.color = '#fff';
                            startBtn.style.cursor = 'pointer';
                        }
                        var badge = card.querySelector('.status-badge');
                        if (badge) {
                            badge.textContent = 'Verified';
                            badge.className = 'status-badge status-completed';
                        }
                    }
                }
            });
    }
});
