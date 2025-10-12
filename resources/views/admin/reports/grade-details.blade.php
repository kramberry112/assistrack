@extends('layouts.app')

@section('content')
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
            <div class="mb-4">
                <strong>Proof File:</strong>
                <a href="{{ asset('storage/' . $grade->proof_url) }}" target="_blank" class="text-blue-600 underline">View Proof</a>
            </div>
        @endif
    <a href="{{ url('/admin/reports/grades') }}" class="inline-block mt-4 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Back to Grades List</a>
    </div>
</div>
@endsection
