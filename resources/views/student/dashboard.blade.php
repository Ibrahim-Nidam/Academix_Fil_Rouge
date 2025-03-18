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

 
</main>
@endsection