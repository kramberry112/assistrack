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
                if (typeof fetchTasks === 'function') {
                    fetchTasks();
                }
            });
    }
});
