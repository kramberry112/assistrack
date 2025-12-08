@extends('layouts.app')

@section('page-title')
    <i class="bi bi-graph-up-arrow" style="margin-right: 8px;"></i>
    Evaluation Report
@endsection

@section('content')
<style>
    /* Prevent horizontal scroll */
    * {
        box-sizing: border-box;
    }
    
    html, body {
        overflow-x: hidden;
        max-width: 100vw;
    }
    
    .content-wrapper {
        background: #fff !important;
    }
    .admin-content-wrapper {
        background: #fff !important;
    }
    
    /* Hide mobile cards by default */
    .mobile-evaluation-cards {
        display: none;
    }
    
    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        /* Container adjustments */
        div[style*="padding: 24px"] {
            padding: 8px !important;
            max-width: 100vw !important;
            overflow: hidden !important;
        }
        
        .main-content-card {
            padding: 16px !important;
            margin: 0 !important;
            border-radius: 8px !important;
            width: 100% !important;
            max-width: 100% !important;
            overflow: hidden !important;
        }
        
        /* Hide table on mobile */
        .reports-table {
            display: none !important;
        }
        
        /* Show mobile cards instead */
        .mobile-evaluation-cards {
            display: block !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        .evaluation-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }
        
        .evaluation-card-header {
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .evaluation-card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 4px 0;
            word-wrap: break-word;
        }
        
        .evaluation-card-subtitle {
            font-size: 0.8rem;
            color: #6b7280;
            margin: 0;
        }
        
        .evaluation-card-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .evaluation-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
        }
        
        .evaluation-detail-label {
            font-size: 0.8rem;
            color: #6b7280;
            font-weight: 500;
            flex-shrink: 0;
        }
        
        .evaluation-detail-value {
            font-size: 0.85rem;
            color: #111827;
            font-weight: 600;
            text-align: right;
            word-wrap: break-word;
            max-width: 60%;
        }
        
        /* View button mobile adjustments */
        .evaluation-card a {
            margin-top: 8px !important;
            padding: 10px 16px !important;
            font-size: 0.85rem !important;
        }
    }
    
    /* Ultra mobile (small phones) */
    @media (max-width: 480px) {
        div[style*="padding: 24px"] {
            padding: 4px !important;
        }
        
        .main-content-card {
            padding: 12px !important;
        }
        
        .evaluation-card {
            padding: 12px !important;
            margin-bottom: 8px !important;
        }
        
        .evaluation-card-title {
            font-size: 0.9rem !important;
        }
        
        .evaluation-card-subtitle {
            font-size: 0.75rem !important;
        }
        
        .evaluation-detail-label,
        .evaluation-detail-value {
            font-size: 0.75rem !important;
        }
        
        .evaluation-card a {
            padding: 8px 12px !important;
            font-size: 0.8rem !important;
        }
    }
</style>
<div style="padding: 24px; background: #fff; min-height: calc(100vh - 76px);">

<style>
    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #7c3aed;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .main-content-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .reports-table {
        width: 100%;
        border-collapse: collapse;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    
    .reports-table thead tr {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .reports-table th {
        padding: 18px 16px;
        text-align: left;
        font-weight: 600;
        color: #ffffff;
        font-size: 14px;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .reports-table th:first-child {
        border-top-left-radius: 8px;
    }

    .reports-table th:last-child {
        border-top-right-radius: 8px;
    }
    
    .reports-table tbody tr {
        border-bottom: 1px solid #e9ecef;
        transition: background-color 0.2s ease;
    }

    .reports-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .reports-table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .reports-table td {
        padding: 18px 16px;
        color: #495057;
        font-size: 14px;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .empty-state-text {
        font-size: 16px;
        font-weight: 500;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        margin-right: 4px;
    }

    .btn-primary {
        background: #6366f1;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: #4f46e5;
    }

    .btn-warning {
        background: #f59e0b;
        color: #ffffff;
    }

    .btn-warning:hover {
        background: #d97706;
    }

    .btn-danger {
        background: #ef4444;
        color: #ffffff;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .btn-sm {
        padding: 4px 8px;
        font-size: 11px;
    }
</style>

    <!-- Filter Bar -->
    <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 20px;">
        <button onclick="toggleFilters()" class="filter-btn" style="display: flex; align-items: center; gap: 6px; background: #6366f1; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 500;">
            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            Filters
        </button>
    </div>
    
    <!-- Filter Panel -->
    <div id="filterPanel" style="display: none; background: #f8f9fa; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
            <div>
                <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Office</label>
                <select id="officeFilter" onchange="applyFilters()" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
                    <option value="">All Offices</option>
                    <option value="ACADS">ACADS</option>
                    <option value="ALUMNI OFFICE">ALUMNI OFFICE</option>
                    <option value="ARCHIVING">ARCHIVING</option>
                    <option value="ARZATECH">ARZATECH</option>
                    <option value="CANTEEN">CANTEEN</option>
                    <option value="CLINIC">CLINIC</option>
                    <option value="FINANCE">FINANCE</option>
                    <option value="GUIDANCE">GUIDANCE</option>
                    <option value="HRD">HRD</option>
                    <option value="KUWAGO">KUWAGO</option>
                    <option value="LCR">LCR</option>
                    <option value="LIBRARY">LIBRARY</option>
                    <option value="LINKAGES">LINKAGES</option>
                    <option value="MARKETING">MARKETING</option>
                    <option value="OPEN LAB">OPEN LAB</option>
                    <option value="PRESIDENT'S OFFICE">PRESIDENT'S OFFICE</option>
                    <option value="QUEUING">QUEUING</option>
                    <option value="QUALITY ASSURANCE">QUALITY ASSURANCE</option>
                    <option value="REGISTRAR">REGISTRAR</option>
                    <option value="SAO">SAO</option>
                    <option value="SBA FACULTY">SBA FACULTY</option>
                    <option value="SIHM FACULTY">SIHM FACULTY</option>
                    <option value="SITE FACULTY">SITE FACULTY</option>
                    <option value="SOE FACULTY">SOE FACULTY</option>
                    <option value="SOH FACULTY">SOH FACULTY</option>
                    <option value="SOHS FACULTY">SOHS FACULTY</option>
                    <option value="SOC FACULTY">SOC FACULTY</option>
                    <option value="SPORTS AND CULTURE">SPORTS AND CULTURE</option>
                    <option value="STE DEAN'S OFFICE">STE DEAN'S OFFICE</option>
                    <option value="STE FACULTY">STE FACULTY</option>
                    <option value="STEEDS">STEEDS</option>
                    <option value="XACTO">XACTO</option>
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px;">Search</label>
                <input type="text" id="searchFilter" oninput="applyFilters()" placeholder="Search by name or ID..." style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px;">
            </div>
            <div style="display: flex; align-items: flex-end;">
                <button onclick="clearFilters()" style="background: #6b7280; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; width: 100%;">
                    Clear Filters
                </button>
            </div>
        </div>
    </div>

    <table class="reports-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Office</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($evaluations as $evaluation)
                <tr>
                    <td>
                        <div class="text-sm font-medium text-gray-900">
                            {{ $evaluation->student->student_name ?? 'N/A' }}
                        </div>
                        <div class="text-xs text-gray-500">
                            Student ID: {{ $evaluation->student->id_number ?? 'N/A' }}
                        </div>
                    </td>
                    <td>
                        <span class="text-sm text-gray-700">{{ $evaluation->department }}</span>
                        <div class="text-xs text-gray-500">
                            Evaluated by: {{ $evaluation->evaluator->name ?? 'Unknown' }}
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.evaluations.view', $evaluation->id) }}" class="btn btn-primary btn-sm">
                            <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View
                        </a>
                        <div class="text-xs text-gray-500 mt-1">
                            Avg: {{ $evaluation->average_rating }}/5
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="empty-state">
                            <div class="empty-state-icon">📊</div>
                            <div class="empty-state-text">No evaluation records found</div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div id="noResultsMessage" style="display: none; padding: 48px 20px; text-align: center; color: #9ca3af; background: white;">
        <svg style="width: 48px; height: 48px; margin: 0 auto 16px; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <p style="font-size: 16px; font-weight: 500;">No matching records found</p>
        <p style="font-size: 14px; color: #6b7280; margin-top: 8px;">Try adjusting your filters</p>
    </div>
    
    <!-- Mobile Cards View -->
    <div class="mobile-evaluation-cards">
        @forelse($evaluations as $evaluation)
            <div class="evaluation-card">
                <div class="evaluation-card-header">
                    <h3 class="evaluation-card-title">{{ $evaluation->student->student_name ?? 'N/A' }}</h3>
                    <p class="evaluation-card-subtitle">Student ID: {{ $evaluation->student->id_number ?? 'N/A' }}</p>
                </div>
                
                <div class="evaluation-card-details">
                    <div class="evaluation-detail-item">
                        <span class="evaluation-detail-label">Department</span>
                        <span class="evaluation-detail-value">{{ $evaluation->department }}</span>
                    </div>
                    
                    <div class="evaluation-detail-item">
                        <span class="evaluation-detail-label">Evaluated by</span>
                        <span class="evaluation-detail-value">{{ $evaluation->evaluator->name ?? 'Unknown' }}</span>
                    </div>
                    
                    <div class="evaluation-detail-item">
                        <span class="evaluation-detail-label">Average Rating</span>
                        <span class="evaluation-detail-value">
                            <span style="display: inline-block; padding: 4px 12px; background: #d1fae5; color: #065f46; border-radius: 12px; font-size: 0.8rem; font-weight: 600;">
                                Avg: {{ $evaluation->average_rating }}/5
                            </span>
                        </span>
                    </div>
                    
                    <a href="{{ route('admin.evaluations.view', $evaluation->id) }}" 
                       style="display: inline-flex; align-items: center; justify-content: center; gap: 6px; padding: 12px 20px; background: #6366f1; color: white; border-radius: 8px; text-decoration: none; font-size: 0.9rem; font-weight: 500; width: 100%; margin-top: 12px;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View
                    </a>
                </div>
            </div>
        @empty
            <div class="evaluation-card">
                <div class="empty-state">
                    <div class="empty-state-icon">📊</div>
                    <div class="empty-state-text">No evaluation records found</div>
                </div>
            </div>
        @endforelse
    </div>
</div>

<script>
function toggleFilters() {
    const panel = document.getElementById('filterPanel');
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
}

function applyFilters() {
    const officeFilter = document.getElementById('officeFilter').value.toLowerCase();
    const searchFilter = document.getElementById('searchFilter').value.toLowerCase();
    
    // Filter desktop table rows
    const tableRows = document.querySelectorAll('.reports-table tbody tr');
    tableRows.forEach(row => {
        const office = row.cells[1]?.textContent.toLowerCase() || '';
        const name = row.cells[0]?.textContent.toLowerCase() || '';
        
        const officeMatch = !officeFilter || office.includes(officeFilter);
        const searchMatch = !searchFilter || name.includes(searchFilter);
        
        row.style.display = (officeMatch && searchMatch) ? '' : 'none';
    });
    
    // Check if any rows are visible
    const visibleRows = Array.from(tableRows).filter(row => row.style.display !== 'none');
    const noResultsMsg = document.getElementById('noResultsMessage');
    const table = document.querySelector('.reports-table');
    if (visibleRows.length === 0 && tableRows.length > 0) {
        if (noResultsMsg) noResultsMsg.style.display = 'block';
        if (table) table.style.display = 'none';
    } else {
        if (noResultsMsg) noResultsMsg.style.display = 'none';
        if (table) table.style.display = 'table';
    }
    
    // Filter mobile cards
    const mobileCards = document.querySelectorAll('.mobile-evaluation-cards .evaluation-card');
    mobileCards.forEach(card => {
        const office = card.querySelector('.evaluation-detail-value:nth-of-type(1)')?.textContent.toLowerCase() || '';
        const name = card.querySelector('.evaluation-card-title')?.textContent.toLowerCase() || '';
        
        const officeMatch = !officeFilter || office.includes(officeFilter);
        const searchMatch = !searchFilter || name.includes(searchFilter);
        
        card.style.display = (officeMatch && searchMatch) ? '' : 'none';
    });
}

function clearFilters() {
    document.getElementById('officeFilter').value = '';
    document.getElementById('searchFilter').value = '';
    applyFilters();
}

// Populate office dropdown with unique offices
</script>

@endsection