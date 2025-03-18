@extends('layouts.student')

@section('title', 'Resources Page')

@section('content')
{{-- page header --}}
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg">
  <section class="animate-fade-in mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Educational Resources</h1>
        <p class="text-gray-600 dark:text-gray-300">Access learning materials from your teachers</p>
      </div>
    </div>
  </section>

  {{-- Teacher Cards Section --}}
  <section class="animate-fade-in mb-8" style="animation-delay: 100ms;">
    <h2 class="text-xl font-semibold mb-4">Your Teachers</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      {{-- teacher placeholder card --}}
      <div class="teacher-card teacher-card-active" data-teacher="mathematics">
        <div class="p-4">
          <div class="flex items-center mb-3">
            <div class="bg-blue/10 dark:bg-blue/20 p-3 rounded-full mr-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
              </svg>
            </div>
            <div>
              <h3 class="font-medium text-lg">Dr. Johnson</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">Mathematics</p>
            </div>
          </div>
          <div class="text-sm text-gray-600 dark:text-gray-300">
            12 resources available
          </div>
        </div>
      </div>
      
      {{-- teacher placeholder card --}}
      <div class="teacher-card" data-teacher="physics">
        <div class="p-4">
          <div class="flex items-center mb-3">
            <div class="bg-purple-500/10 dark:bg-purple-500/20 p-3 rounded-full mr-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <div>
              <h3 class="font-medium text-lg">Prof. Martinez</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">Physics</p>
            </div>
          </div>
          <div class="text-sm text-gray-600 dark:text-gray-300">
            8 resources available
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Resources Section --}}
  <section class="animate-fade-in" style="animation-delay: 150ms;">
    {{-- subject resource placeholder --}}
    <div class="teacher-resources" id="mathematics-resources">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 md:p-6 mb-6">
        <div class="flex items-center mb-6">
          <div class="bg-blue/10 dark:bg-blue/20 p-3 rounded-full mr-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
          </div>
          <div>
            <h2 class="text-xl font-semibold">Dr. Johnson's Mathematics Resources</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Access all mathematics learning materials</p>
          </div>
        </div>
        
        {{-- school level placeholder --}}
        <div class="resource-group">
          <h3 class="grade-header">Grade 12</h3>
          <div class="space-y-4">
            {{-- resource placeholder card --}}
            <div class="resource-card">
              <div class="p-4 flex items-start">
                <div class="resource-icon bg-red-500/10 dark:bg-red-500/20">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                  </svg>
                </div>
                <div class="flex-1">
                  <h4 class="font-medium">Calculus Integration Techniques.mp4</h4>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Video tutorial on advanced integration methods</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Uploaded: March 1, 2025</p>
                </div>
                <div class="ml-4 flex items-center">
                  <button class="download-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        {{-- school level placeholder --}}
        <div class="resource-group">
          <h3 class="grade-header">Grade 11</h3>
          <div class="space-y-4">
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection