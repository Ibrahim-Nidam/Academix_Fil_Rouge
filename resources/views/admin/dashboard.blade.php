@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
  <div class="flex flex-col flex-1 p-4 md:p-6 w-full">

{{-- WELCOME SECTION --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 mb-4 md:mb-6">
      <h1 class="text-2xl md:text-3xl font-bold">Welcome back, <span class="text-primary-accent">Dr. Smith</span></h1>
      <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm md:text-base">
        <span id="current-date">Monday, March 6, 2025</span> • 
        <span class="italic">Here's an overview of today's progress</span>
      </p>
    </div>

{{-- Distribution section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-4 md:mb-6">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6">
        <h2 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Students Distribution</h2>
        <div class="flex flex-col items-center">
          <div class="w-40 h-40 md:w-48 md:h-48 relative">
            <canvas id="studentsChart"></canvas>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 bg-white dark:bg-gray-800 rounded-full w-16 h-16 md:w-20 md:h-20 flex items-center justify-center">
              <i class="fas fa-user-graduate text-3xl md:text-4xl text-primary-accent"></i>
            </div>
          </div>
          <div class="flex justify-center mt-4 md:mt-6 space-x-6 md:space-x-8">
            <div class="flex items-center">
              <div class="w-3 h-3 md:w-4 md:h-4 rounded-full bg-primary-blue mr-1 md:mr-2"></div>
              <span class="text-sm">Male (60%)</span>
            </div>
            <div class="flex items-center">
              <div class="w-3 h-3 md:w-4 md:h-4 rounded-full bg-primary-yellow mr-1 md:mr-2"></div>
              <span class="text-sm">Female (40%)</span>
            </div>
          </div>
          <p class="mt-3 md:mt-4 text-center font-bold text-base md:text-xl">Total: 1,250 Students</p>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6">
        <h2 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Staff Distribution</h2>
        <div class="flex flex-col items-center">
          <div class="w-40 h-40 md:w-48 md:h-48 relative">
            <canvas id="staffChart"></canvas>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 bg-white dark:bg-gray-800 rounded-full w-16 h-16 md:w-20 md:h-20 flex items-center justify-center">
              <i class="fas fa-chalkboard-teacher text-3xl md:text-4xl text-primary-accent"></i>
            </div>
          </div>
          <div class="flex justify-center mt-4 md:mt-6 space-x-6 md:space-x-8">
            <div class="flex items-center">
              <div class="w-3 h-3 md:w-4 md:h-4 rounded-full bg-primary-blue mr-1 md:mr-2"></div>
              <span class="text-sm">Male (45%)</span>
            </div>
            <div class="flex items-center">
              <div class="w-3 h-3 md:w-4 md:h-4 rounded-full bg-primary-yellow mr-1 md:mr-2"></div>
              <span class="text-sm">Female (55%)</span>
            </div>
          </div>
          <p class="mt-3 md:mt-4 text-center font-bold text-base md:text-xl">Total: 85 Staff Members</p>
        </div>
      </div>
    </div>


  </div>
@endsection