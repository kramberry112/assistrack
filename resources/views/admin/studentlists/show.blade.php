@extends('layouts.guest')

@section('title', 'Student Details')

@section('content')
<div class="min-h-screen bg-gray-100 font-sans">

    <!-- HEADER -->
    <section class="relative bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-12">
        <div class="container mx-auto px-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Student Details</h1>
                <p class="text-sm opacity-80">Universidad de Dagupan - Student Assistant Program</p>
            </div>
            <img src="/images/uddlogo.png" class="w-20 h-20 object-contain" alt="UDD Logo">
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="container mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="flex flex-col md:flex-row md:items-start gap-8">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 text-sm">Student Name</p>
                            <p class="font-medium">{{ $student->student_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Course</p>
                            <p class="font-medium">{{ $student->course }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Year Level</p>
                            <p class="font-medium">{{ $student->year_level }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Student ID</p>
                            <p class="font-medium">{{ $student->id_number }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Age</p>
                            <p class="font-medium">{{ $student->age }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Email</p>
                            <p class="font-medium">{{ $student->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Telephone</p>
                            <p class="font-medium">{{ $student->telephone }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-500 text-sm">Address</p>
                            <p class="font-medium">{{ $student->address }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-64 h-64 flex-shrink-0 relative">
                    @if($student->picture)
                        <img src="{{ asset('storage/' . $student->picture) }}" alt="Student Photo" class="w-full h-full object-cover rounded-xl shadow-md">
                    @else
                        <img src="/images/placeholder2x2.png" alt="Placeholder" class="w-full h-full object-cover rounded-xl shadow-md">
                    @endif
                </div>
            </div>

            <hr class="my-8">

            <h2 class="text-xl font-semibold text-gray-800 mb-4">Family Background</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-gray-500 text-sm">Father's Name</p>
                    <p class="font-medium">{{ $student->father_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Father's Age</p>
                    <p class="font-medium">{{ $student->father_age ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Occupation</p>
                    <p class="font-medium">
                        {{ $student->father_occupation ?? 'N/A' }}
                        @if($student->father_deceased)
                            <span class="text-red-600 text-xs ml-2">(Deceased)</span>
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Mother's Name</p>
                    <p class="font-medium">{{ $student->mother_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Mother's Age</p>
                    <p class="font-medium">{{ $student->mother_age ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Occupation</p>
                    <p class="font-medium">
                        {{ $student->mother_occupation ?? 'N/A' }}
                        @if($student->mother_deceased)
                            <span class="text-red-600 text-xs ml-2">(Deceased)</span>
                        @endif
                    </p>
                </div>
                <div class="md:col-span-3">
                    <p class="text-gray-500 text-sm">Monthly Household Income</p>
                    <p class="font-medium">{{ $student->monthly_income ?? 'N/A' }}</p>
                </div>
            </div>

            <hr class="my-8">

            <!-- Parent Consent -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Parent Consent</h2>
            <div class="space-y-4">
                <p><span class="text-gray-500">Parent Consent Form:</span> 
                    <span class="font-medium">
                        @if($student->parent_consent)
                            <a href="{{ asset('storage/' . $student->parent_consent) }}" target="_blank" class="text-blue-600 hover:underline">
                                📄 View Uploaded Consent Form
                            </a>
                        @else
                            <span class="text-red-600">Not uploaded</span>
                        @endif
                    </span>
                </p>
            </div>

            <hr class="my-8">

            <h2 class="text-xl font-semibold text-gray-800 mb-4">Computer Literacy</h2>
            <div class="space-y-4">
                <p><span class="text-gray-500">Computer Literate:</span> <span class="font-medium">{{ isset($student->is_literate) ? ($student->is_literate ? 'Yes' : 'No') : 'N/A' }}</span></p>
                <p><span class="text-gray-500">Tools:</span> 
                    <span class="font-medium">
                        @if(isset($student->tools) && $student->tools)
                            {{ is_array($student->tools) ? implode(', ', $student->tools) : (is_string($student->tools) ? implode(', ', json_decode($student->tools, true)) : 'None') }}
                        @else
                            None
                        @endif
                    </span>
                </p>
                <p><span class="text-gray-500">Commit Hours Weekly:</span> <span class="font-medium">{{ isset($student->can_commit) ? ($student->can_commit ? 'Yes' : 'No') : 'N/A' }}</span></p>
                <p><span class="text-gray-500">Willing to Overtime:</span> <span class="font-medium">{{ isset($student->willing_overtime) ? ($student->willing_overtime ? 'Yes' : 'No') : 'N/A' }}</span></p>
                <p><span class="text-gray-500">Clerical Tasks:</span> <span class="font-medium">{{ isset($student->comfortable_clerical) ? ($student->comfortable_clerical ? 'Yes' : 'No') : 'N/A' }}</span></p>
                <p><span class="text-gray-500">Strong Communication:</span> <span class="font-medium">{{ isset($student->strong_communication) ? ($student->strong_communication ? 'Yes' : 'No') : 'N/A' }}</span></p>
                <p><span class="text-gray-500">Willing to Train:</span> <span class="font-medium">{{ isset($student->willing_training) ? ($student->willing_training ? 'Yes' : 'No') : 'N/A' }}</span></p>
                <p><span class="text-gray-500">Other Skills:</span> <span class="font-medium">{{ $student->other_skills ?? 'None' }}</span></p>
            </div>
        </div>
    </main>
</div>
@endsection
