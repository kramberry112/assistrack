<aside class="sidebar" style="width:260px; background:#fff; border-right:1px solid #e5e7eb; display:flex; flex-direction:column; justify-content:space-between; min-height:100vh;">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
<style>
    .parent-toggle:hover { background-color: #F3F4F6; }
    .nav-treeview .nav-link:hover { background-color: #F3F4F6; }
    .nav-treeview .nav-link.active { background-color: #EFF6FF; color: #2563EB; font-weight: 500; }
    .nav-item { list-style: none; }
</style>
<ul style="padding:0; margin:0; list-style:none;">
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
        <li class="nav-item">
            <a href="#" class="nav-link report-link" data-url="/admin/reports/grades" data-name="Grades" style="display: flex; align-items: center; padding: 10px 20px 10px 52px; color: #6B7280; text-decoration: none; transition: background-color 0.2s;">
                <i class="nav-icon bi bi-circle" style="margin-right: 12px; font-size: 0.4rem;"></i>
                <p style="margin: 0; font-size: 0.95rem; font-weight: bold;">Grades</p>
            </a>
        </li>
    </ul>
</li>
</ul>
</aside>