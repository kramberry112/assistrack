@extends('layouts.app')

@section('content')
<style>


        /* Page Header */
        .page-header {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 20px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2563eb;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
            height: 100%;
        }



        /* Calendar Styles */
        .calendar-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 24px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 32px;
            border-bottom: 1px solid #e5e7eb;
            background: white;
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-button {
            width: 36px;
            height: 36px;
            border: none;
            background: #f3f4f6;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .nav-button:hover {
            background: #e5e7eb;
        }

        .current-month {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin: 0 20px;
        }

        .view-toggles {
            display: flex;
            gap: 8px;
        }

        .view-toggle {
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .view-toggle.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .view-toggle:hover:not(.active) {
            background: #f9fafb;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }

        .calendar-header-cell {
            padding: 16px 8px;
            text-align: center;
            font-weight: 600;
            font-size: 0.875rem;
            color: #374151;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .calendar-cell {
            min-height: 120px;
            border-bottom: 1px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
            padding: 12px 8px;
            position: relative;
            background: white;
            transition: background 0.2s;
        }

        .calendar-cell:hover {
            background: #f9fafb;
        }

        .calendar-cell:nth-child(7n) {
            border-right: none;
        }

        .calendar-date {
            font-size: 0.875rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .calendar-cell.other-month .calendar-date {
            color: #9ca3af;
        }

        .calendar-cell.today {
            background: #fef3c7;
        }

        .calendar-cell.today .calendar-date {
            color: #d97706;
            background: #fbbf24;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .calendar-events {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .calendar-event {
            font-size: 0.75rem;
            padding: 2px 6px;
            border-radius: 3px;
            background: #dbeafe;
            color: #1e40af;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .calendar-event.event-red {
            background: #fee2e2;
            color: #dc2626;
        }

        .calendar-event.event-green {
            background: #dcfce7;
            color: #16a34a;
        }

        .calendar-event.event-purple {
            background: #f3e8ff;
            color: #9333ea;
        }

        /* Week view styles */
        .week-view {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 16px 24px;
            margin: 24px;
        }

        .week-row {
            border: 2px solid #222;
            border-radius: 4px;
            margin-bottom: 8px;
            background: #fff;
            min-height: 80px;
            display: flex;
            align-items: flex-start;
        }

        .week-day {
            font-size: 1.1rem;
            font-weight: 500;
            color: #222;
            padding: 12px;
            flex: 1;
        }
    </style>

<!-- Header -->
    <div class="page-header">
        <div style="display:flex;align-items:center;justify-content:space-between;width:100%;">
            <div class="header-title" style="display:flex;align-items:center;gap:16px;">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2d2e83" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <h1 style="font-size:1.5rem;font-weight:700;color:#2563eb;letter-spacing:0.5px;">CALENDAR</h1>
            </div>
        </div>
    </div>            <!-- Calendar Container -->
            <div class="calendar-container">
                <div class="calendar-header">
                    <div class="calendar-nav">
                        <button class="nav-button" id="prevMonth">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>
                        <button class="nav-button" id="nextMonth">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                        <h2 class="current-month" id="currentMonth">January 2024</h2>
                    </div>
                    <div class="view-toggles">
                        <button class="view-toggle" id="weekToggle">Week</button>
                        <button class="view-toggle active" id="monthToggle">Month</button>
                    </div>
                </div>

                <div class="calendar-grid" id="calendarGrid">
                    <!-- Month view will be rendered here by JS -->
                </div>
                <div class="week-view" id="weekView" style="display:none;">
                    <!-- Week view will be rendered by JS -->
                </div>
            </div>

    <script>
        // Calendar functionality
        document.addEventListener('DOMContentLoaded', function() {

        });

        // Calendar functionality with week/month toggle
        class Calendar {
            constructor() {
                this.currentDate = new Date();
                this.currentMonth = this.currentDate.getMonth();
                this.currentYear = this.currentDate.getFullYear();
                this.today = new Date();
                this.view = 'month';
                this.months = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
                this.events = {};
                this.init();
                this.fetchTasks();
            }

            fetchTasks() {
                fetch('/student-tasks/month?year=' + this.currentYear + '&month=' + (this.currentMonth + 1))
                    .then(response => response.json())
                    .then(data => {
                        this.events = {};
                        data.forEach(task => {
                            const key = task.due_date;
                            if (!this.events[key]) this.events[key] = [];
                            this.events[key].push({
                                title: task.title + ' [' + task.priority.charAt(0).toUpperCase() + task.priority.slice(1) + ']',
                                type: this.getPriorityClass(task.priority)
                            });
                        });
                        this.render();
                    });
            }

            getPriorityClass(priority) {
                if (priority === 'critical') return 'event-red';
                if (priority === 'medium') return 'event-green';
                if (priority === 'not_urgent') return 'event-purple';
                return 'event-blue';
            }

            init() {
                this.render();
                this.bindEvents();
            }

            bindEvents() {
                document.getElementById('prevMonth').addEventListener('click', () => {
                    this.currentMonth--;
                    if (this.currentMonth < 0) {
                        this.currentMonth = 11;
                        this.currentYear--;
                    }
                    this.fetchTasks();
                });

                document.getElementById('nextMonth').addEventListener('click', () => {
                    this.currentMonth++;
                    if (this.currentMonth > 11) {
                        this.currentMonth = 0;
                        this.currentYear++;
                    }
                    this.fetchTasks();
                });

                document.getElementById('weekToggle').addEventListener('click', () => {
                    this.view = 'week';
                    document.getElementById('weekToggle').classList.add('active');
                    document.getElementById('monthToggle').classList.remove('active');
                    this.render();
                });

                document.getElementById('monthToggle').addEventListener('click', () => {
                    this.view = 'month';
                    document.getElementById('monthToggle').classList.add('active');
                    document.getElementById('weekToggle').classList.remove('active');
                    this.render();
                });
            }

            render() {
                const monthYear = `${this.months[this.currentMonth]} ${this.currentYear}`;
                document.getElementById('currentMonth').textContent = monthYear;
                if (this.view === 'month') {
                    document.getElementById('calendarGrid').style.display = '';
                    document.getElementById('weekView').style.display = 'none';
                    this.renderMonth();
                } else {
                    document.getElementById('calendarGrid').style.display = 'none';
                    document.getElementById('weekView').style.display = '';
                    this.renderWeek();
                }
            }

            renderMonth() {
                const firstDay = new Date(this.currentYear, this.currentMonth, 1);
                const startDate = new Date(firstDay);
                startDate.setDate(startDate.getDate() - firstDay.getDay());
                const calendarGrid = document.getElementById('calendarGrid');
                calendarGrid.innerHTML = '';

                const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                for (let d = 0; d < 7; d++) {
                    const header = document.createElement('div');
                    header.className = 'calendar-header-cell';
                    header.textContent = days[d];
                    calendarGrid.appendChild(header);
                }

                for (let week = 0; week < 6; week++) {
                    for (let day = 0; day < 7; day++) {
                        const cellDate = new Date(startDate);
                        cellDate.setDate(startDate.getDate() + (week * 7) + day);
                        const cell = this.createCalendarCell(cellDate);
                        calendarGrid.appendChild(cell);
                    }
                }
            }

            async renderWeek() {
                const weekView = document.getElementById('weekView');
                weekView.innerHTML = '';
                const today = new Date(this.currentYear, this.currentMonth, this.currentDate.getDate());
                let weekStart = new Date(today);
                weekStart.setDate(today.getDate() - ((today.getDay() + 6) % 7));
                let weekEnd = new Date(weekStart);
                weekEnd.setDate(weekStart.getDate() + 6);

                const startStr = `${weekStart.getFullYear()}-${weekStart.getMonth() + 1}-${weekStart.getDate()}`;
                const endStr = `${weekEnd.getFullYear()}-${weekEnd.getMonth() + 1}-${weekEnd.getDate()}`;

                let weekTasks = {};
                await fetch(`/student-tasks/week?start=${startStr}&end=${endStr}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(task => {
                            if (!weekTasks[task.due_date]) weekTasks[task.due_date] = [];
                            weekTasks[task.due_date].push({
                                title: task.title + ' [' + task.priority.charAt(0).toUpperCase() + task.priority.slice(1) + ']',
                                type: this.getPriorityClass(task.priority)
                            });
                        });
                    });

                const days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
                for (let i = 0; i < 7; i++) {
                    const row = document.createElement('div');
                    row.className = 'week-row';
                    const dayCell = document.createElement('div');
                    dayCell.className = 'week-day';
                    dayCell.textContent = days[i];

                    let d = new Date(weekStart);
                    d.setDate(weekStart.getDate() + i);
                    const eventKey = `${d.getFullYear()}-${d.getMonth() + 1}-${d.getDate()}`;
                    
                    if (weekTasks[eventKey]) {
                        const eventsDiv = document.createElement('div');
                        eventsDiv.className = 'calendar-events';
                        weekTasks[eventKey].forEach(event => {
                            const eventDiv = document.createElement('div');
                            eventDiv.className = `calendar-event ${event.type}`;
                            eventDiv.textContent = event.title;
                            eventsDiv.appendChild(eventDiv);
                        });
                        dayCell.appendChild(eventsDiv);
                    }
                    row.appendChild(dayCell);
                    weekView.appendChild(row);
                }
            }

            createCalendarCell(date) {
                const cell = document.createElement('div');
                cell.className = 'calendar-cell';
                const isCurrentMonth = date.getMonth() === this.currentMonth;
                const isToday = date.toDateString() === this.today.toDateString();

                if (!isCurrentMonth) {
                    cell.classList.add('other-month');
                }
                if (isToday) {
                    cell.classList.add('today');
                }

                const dateDiv = document.createElement('div');
                dateDiv.className = 'calendar-date';
                dateDiv.textContent = date.getDate().toString().padStart(2, '0');
                cell.appendChild(dateDiv);

                const eventKey = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
                if (this.events[eventKey]) {
                    const eventsDiv = document.createElement('div');
                    eventsDiv.className = 'calendar-events';
                    this.events[eventKey].forEach(event => {
                        const eventDiv = document.createElement('div');
                        eventDiv.className = `calendar-event ${event.type}`;
                        eventDiv.textContent = event.title;
                        eventsDiv.appendChild(eventDiv);
                    });
                    cell.appendChild(eventsDiv);
                }
                return cell;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            new Calendar();
        });
    </script>

@endsection