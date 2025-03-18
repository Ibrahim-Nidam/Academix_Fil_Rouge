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

  {{-- Attendance Timeline --}}
  <section class="animate-fade-in" style="animation-delay: 200ms;">
    <div class="month-divider">
      <h2 class="px-4 text-lg font-semibold text-gray-700 dark:text-gray-300">March 2025</h2>
    </div>
    
    <div class="space-y-4">
      {{-- placeholder : Monday, March 8, 2025 --}}
      <div class="flex items-center mb-2">
        <div class="bg-gold/20 dark:bg-gold/30 rounded-full w-8 h-8 flex items-center justify-center mr-3">
          <span class="text-gold font-medium">8</span>
        </div>
        <h3 class="text-md font-medium">Monday, March 8, 2025</h3>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {{-- placeholder card --}}
        <div class="attendance-card attendance-card-absent group">
          <div class="attendance-day">Monday, March 8, 2025</div>
          <div class="attendance-subject">History</div>
          <div class="attendance-time">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            4:00 PM - 5:30 PM
          </div>
          <div class="mt-3 flex justify-between items-center">
            <span class="attendance-badge attendance-badge-absent">Absent</span>
            <div class="text-sm text-gray-500 dark:text-gray-400">Room 108</div>
          </div>
          <div class="tooltip">
            Instructor: Dr. Thompson<br>
            Topic: Industrial Revolution
          </div>
        </div>
      </div>
      
      {{-- placeholder : Friday, March 7, 2025 --}}
      <div class="flex items-center mb-2 mt-8">
        <div class="bg-gray-200 dark:bg-gray-700 rounded-full w-8 h-8 flex items-center justify-center mr-3">
          <span class="text-gray-700 dark:text-gray-300 font-medium">7</span>
        </div>
        <h3 class="text-md font-medium">Friday, March 7, 2025</h3>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {{-- placeholder card  --}}
        <div class="attendance-card attendance-card-present group">
          <div class="attendance-day">Friday, March 7, 2025</div>
          <div class="attendance-subject">Literature</div>
          <div class="attendance-time">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            8:00 AM - 9:30 AM
          </div>
          <div class="mt-3 flex justify-between items-center">
            <span class="attendance-badge attendance-badge-present">Present</span>
            <div class="text-sm text-gray-500 dark:text-gray-400">Room 203</div>
          </div>
          <div class="tooltip">
            Instructor: Prof. Garcia<br>
            Topic: Shakespeare Analysis
          </div>
        </div>
      </div>
    </div>
    
  </section>
</main>
@endsection