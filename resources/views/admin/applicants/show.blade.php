@extends('layouts.guest')

@section('title', 'Applicant Details')

@section('content')
<div class="min-h-screen bg-gray-100 font-sans">

    <!-- HEADER -->
    <section class="relative bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-12">
        <div class="container mx-auto px-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Applicant Details</h1>
                <p class="text-sm opacity-80">Universidad de Dagupan - Student Assistant Program</p>
            </div>
            <img src="/images/uddlogo.png" class="w-20 h-20 object-contain" alt="UDD Logo">
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="container mx-auto px-6 py-10">

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <!-- Personal Info -->
            <div class="flex flex-col md:flex-row md:items-start gap-8">
                <!-- Left (details) -->
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 text-sm">Student Name</p>
                            <p class="font-medium">{{ $application->student_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Course</p>
                            <p class="font-medium">{{ $application->course }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Year Level</p>
                            <p class="font-medium">{{ $application->year_level }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Student ID</p>
                            <p class="font-medium">{{ $application->id_number }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Age</p>
                            <p class="font-medium">{{ $application->age }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Email</p>
                            <p class="font-medium">{{ $application->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Telephone</p>
                            <p class="font-medium">{{ $application->telephone }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-500 text-sm">Address</p>
                            <p class="font-medium">{{ $application->address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right (photo) -->
                <div class="w-64 h-64 flex-shrink-0 relative">
                    @if($application->picture)
                        <img src="{{ asset('storage/' . $application->picture) }}" alt="Applicant Photo" class="w-full h-full object-cover rounded-xl shadow-md">
                    @else
                        <img src="/images/placeholder2x2.png" alt="Placeholder" class="w-full h-full object-cover rounded-xl shadow-md">
                    @endif
                </div>
            </div>

            <hr class="my-8">

            <!-- Family Background -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Family Background</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-gray-500 text-sm">Father's Name</p>
                    <p class="font-medium">{{ $application->father_name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Father's Age</p>
                    <p class="font-medium">{{ $application->father_age }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Occupation</p>
                    <p class="font-medium">
                        {{ $application->father_occupation }}
                        @if($application->father_deceased)
                            <span class="text-red-600 text-xs ml-2">(Deceased)</span>
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Mother's Name</p>
                    <p class="font-medium">{{ $application->mother_name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Mother's Age</p>
                    <p class="font-medium">{{ $application->mother_age }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Occupation</p>
                    <p class="font-medium">
                        {{ $application->mother_occupation }}
                        @if($application->mother_deceased)
                            <span class="text-red-600 text-xs ml-2">(Deceased)</span>
                        @endif
                    </p>
                </div>
                <div class="md:col-span-3">
                    <p class="text-gray-500 text-sm">Monthly Household Income</p>
                    <p class="font-medium">{{ $application->monthly_income }}</p>
                </div>
            </div>

            <hr class="my-8">

            <!-- Parent Consent -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Parent Consent</h2>
            <div class="space-y-4">
                <p><span class="text-gray-500">Parent Consent Form:</span> 
                    <span class="font-medium">
                        @if($application->parent_consent)
                            <a href="{{ asset('storage/' . $application->parent_consent) }}" target="_blank" class="text-blue-600 hover:underline">
                                📄 View Uploaded Consent Form
                            </a>
                        @else
                            <span class="text-red-600">Not uploaded</span>
                        @endif
                    </span>
                </p>
            </div>

            <hr class="my-8">

            <!-- Computer Literacy -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Computer Literacy</h2>
            <div class="space-y-4">
                <p><span class="text-gray-500">Computer Literate:</span> <span class="font-medium">{{ $application->is_literate ? 'Yes' : 'No' }}</span></p>
                <p><span class="text-gray-500">Tools:</span> 
                    <span class="font-medium">
                        @if($application->tools)
                            {{ implode(', ', json_decode($application->tools, true)) }}
                        @else
                            None
                        @endif
                    </span>
                </p>
                <p><span class="text-gray-500">Commit Hours Weekly:</span> <span class="font-medium">{{ $application->can_commit ? 'Yes' : 'No' }}</span></p>
                <p><span class="text-gray-500">Willing to Overtime:</span> <span class="font-medium">{{ $application->willing_overtime ? 'Yes' : 'No' }}</span></p>
                <p><span class="text-gray-500">Clerical Tasks:</span> <span class="font-medium">{{ $application->comfortable_clerical ? 'Yes' : 'No' }}</span></p>
                <p><span class="text-gray-500">Strong Communication:</span> <span class="font-medium">{{ $application->strong_communication ? 'Yes' : 'No' }}</span></p>
                <p><span class="text-gray-500">Willing to Train:</span> <span class="font-medium">{{ $application->willing_training ? 'Yes' : 'No' }}</span></p>
                <p><span class="text-gray-500">Other Skills:</span> <span class="font-medium">{{ $application->other_skills ?? 'None' }}</span></p>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-indigo-600 text-white text-center text-sm py-4 mt-12">
        &copy; 2023 - 2024 by MRCY Inc., a non-profit organization. All rights reserved.
    </footer>
</div>
@endsection
