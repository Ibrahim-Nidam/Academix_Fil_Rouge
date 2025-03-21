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

  {{-- student Schedule Section --}}
  <section class="animate-fade-in mb-8" style="animation-delay: 150ms;">
    <h2 class="text-xl font-semibold mb-4">Today's Class Schedule</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      {{-- class card placeholder --}}
      <div class="card border-l-4 border-l-gold">
        <div class="flex justify-between items-start">
          <div>
            <span class="badge badge-warning mb-2">Current Class</span>
            <h3 class="text-lg font-semibold">Mathematics</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Advanced Calculus</p>
          </div>
          <div class="text-right">
            <p class="text-sm font-medium">10:00 AM - 11:30 AM</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Room 301</p>
            <div class="mt-2 flex items-center justify-end">
              <span class="text-xs mr-1">Average:</span>
              <span class="badge badge-success">18/20</span>
            </div>
          </div>
        </div>
        <div class="mt-4 border-t border-gray-200 dark:border-gray-700"></div>
      </div>
      
    </div>
  </section>

  {{-- Weekly Timetable Section --}}
  <section class="animate-fade-in" style="animation-delay: 200ms;">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold">Weekly Timetable</h2>
    </div>
    
    <div class="card overflow-x-auto">
      <table class="min-w-full border-collapse">
        <thead>
          <tr>
            <th class="timetable-header timetable-cell">Time</th>
            <th class="timetable-header timetable-cell">Monday</th>
            <th class="timetable-header timetable-cell">Tuesday</th>
            <th class="timetable-header timetable-cell">Wednesday</th>
            <th class="timetable-header timetable-cell">Thursday</th>
            <th class="timetable-header timetable-cell">Friday</th>
          </tr>
        </thead>
        <tbody>
          {{-- timetable placeholder --}}
          <tr>
            <td class="timetable-time timetable-cell">8:00 - 10:00</td>
            <td class="timetable-cell"></td>
            <td class="timetable-class timetable-cell">
              <div class="font-medium">Literature</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Room 203</div>
            </td>
            <td class="timetable-cell"></td>
            <td class="timetable-class timetable-cell">
              <div class="font-medium">Biology</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Lab 105</div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</main>
@endsection