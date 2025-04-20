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
          @forelse ($classrooms as $classroom)
            <div class="class-card bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-700 hover:border-primary dark:hover:border-primary transition-all cursor-pointer {{ $loop->first ? 'active' : '' }}" data-class-id="{{ $classroom->id }}">
              <div class="p-5">
                <h3 class="text-lg font-semibold">{{ $classroom->name }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                  @if(isset($classroom->subjects) && $classroom->subjects->count() > 0)
                    {{ implode(', ', $classroom->subjects->pluck('name')->toArray()) }}
                  @else
                    No subjects assigned
                  @endif
                </p>
                <div class="mt-3 flex items-center text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                  <span>
                    @if(isset($classroom->students) && method_exists($classroom->students, 'count'))
                      {{ $classroom->students->count() }}
                    @else
                      0
                    @endif
                    Students
                  </span>
                </div>
              </div>
            </div>
          @empty
            <div class="col-span-full">
              <p class="text-center text-gray-500 dark:text-gray-400">No classes assigned to you yet.</p>
            </div>
          @endforelse
        </div>
      </section>

      {{-- Exam Grading Section --}}
      <section id="gradingSection" class="animate-fade-in {{ count($classrooms) > 0 ? '' : 'hidden' }}" style="animation-delay: 150ms;">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-700 mb-8">
          <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
              <h2 class="text-xl font-semibold">{{ $classrooms->first()->name ?? 'Select a class' }}</h2>
              <p class="text-sm text-gray-500 dark:text-gray-400">
                @if(isset($classrooms->first()->subjects) && $classrooms->first()->subjects->count() > 0)
                  {{ implode(', ', $classrooms->first()->subjects->pluck('name')->toArray()) }}
                @else
                  No subjects assigned
                @endif
              </p>
            </div>
            <div class="w-full md:w-auto">
              <select id="examSelector" class="form-select">
                <option value="">Select an exam/assignment...</option>
              </select>
            </div>
          </div>
          
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Student</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Grade (out of 20)</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Comments</th>
                </tr>
              </thead>
              <tbody id="gradesTableBody" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <tr>
                  <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                    Select an exam/assignment to view and enter grades
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          
          {{-- Submit Button --}}
          <div class="p-5 border-t border-gray-200 dark:border-gray-700 flex justify-end">
            <button id="submitGradesBtn" class="btn btn-primary flex items-center gap-2" disabled>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              Submit Grades
            </button>
          </div>
        </div>
      </section>
    </main>
  </div>

  {{-- Add Assignment Modal  --}}
  <div id="addExamModal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="modal-overlay absolute inset-0 bg-black opacity-50" id="modalOverlay"></div>
    <div class="modal-content bg-white dark:bg-gray-800 w-full max-w-md mx-auto rounded-xl shadow-lg z-50 p-6 relative">
      <button id="closeExamModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      
      <h2 class="text-2xl font-bold mb-2">Add New Exam/Assignment</h2>
      <p id="modalClassInfo" class="text-sm text-gray-500 dark:text-gray-400 mb-6"></p>
      
      <form id="addExamForm">
        <input type="hidden" id="examClassroomId">
        <div class="mb-4">
          <label for="examTitle" class="block text-sm font-medium mb-1">Exam Title</label>
          <input type="text" id="examTitle" placeholder="e.g. Final Exam" class="form-input w-full">
        </div>
        
        <div class="mb-4">
          <label for="examDate" class="block text-sm font-medium mb-1">Date</label>
          <input type="date" id="examDate" class="form-input w-full">
        </div>
        
        <div class="mb-6">
          <label for="examType" class="block text-sm font-medium mb-1">Type</label>
          <select id="examType" class="form-select w-full">
            <option value="exam">Exam</option>
            <option value="assignment">Assignment</option>
            <option value="quiz">Quiz</option>
            <option value="project">Project</option>
          </select>
        </div>
        
        <div class="flex justify-end gap-3">
          <button type="button" id="cancelExamBtn" class="btn btn-outline">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Exam</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Flash Messages --}}
<div id="flashMessage" class="hidden fixed top-4 right-4 z-50 rounded-lg px-6 py-3 text-white shadow-lg flex items-center gap-3">
  <span class="flash-content"></span>
  <button id="closeFlash" class="hover:text-gray-200">
    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
  </button>
</div>
@endsection