@extends('layouts.student')

@section('title', 'Grades Dashboard')

@section('content')
{{-- page header --}}
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg md:p-6 lg:p-8">
  <section class="animate-fade-in mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Welcome, Alex!</h1>
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
          <div class="text-4xl font-bold text-gold">15.8</div>
          <div class="ml-2 text-sm text-gray-500 dark:text-gray-400">/ 20</div>
        </div>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold mb-2">Highest Grade</h3>
        <div class="flex items-center">
          <div class="text-4xl font-bold text-green-600 dark:text-green-500">19</div>
          <div class="ml-2 text-sm text-gray-500 dark:text-gray-400">/ 20</div>
          <div class="ml-3 text-sm text-gray-500 dark:text-gray-400">Mathematics</div>
        </div>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold mb-2">Assessments Completed</h3>
        <div class="text-4xl font-bold text-blue dark:text-blue/90">12</div>
      </div>
    </div>
  </section>

  
</main>
@endsection