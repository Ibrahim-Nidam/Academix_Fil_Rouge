@extends('layouts.teacher')

@section('title', 'Grades Dashboard')

@section('content')
{{-- page header --}}
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg md:p-6 lg:p-8">
      <section class="animate-fade-in mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
          <div>
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Grade Management</h1>
            <p class="text-gray-600 dark:text-gray-300">Record and manage student grades</p>
          </div>
          <div class="mt-4 md:mt-0">
            <button id="addExamBtn" class="btn btn-primary flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              Add Exam/Assignment
            </button>
          </div>
        </div>
      </section>

      {{-- Class Selection Section  --}}
      <section class="animate-fade-in mb-8" style="animation-delay: 100ms;">
        <h2 class="text-xl font-semibold mb-4">My Classes</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

          <div class="class-card active" data-class-id="class1">
            <div class="p-5">
              <h3 class="text-lg font-semibold">Grade 10 - Section A</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">Mathematics</p>
              <div class="mt-3 flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>30 Students</span>
              </div>
            </div>
          </div>

        </div>
      </section>

    
@endsection