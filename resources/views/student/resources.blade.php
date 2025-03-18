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
      
      
</main>
@endsection