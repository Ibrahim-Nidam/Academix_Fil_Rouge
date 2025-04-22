@extends('layouts.student')

@section('title', 'Grades Dashboard')

@section('content')
{{-- page header --}}
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg md:p-6 lg:p-8">
  <section class="animate-fade-in mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-2xl md:text-3xl font-bold">Welcome back, <span class="text-primary-accent">{{ Auth::user()->gender == 'Male' ? 'Mr. ' : 'Ms. ' }} {{ ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name) }} </span></h1>
        <p class="text-gray-600 dark:text-gray-300">Here's an overview of your performance and teacher feedback.</p>
      </div>
    </div>
  </section>

  {{-- student Performance stats  --}}
  <section class="animate-fade-in mb-8" style="animation-delay: 100ms;">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold mb-2">Overall Average</h3>
        <div class="flex items-center">
          <div class="text-4xl font-bold text-gold">{{ $overallAverage }}</div>
          <div class="ml-2 text-sm text-gray-500 dark:text-gray-400">/ 20</div>
        </div>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold mb-2">Highest Grade</h3>
        <div class="flex items-center">
          <div class="text-4xl font-bold text-green-600 dark:text-green-500">{{ $highestGrade }}</div>
          <div class="ml-2 text-sm text-gray-500 dark:text-gray-400">/ 20</div>
          <div class="ml-3 text-sm text-gray-500 dark:text-gray-400">{{ $highestSubject }}</div>
        </div>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold mb-2">Assessments Completed</h3>
        <div class="text-4xl font-bold text-blue dark:text-blue/90">{{ $totalAssessments }}</div>
      </div>
    </div>
  </section>

  {{-- grades and notes --}}
  <section class="animate-fade-in" style="animation-delay: 150ms;">
    <h2 class="text-xl font-semibold mb-4">Performance & Commentaires</h2>
    
    @foreach($subjectGrades as $subjectName => $subjectData)
    <div class="mb-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
      <button class="subject-header" data-accordion-target="subject-{{ $subjectData['id'] }}">
        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
          </svg>
          <span class="text-lg font-medium">{{ $subjectName }}</span>
        </div>
        <div class="flex items-center">
          <span class="mr-3 text-sm font-medium">Average: {{ $subjectData['average'] }}/20</span>
          <svg class="w-5 h-5 transition-transform duration-300 transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
      </button>
      <div id="subject-{{ $subjectData['id'] }}" class="subject-content">
        <div class="p-5 border-t border-gray-200 dark:border-gray-700">
          @foreach($subjectData['grades'] as $grade)
          <div class="assessment-card mb-4 last:mb-0">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2">
              <h4 class="text-lg font-medium">{{ $grade->title }} ({{ date('Y-m-d', strtotime($grade->date)) }})</h4>
              <span class="grade-badge {{ $grade->score >= 16 ? 'grade-high' : ($grade->score >= 10 ? 'grade-medium' : 'grade-low') }} mt-2 md:mt-0">
                Grade: {{ $grade->score }}/20
              </span>
            </div>
            @if($grade->comment)
            <div class="mt-2 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
              <div class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500 dark:text-gray-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <p class="text-gray-600 dark:text-gray-300">
                  <span class="font-medium text-darkText dark:text-lightText">Teacher Comment:</span> 
                  {{ $grade->comment }}
                </p>
              </div>
            </div>
            @endif
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @endforeach
  </section>
</main>
@endsection