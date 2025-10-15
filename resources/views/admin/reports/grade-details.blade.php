@extends('layouts.app')

@section('content')
<div class="content-card">
<div class="container mx-auto py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Grade Details</h2>
        <div class="mb-4">
            <strong>Student Name:</strong> {{ $grade->student_name }}<br>
            <strong>Year Level:</strong> {{ $grade->year_level }}<br>
            <strong>Semester:</strong> {{ $grade->semester }}<br>
        </div>
        <div class="mb-4">
            <strong>Subjects:</strong>
            <table class="min-w-full border">
                <thead>
                    <tr>
                        <th class="border px-2 py-1">Subject</th>
                        <th class="border px-2 py-1">Grade</th>
                        <th class="border px-2 py-1">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grade->subjects as $subject)
                        <tr>
                            <td class="border px-2 py-1">{{ $subject['subject'] }}</td>
                            <td class="border px-2 py-1">{{ $subject['grade'] }}</td>
                            <td class="border px-2 py-1">{{ $subject['remarks'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($grade->proof_url)
            <div class="mb-4 no-print">
                <strong>Proof File:</strong>
                <a href="{{ asset('storage/' . $grade->proof_url) }}" target="_blank" class="text-blue-600 underline">View Proof</a>
            </div>
        @endif
        
        <div class="mt-6 flex gap-3 no-print">
            <button onclick="window.print()" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1 0 001-1v-4a1 1 0 00-1-1H9a1 1 0 00-1 1v4a1 1 0 001 1zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print Report
            </button>
            <a href="{{ url('/admin/reports/grades') }}" class="inline-block px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Back to Grades List</a>
        </div>
    </div>
</div>
</div>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        background: white !important;
        color: black !important;
    }
    
    .container {
        max-width: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .bg-white {
        box-shadow: none !important;
    }
    
    .rounded-lg {
        border-radius: 0 !important;
    }
    
    table {
        page-break-inside: auto;
        border-collapse: collapse;
        width: 100%;
    }
    
    th, td {
        border: 1px solid #000 !important;
        padding: 8px !important;
        text-align: left;
    }
    
    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
    
    .mb-4 {
        margin-bottom: 1rem !important;
    }
    
    strong {
        font-weight: bold !important;
    }
}


</style>

@endsection
