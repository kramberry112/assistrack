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
            })
            .listen('StudentTaskStepUpdated', function(e) {
                console.log('StudentTaskStepUpdated received in office:', e);
                
                // Find and update the progress bar for this task
                const progressText = document.querySelector(`.progress-text[data-task-id="${e.taskId}"]`);
                if (progressText) {
                    // Update percentage text
                    progressText.textContent = e.percentage + '%';
                    
                    // Find and update progress bar
                    const progressBar = progressText.closest('td').querySelector('div[style*="background:#10b981"]');
                    if (progressBar) {
                        progressBar.style.width = e.percentage + '%';
                    }
                    
                    console.log('Progress updated for task:', e.taskId, 'to', e.percentage + '%');
                }
            });
    }
});
