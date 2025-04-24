@extends('layouts.teacher')

@section('title', 'Attendance Dashboard')

@section('content')
{{-- page header --}}
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg md:p-6 lg:p-8">
      <section class="animate-fade-in mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
          <div>
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Daily Attendance</h1>
            <p class="text-gray-600 dark:text-gray-300">Track attendance for your classes</p>
          </div>
          <div class="mt-4 md:mt-0">
            <select id="classSelector" class="border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-800">
              <option value="">Select a class...</option>
            </select>
          </div>
        </div>
      </section>

      {{-- Weekly Attendance Selector --}}
      <section class="animate-fade-in mb-8" style="animation-delay: 100ms;">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4">
          <h2 class="text-lg font-semibold mb-4">Select Day</h2>
          <div class="flex overflow-x-auto pb-2 gap-2 md:gap-4 justify-center">
            <div id="weekDays" class="flex gap-2 md:gap-4"></div>
          </div>
        </div>
      </section>

      {{-- Class Attendance Section --}}
      <section id="classAttendanceSection" class="animate-fade-in" style="animation-delay: 200ms;">
      </section>

      {{-- Submit Button --}}
      <section class="animate-fade-in fixed bottom-4 inset-x-0 flex justify-center md:static md:justify-end w-full md:mt-8" style="animation-delay: 250ms;">
        <button id="submitAttendance" class="btn btn-primary flex items-center gap-2 px-6 py-3 md:px-8 md:py-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
          Submit Attendance
        </button>
      </section>      

      {{-- Success Toast Notification --}}
      <div id="toast" class="toast">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span id="toastMessage">Attendance submitted successfully!</span>
      </div>
    </main>
@endsection