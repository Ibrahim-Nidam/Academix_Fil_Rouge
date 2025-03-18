@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')
{{-- page header --}}
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg md:p-6 lg:p-8">
  <section class="animate-fade-in mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Welcome back, Alex!</h1>
        <p class="text-gray-600 dark:text-gray-300">Here's your academic overview for today. Keep up the good work!</p>
      </div>
      <div class="mt-4 md:mt-0">
        <div class="text-sm text-gray-500 dark:text-gray-400">
          <span class="font-medium">Today:</span> Monday, March 8, 2025
        </div>
      </div>
    </div>
  </section>

  {{-- Overall Performance Section --}}
  <section class="animate-fade-in mb-8" style="animation-delay: 100ms;">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      {{-- estimate Grade Card --}}
      <div class="card flex flex-col items-center justify-center">
        <h2 class="text-lg font-semibold mb-2">Your Overall Grade</h2>
        <div class="flex items-center justify-center w-32 h-32 rounded-full border-4 border-gold mb-2">
          <div class="text-center">
            <span class="block text-4xl font-bold text-gold">15</span>
            <span class="text-sm text-gray-500 dark:text-gray-400">out of 20</span>
          </div>
        </div>
        <p class="text-sm text-center text-gray-600 dark:text-gray-300">
          You're performing well above average!
        </p>
      </div>
      
      {{-- Best Subjects Card placeholder --}}
      <div class="card">
        <h2 class="text-lg font-semibold mb-4">Best Subjects</h2>
        <ul class="space-y-4">
          <li>
            <div class="flex justify-between items-center mb-1">
              <span class="font-medium">Mathematics</span>
              <span class="badge badge-success">18/20</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill progress-fill-high" style="width: 90%"></div>
            </div>
          </li>
        </ul>
      </div>
      
      {{-- Subjects Needing Improvement Card placeholder --}}
      <div class="card">
        <h2 class="text-lg font-semibold mb-4">Subjects Needing Improvement</h2>
        <ul class="space-y-4">
          <li>
            <div class="flex justify-between items-center mb-1">
              <span class="font-medium">History</span>
              <span class="badge badge-warning">12/20</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill progress-fill-medium" style="width: 60%"></div>
            </div>
          </li>
          
        </ul>
      </div>
    </div>
  </section>

  
</main>
@endsection