@extends('layouts.admin')

@section('title', 'Schedule Planning')

@section('content')
<div class="flex flex-col flex-1 w-full">

{{-- page header --}}
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 mb-4 md:mb-6">
    <div class="flex flex-wrap justify-between items-center">
      <div>
        <h1 class="text-2xl md:text-3xl font-bold">Timetable Scheduling</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm md:text-base">
          Create and manage timetables for teachers and students
        </p>
      </div>
      <div class="flex flex-wrap gap-2 mt-2 md:mt-0">
        <button id="add-teacher-event-btn" class="btn btn-primary flex items-center">
          <i class="fas fa-user-tie mr-2"></i>
          Teacher Schedule
        </button>
        <button id="add-class-event-btn" class="btn btn-primary flex items-center">
          <i class="fas fa-users mr-2"></i>
          Class Schedule
        </button>
      </div>
    </div>
  </div>
  
  
</div>
@endsection