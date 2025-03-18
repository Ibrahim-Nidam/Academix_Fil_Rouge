@extends('layouts.student')

@section('title', 'Attendance Page')

@section('content')
{{-- page header --}}
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg md:p-6 lg:p-8">
  <section class="animate-fade-in mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Your Attendance</h1>
        <p class="text-gray-600 dark:text-gray-300">Track your daily attendance at a glance</p>
      </div>
      <div class="mt-4 md:mt-0">
        <div class="text-sm text-gray-500 dark:text-gray-400">
          <span class="font-medium">Today:</span> Monday, March 8, 2025
        </div>
      </div>
    </div>
  </section>

  {{-- Attendance Summary --}}
  <section class="animate-fade-in mb-8" style="animation-delay: 100ms;">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      {{-- placeholder cards --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5 border border-gray-100 dark:border-gray-700">
        <div class="flex items-center">
          <div class="bg-present/10 dark:bg-present/20 p-3 rounded-full mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-present" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <div>
            <div class="text-sm text-gray-500 dark:text-gray-400">Present</div>
            <div class="text-2xl font-bold">42</div>
            <div class="text-sm text-gray-500 dark:text-gray-400">87.5%</div>
          </div>
        </div>
      </div>
      
      {{-- placeholder cards --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5 border border-gray-100 dark:border-gray-700">
        <div class="flex items-center">
          <div class="bg-absent/10 dark:bg-absent/20 p-3 rounded-full mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-absent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </div>
          <div>
            <div class="text-sm text-gray-500 dark:text-gray-400">Absent</div>
            <div class="text-2xl font-bold">6</div>
            <div class="text-sm text-gray-500 dark:text-gray-400">12.5%</div>
          </div>
        </div>
      </div>
      
      {{-- placeholder cards --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5 border border-gray-100 dark:border-gray-700">
        <div class="flex items-center">
          <div class="bg-blue/10 dark:bg-blue/20 p-3 rounded-full mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
          </div>
          <div>
            <div class="text-sm text-gray-500 dark:text-gray-400">Total Classes</div>
            <div class="text-2xl font-bold">48</div>
            <div class="text-sm text-gray-500 dark:text-gray-400">This Semester</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
@endsection