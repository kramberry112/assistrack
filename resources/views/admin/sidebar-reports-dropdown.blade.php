<li style="list-style:none; margin:0; padding:0;">
    <div id="reportsDropdownToggle" style="display:flex;align-items:center;gap:10px;padding:12px 20px;cursor:pointer;user-select:none;">
        <span class="icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                <line x1="9" y1="9" x2="15" y2="9"/>
                <line x1="9" y1="15" x2="15" y2="15"/>
            </svg>
        </span>
        <span style="font-size:0.95rem;font-weight:500;color:#374151;">Reports</span>
        <svg id="reportsDropdownArrow" width="16" height="16" style="margin-left:auto;transition:transform 0.2s;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </div>
    <ul id="reportsDropdownMenu" style="display:none;flex-direction:column;padding-left:32px;padding-bottom:8px;">
        <li><a href="/admin/reports/attendance" class="report-link" data-section="attendance" style="display:block;padding:8px 0;color:#374151;text-decoration:none;font-size:0.95rem;">Attendance</a></li>
        <li><a href="/admin/reports/evaluation" class="report-link" data-section="evaluation" style="display:block;padding:8px 0;color:#374151;text-decoration:none;font-size:0.95rem;">Evaluation</a></li>
        <li><a href="/admin/reports/tasks" class="report-link" data-section="tasks" style="display:block;padding:8px 0;color:#374151;text-decoration:none;font-size:0.95rem;">Tasks</a></li>
    </ul>
</li>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('reportsDropdownToggle');
    const menu = document.getElementById('reportsDropdownMenu');
    const arrow = document.getElementById('reportsDropdownArrow');
    let expanded = false;
    toggle.addEventListener('click', function(e) {
        expanded = !expanded;
        menu.style.display = expanded ? 'flex' : 'none';
        arrow.style.transform = expanded ? 'rotate(180deg)' : 'rotate(0deg)';
    });
    // Collapse when clicking outside
    document.addEventListener('click', function(e) {
        if (!toggle.contains(e.target) && !menu.contains(e.target)) {
            menu.style.display = 'none';
            arrow.style.transform = 'rotate(0deg)';
            expanded = false;
        }
    });

    // Show selected section, keep sidebar visible
    document.querySelectorAll('.report-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            // No sidebar hide
            // Load the chosen section
            // Use default navigation
        });
    });
});
</script>
