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

@endsection