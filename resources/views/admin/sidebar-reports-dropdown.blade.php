<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <style>
        .parent-toggle:hover {
            background-color: #F3F4F6;
        }

        .nav-treeview .nav-link:hover {
            background-color: #F3F4F6;
        }

        .nav-treeview .nav-link.active {
            background-color: #EFF6FF;
            color: #2563EB;
            font-weight: 500;
        }

        .nav-item {
            list-style: none;
        }
    </style>
</head>
<body>

<li class="nav-item">
    <a href="#" class="nav-link parent-toggle" style="display: flex; align-items: center; padding: 12px 20px; color: #374151; text-decoration: none; transition: background-color 0.2s;">
        <i class="nav-icon bi bi-file-earmark-text" style="margin-right: 12px; font-size: 1.25rem;"></i>
        <p class="parent-label" style="margin: 0; font-size: 0.95rem; font-weight: bold; flex: 1;">Reports</p>
        <i class="nav-arrow bi bi-chevron-right" style="font-size: 0.75rem; transition: transform 0.3s;"></i>
    </a>
    <ul class="nav nav-treeview" style="display:none; list-style: none; padding: 0; margin: 0;">
        <li class="nav-item">
            <a href="#" class="nav-link report-link" data-url="/admin/reports/attendance" data-name="Attendance" style="display: flex; align-items: center; padding: 10px 20px 10px 52px; color: #6B7280; text-decoration: none; transition: background-color 0.2s;">
                <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Attendance</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link report-link" data-url="/admin/reports/evaluation" data-name="Evaluation" style="display: flex; align-items: center; padding: 10px 20px 10px 52px; color: #6B7280; text-decoration: none; transition: background-color 0.2s;">
                <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Evaluation</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link report-link" data-url="/admin/reports/tasks" data-name="Tasks" style="display: flex; align-items: center; padding: 10px 20px 10px 52px; color: #6B7280; text-decoration: none; transition: background-color 0.2s;">
                <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Tasks</p>
            </a>
        </li>
    </ul>
</li>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const parentToggle = document.querySelector('.parent-toggle');
    const parentLabel = document.querySelector('.parent-label');
    const treeview = document.querySelector('.nav-treeview');
    const arrow = document.querySelector('.nav-arrow');
    
    // Handle parent dropdown toggle
    if (parentToggle) {
        parentToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (treeview) {
                const isVisible = treeview.style.display !== 'none';
                if (isVisible) {
                    treeview.style.display = 'none';
                    if (arrow) arrow.style.transform = 'rotate(0deg)';
                } else {
                    treeview.style.display = 'block';
                    if (arrow) arrow.style.transform = 'rotate(90deg)';
                }
            }
        });
    }

    // Handle report links - prevent page reload and load content dynamically
    document.querySelectorAll('.report-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const url = this.getAttribute('data-url');
            const name = this.getAttribute('data-name');
            
            // Update parent label to show selected report
            if (parentLabel) {
                parentLabel.textContent = name;
            }
            
            // Close dropdown after selection
            if (treeview) {
                treeview.style.display = 'none';
            }
            if (arrow) {
                arrow.style.transform = 'rotate(0deg)';
            }
            
            // Load content via fetch without refreshing the page
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const contentArea = document.getElementById('mainContent');
                    if (contentArea) {
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;
                        const inner = tempDiv.querySelector('#mainContent');
                        
                        let loaded = false;
                        try {
                            if (inner) {
                                contentArea.innerHTML = inner.innerHTML;
                                loaded = true;
                            }
                        } catch (err) {
                            console.error('Error extracting content:', err);
                        }
                        
                        if (!loaded) {
                            contentArea.innerHTML = html;
                        }
                    }
                    
                    // Update browser URL without reload
                    history.pushState({path: url, name: name}, '', url);
                    
                    // Update active state
                    document.querySelectorAll('.report-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    window.location.href = url;
                });
        });
    });
    
    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(e) {
        if (e.state) {
            const path = e.state.path;
            const name = e.state.name;
            
            // Update parent label
            if (parentLabel && name) {
                parentLabel.textContent = name;
            } else if (parentLabel) {
                parentLabel.textContent = 'Reports';
            }
            
            if (path) {
                fetch(path)
                    .then(response => response.text())
                    .then(html => {
                        const contentArea = document.getElementById('mainContent');
                        if (contentArea) {
                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = html;
                            const inner = tempDiv.querySelector('#mainContent');
                            contentArea.innerHTML = inner ? inner.innerHTML : html;
                        }
                    })
                    .catch(() => location.reload());
            }
        }
    });
});
</script>

</body>
</html>