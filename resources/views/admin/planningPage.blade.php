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
          Create and manage fixed timetables for the school year
        </p>
      </div>
      <div class="mt-2 md:mt-0">
        <button id="add-schedule-btn" class="btn btn-primary flex items-center">
          <i class="fas fa-calendar-plus mr-2"></i>
          Add Schedule
        </button>
      </div>
    </div>
  </div>

  {{-- calendar and form section --}}
  <div class="flex flex-col lg:flex-row gap-4 md:gap-6">
    {{-- Calendar --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 flex-1">
      <div id="calendar" class="fc-theme-standard"></div>
    </div>

    {{-- Schedule Form --}}
    <div id="event-details" class="hidden bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 lg:w-1/3 transition-all duration-300 ease-in-out">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg md:text-xl font-semibold">Schedule Details</h2>
        <button id="close-event-details" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form id="event-form" method="POST" action="{{route('admin.planningPage.store')}}">
        @csrf

        <input type="hidden" id="event-id" value="">

        <div class="mb-4">
          <label for="event-title" class="form-label">Title</label>
          <input type="text" id="event-title" class="form-input" placeholder="e.g. Math Lecture" required>
        </div>

        <div class="mb-4">
          <label for="event-teacher" class="form-label">Teacher</label>
          <select id="event-teacher" class="form-select" required>
            <option value="">Select Teacher</option>
            @foreach($teachers ?? [] as $teacher)
              <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="event-class" class="form-label">Class</label>
          <select id="event-class" class="form-select" required>
            <option value="">Select Class</option>
            @foreach($classes ?? [] as $classroom)
              <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label for="event-day-of-week" class="form-label">Day of Week</label>
          <select id="event-day-of-week" class="form-select" required>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
          </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label for="event-start-time" class="form-label">Start Time</label>
            <input type="time" id="event-start-time" class="form-input" required>
          </div>
          <div>
            <label for="event-end-time" class="form-label">End Time</label>
            <input type="time" id="event-end-time" class="form-input" required>
          </div>
        </div>

        <div class="mb-4">
          <label for="event-room" class="form-label">Room</label>
          <input type="text" id="event-room" class="form-select" required>
        </div>

        <div class="flex justify-between mt-6">
          <button type="button" id="delete-event-btn" class="btn btn-danger">Delete</button>
          <div class="flex space-x-2">
            <button type="button" id="cancel-event-btn" class="btn btn-secondary">Cancel</button>
            <button type="submit" id="save-event-btn" class="btn btn-primary">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 w-full max-w-md">
    <div class="text-center mb-4">
      <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-red-100 dark:bg-red-900 text-red-500 mb-4">
        <i class="fas fa-exclamation-triangle text-2xl"></i>
      </div>
      <h3 class="text-lg md:text-xl font-medium mb-2">Delete Schedule</h3>
      <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
        Are you sure you want to delete this schedule? This action will remove this class from the entire timetable.
      </p>
    </div>
    <form id="delete-form" action="" method="POST">
      @csrf
      @method('DELETE')
      <input type="hidden" id="delete-event-id" name="event_id" value="">
      <div class="flex justify-center space-x-3">
        <button type="button" class="btn btn-secondary delete-modal-close">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
    </form>
  </div>
</div>
@endsection