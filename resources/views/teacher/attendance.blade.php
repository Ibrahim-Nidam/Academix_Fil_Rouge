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

    </main>
@endsection