@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')
{{-- page header --}}
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg md:p-6 lg:p-8">
  <section class="animate-fade-in mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-2xl md:text-3xl font-bold">Welcome back, <span class="text-primary-accent">{{Auth::user()->gender == 'Male' ? 'Mr. ' : 'Ms. '}} {{ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name)}} </span></h1>
        <p class="text-gray-600 dark:text-gray-300">Here's your academic overview for today. Keep up the good work!</p>
      </div>
      <div class="mt-4 md:mt-0">
        <div class="text-sm text-gray-500 dark:text-gray-400">
          <span id="current-date"></span>
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
            <span class="block text-4xl font-bold text-gold">{{ $overallGrade }}</span>
            <span class="text-sm text-gray-500 dark:text-gray-400">out of 20</span>
          </div>
        </div>
        <p class="text-sm text-center text-gray-600 dark:text-gray-300">
          {{ $gradeMessage }}
        </p>
      </div>
      
      {{-- Best Subjects Card --}}
      <div class="card">
        <h2 class="text-lg font-semibold mb-4">Best Subjects</h2>
        <ul class="space-y-4">
          @forelse($bestSubjects as $subject)
          <li>
            <div class="flex justify-between items-center mb-1">
              <span class="font-medium">{{ $subject['name'] }}</span>
              <span class="badge {{ $subject['badge'] }}">{{ $subject['score'] }}/20</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill {{ $subject['class'] }}" style="width: {{ $subject['percentage'] }}%"></div>
            </div>
          </li>
          @empty
          <li>
            <p class="text-gray-500 dark:text-gray-400">No grades recorded yet.</p>
          </li>
          @endforelse
        </ul>
      </div>
      
      {{-- Subjects Needing Improvement Card --}}
      <div class="card">
        <h2 class="text-lg font-semibold mb-4">Subjects Needing Improvement</h2>
        <ul class="space-y-4">
          @forelse($improvementSubjects as $subject)
          <li>
            <div class="flex justify-between items-center mb-1">
              <span class="font-medium">{{ $subject['name'] }}</span>
              <span class="badge {{ $subject['badge'] }}">{{ $subject['score'] }}/20</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill {{ $subject['class'] }}" style="width: {{ $subject['percentage'] }}%"></div>
            </div>
          </li>
          @empty
          <li>
            <p class="text-gray-500 dark:text-gray-400">No grades recorded yet.</p>
          </li>
          @endforelse
        </ul>
      </div>
    </div>
  </section>

  {{-- student Schedule Section --}}
  <section class="animate-fade-in mb-8" style="animation-delay: 150ms;">
    <h2 class="text-xl font-semibold mb-4">Today's Class Schedule</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      @forelse($formattedTodaySchedules as $schedule)
      <div class="card-time border-l-4 flex flex-col">
        <div class="flex justify-between items-start flex-grow mb-8">
          <div>
            <h3 class="text-lg font-semibold">{{ $schedule['title'] }}</h3>
            @if($schedule['is_current'])
            <span class="badge badge-warning mb-2">Current Class</span>
            @endif
          </div>
          <div class="text-right">
            <p class="text-sm font-medium">{{ $schedule['start_time'] }} - {{ $schedule['end_time'] }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Room {{ $schedule['room'] }}</p>
          </div>
        </div>
        <div class="mt-auto pt-4 border-t border-gray-200 dark:border-gray-700"></div>
      </div>
      @empty
      <div class="card col-span-full">
        <p class="text-gray-500 dark:text-gray-400">No classes scheduled for today.</p>
      </div>
      @endforelse
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
            <th class="timetable-header timetable-cell">Saturday</th>
          </tr>
        </thead>
        <tbody>
          @foreach($timetable as $row)
          <tr>
            <td class="timetable-time timetable-cell">{{ $row['time'] }}</td>
            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday'] as $day)
              <td class="timetable-cell">
                @if($row[$day])
                <div class="timetable-class">
                  <div class="font-medium">{{ $row[$day]['title'] }}</div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Room {{ $row[$day]['room'] }}</div>
                </div>
                @endif
              </td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
</main>
@endsection