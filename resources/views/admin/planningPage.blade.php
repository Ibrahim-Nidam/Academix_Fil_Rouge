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

{{-- calendar section --}}
  <div class="flex flex-col lg:flex-row gap-4 md:gap-6">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 flex-1">
      {{-- FullCalendar --}}
      <div id="calendar" class="fc-theme-standard"></div>
    </div>
  </div>

{{-- event creation form section --}}
  <div id="event-details" class="hidden bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 lg:w-1/3 transition-all duration-300 ease-in-out">
    <div class="flex justify-between items-center mb-4">
      <h2 id="event-form-title" class="text-lg md:text-xl font-semibold">Event Details</h2>
      <button id="close-event-details" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
        <i class="fas fa-times"></i>
      </button>
    </div>
    
    <form id="event-form">
      <input type="hidden" id="event-id" value="">
      
      <div class="mb-4">
        <label for="schedule-type" class="form-label">Schedule Type</label>
        <select id="schedule-type" class="form-select" required>
          <option value="">Select Type</option>
          <option value="teacher">Teacher Schedule</option>
          <option value="class">Class Schedule</option>
        </select>
        <div id="schedule-type-error" class="text-red-500 text-xs mt-1 hidden">Please select a schedule type</div>
      </div>
      
      <div class="mb-4">
        <label for="event-title" class="form-label">Event Title</label>
        <input type="text" id="event-title" class="form-input" placeholder="Event Title" required>
        <div id="title-error" class="text-red-500 text-xs mt-1 hidden">Please enter an event title</div>
      </div>
      
      <div class="mb-4">
        <label for="event-type" class="form-label">Subject</label>
        <select id="event-type" class="form-select" required>
          <option value="">Select Subject</option>
          <option value="math">Math</option>
        </select>
        <div id="type-error" class="text-red-500 text-xs mt-1 hidden">Please select a subject</div>
      </div>
      
      <div id="teacher-fields" class="mb-4 hidden">
        <label for="event-teacher" class="form-label">Teacher</label>
        <select id="event-teacher" class="form-select">
          <option value="">Select Teacher</option>
          <option value="Mr. Johnson">Mr. Johnson</option>
        </select>
        <div id="teacher-error" class="text-red-500 text-xs mt-1 hidden">Please select a teacher</div>
      </div>
      
      <div id="class-fields" class="mb-4 hidden">
        <label for="event-class" class="form-label">Class</label>
        <select id="event-class" class="form-select">
          <option value="">Select Class</option>
          <option value="Grade 9A">Grade 9A</option>
        </select>
        <div id="class-error" class="text-red-500 text-xs mt-1 hidden">Please select a class</div>
      </div>
      
      <div class="mb-4">
        <label for="event-date" class="form-label">Date</label>
        <input type="date" id="event-date" class="form-input" required>
        <div id="date-error" class="text-red-500 text-xs mt-1 hidden">Please select a date</div>
      </div>
      
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label for="event-start-time" class="form-label">Start Time</label>
          <input type="time" id="event-start-time" class="form-input" required>
          <div id="start-time-error" class="text-red-500 text-xs mt-1 hidden">Please select a start time</div>
        </div>
        <div>
          <label for="event-end-time" class="form-label">End Time</label>
          <input type="time" id="event-end-time" class="form-input" required>
          <div id="end-time-error" class="text-red-500 text-xs mt-1 hidden">Please select an end time</div>
        </div>
      </div>
      
      <div class="mb-4">
        <label for="event-location" class="form-label">Location</label>
        <input type="text" id="event-location" class="form-input" placeholder="Location" required>
        <div id="location-error" class="text-red-500 text-xs mt-1 hidden">Please enter a location</div>
      </div>
      
      <div class="mb-4">
        <label for="event-description" class="form-label">Description</label>
        <textarea id="event-description" class="form-input h-24" placeholder="Event description"></textarea>
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

{{-- event creation form Mobile --}}
  <div id="mobile-event-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 w-full max-w-md max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center mb-4">
        <h2 id="mobile-form-title" class="text-lg font-semibold">Event Details</h2>
        <button id="close-mobile-modal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <form id="mobile-event-form">
        <input type="hidden" id="mobile-event-id" value="">
        
        <div class="mb-4">
          <label for="mobile-schedule-type" class="form-label">Schedule Type</label>
          <select id="mobile-schedule-type" class="form-select" required>
            <option value="">Select Type</option>
            <option value="teacher">Teacher Schedule</option>
            <option value="class">Class Schedule</option>
          </select>
          <div id="mobile-schedule-type-error" class="text-red-500 text-xs mt-1 hidden">Please select a schedule type</div>
        </div>
        
        <div class="mb-4">
          <label for="mobile-event-title" class="form-label">Event Title</label>
          <input type="text" id="mobile-event-title" class="form-input" placeholder="Event Title" required>
          <div id="mobile-title-error" class="text-red-500 text-xs mt-1 hidden">Please enter an event title</div>
        </div>
        
        <div class="mb-4">
          <label for="mobile-event-type" class="form-label">Subject</label>
          <select id="mobile-event-type" class="form-select" required>
            <option value="">Select Subject</option>
            <option value="math">Math</option>
          </select>
          <div id="mobile-type-error" class="text-red-500 text-xs mt-1 hidden">Please select a subject</div>
        </div>
        
        <div id="mobile-teacher-fields" class="mb-4 hidden">
          <label for="mobile-event-teacher" class="form-label">Teacher</label>
          <select id="mobile-event-teacher" class="form-select">
            <option value="">Select Teacher</option>
            <option value="Mr. Johnson">Mr. Johnson</option>
          </select>
          <div id="mobile-teacher-error" class="text-red-500 text-xs mt-1 hidden">Please select a teacher</div>
        </div>
        
        <div id="mobile-class-fields" class="mb-4 hidden">
          <label for="mobile-event-class" class="form-label">Class</label>
          <select id="mobile-event-class" class="form-select">
            <option value="">Select Class</option>
            <option value="Grade 9A">Grade 9A</option>
          </select>
          <div id="mobile-class-error" class="text-red-500 text-xs mt-1 hidden">Please select a class</div>
        </div>
        
        <div class="mb-4">
          <label for="mobile-event-date" class="form-label">Date</label>
          <input type="date" id="mobile-event-date" class="form-input" required>
          <div id="mobile-date-error" class="text-red-500 text-xs mt-1 hidden">Please select a date</div>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label for="mobile-event-start-time" class="form-label">Start Time</label>
            <input type="time" id="mobile-event-start-time" class="form-input" required>
            <div id="mobile-start-time-error" class="text-red-500 text-xs mt-1 hidden">Please select a start time</div>
          </div>
          <div>
            <label for="mobile-event-end-time" class="form-label">End Time</label>
            <input type="time" id="mobile-event-end-time" class="form-input" required>
            <div id="mobile-end-time-error" class="text-red-500 text-xs mt-1 hidden">Please select an end time</div>
          </div>
        </div>
        
        <div class="mb-4">
          <label for="mobile-event-location" class="form-label">Location</label>
          <input type="text" id="mobile-event-location" class="form-input" placeholder="Location" required>
          <div id="mobile-location-error" class="text-red-500 text-xs mt-1 hidden">Please enter a location</div>
        </div>
        
        <div class="mb-4">
          <label for="mobile-event-description" class="form-label">Description</label>
          <textarea id="mobile-event-description" class="form-input h-24" placeholder="Event description"></textarea>
        </div>
        
        <div class="flex justify-between mt-6">
          <button type="button" id="mobile-delete-event-btn" class="btn btn-danger">Delete</button>
          <div class="flex space-x-2">
            <button type="button" id="mobile-cancel-event-btn" class="btn btn-secondary">Cancel</button>
            <button type="submit" id="mobile-save-event-btn" class="btn btn-primary">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>

<div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 w-full max-w-md">
    <div class="text-center mb-4">
      <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-red-100 dark:bg-red-900 text-red-500 mb-4">
        <i class="fas fa-exclamation-triangle text-2xl"></i>
      </div>
      <h3 class="text-lg md:text-xl font-medium mb-2">Delete Event</h3>
      <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
        Are you sure you want to delete this event? This action cannot be undone.
      </p>
    </div>
    
    <div class="flex justify-center space-x-3">
      <button id="cancel-delete" class="btn btn-secondary">Cancel</button>
      <button id="confirm-delete" class="btn btn-danger">Delete</button>
    </div>
  </div>
</div>


</div>
@endsection