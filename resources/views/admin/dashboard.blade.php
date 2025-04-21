@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
  <div class="flex flex-col flex-1 p-4 md:p-6 w-full">

{{-- WELCOME SECTION --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 mb-4 md:mb-6">
      <h1 class="text-2xl md:text-3xl font-bold">Welcome back, <span class="text-primary-accent">{{Auth::user()->gender == 'Male' ? 'Mr. ' : 'Ms. '}} {{ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name)}} </span></h1>
      <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm md:text-base">
        <span id="current-date">Monday, March 6, 2025</span> • 
        <span class="italic">Here's an overview of today's progress</span>
      </p>
    </div>

{{-- Distribution section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-4 md:mb-6">
      <!-- Students Distribution -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6">
        <h2 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Students Distribution</h2>
        <div class="flex flex-col items-center">
          <div class="w-40 h-40 md:w-48 md:h-48 relative">
            <canvas id="studentsChart"></canvas>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 bg-white dark:bg-gray-800 rounded-full w-16 h-16 md:w-20 md:h-20 flex items-center justify-center">
              <i class="fas fa-user-graduate text-3xl md:text-4xl text-primary-accent"></i>
            </div>
          </div>
          <div class="flex justify-center mt-4 md:mt-6 space-x-6 md:space-x-8">
            <div class="flex items-center">
              <div class="w-3 h-3 md:w-4 md:h-4 rounded-full bg-primary-blue mr-1 md:mr-2"></div>
              <span class="text-sm">Male ({{ $maleStudents }})</span>
            </div>
            <div class="flex items-center">
              <div class="w-3 h-3 md:w-4 md:h-4 rounded-full bg-primary-yellow mr-1 md:mr-2"></div>
              <span class="text-sm">Female ({{ $femaleStudents }})</span>
            </div>
          </div>
          <p class="mt-3 md:mt-4 text-center font-bold text-base md:text-xl">
            Total: {{ $totalStudents }} Students
          </p>
        </div>
      </div>

      <!-- Staff Distribution -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6">
        <h2 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Teacher Distribution</h2>
        <div class="flex flex-col items-center">
          <div class="w-40 h-40 md:w-48 md:h-48 relative">
            <canvas id="staffChart"></canvas>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 bg-white dark:bg-gray-800 rounded-full w-16 h-16 md:w-20 md:h-20 flex items-center justify-center">
              <i class="fas fa-chalkboard-teacher text-3xl md:text-4xl text-primary-accent"></i>
            </div>
          </div>
          <div class="flex justify-center mt-4 md:mt-6 space-x-6 md:space-x-8">
            <div class="flex items-center">
              <div class="w-3 h-3 md:w-4 md:h-4 rounded-full bg-primary-blue mr-1 md:mr-2"></div>
              <span class="text-sm">Male ({{ $maleStaff }})</span>
            </div>
            <div class="flex items-center">
              <div class="w-3 h-3 md:w-4 md:h-4 rounded-full bg-primary-yellow mr-1 md:mr-2"></div>
              <span class="text-sm">Female ({{ $femaleStaff }})</span>
            </div>
          </div>
          <p class="mt-3 md:mt-4 text-center font-bold text-base md:text-xl">
            Total: {{ $totalStaff }} Staff Members
          </p>
        </div>
      </div>
    </div>

<!-- Hidden inputs for JS -->
<input type="hidden" id="male-students-count" value="{{ $maleStudents }}">
<input type="hidden" id="female-students-count" value="{{ $femaleStudents }}">
<input type="hidden" id="male-staff-count" value="{{ $maleStaff }}">
<input type="hidden" id="female-staff-count" value="{{ $femaleStaff }}">

{{-- Attendance section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-4 md:mb-6">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6">
        <h2 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">
          Student Attendance 
          <small class="text-gray-500 text-sm">
            ({{ request('week') === 'previous' ? 'Previous Week' : 'Current Week' }})
          </small>
        </h2>
        <div class="flex justify-center space-x-2 mb-4">
          <a href="{{ route('admin.dashboard', ['week' => 'previous']) }}" class="px-3 py-1 bg-primary-accent text-white rounded text-sm {{ request('week') === 'previous' ? 'opacity-100' : 'opacity-70' }}">
            Previous Week
          </a>
          <a href="{{ route('admin.dashboard') }}" class="px-3 py-1 bg-primary-accent text-white rounded text-sm {{ request('week') !== 'previous' ? 'opacity-100' : 'opacity-70' }}">
            Current Week
          </a>
        </div>
        
        <div class="h-56 md:h-64">
          <div class="h-44 md:h-52">
            <canvas id="studentAttendanceChart"></canvas>
          </div>
          <div class="flex flex-wrap justify-center mt-3 md:mt-4 gap-2 md:gap-4">
            <div class="flex items-center">
              <div class="w-3 h-3 rounded-sm bg-primary-present mr-1"></div>
              <span class="text-xs">Present</span>
            </div>
            <div class="flex items-center">
              <div class="w-3 h-3 rounded-sm bg-primary-absent mr-1"></div>
              <span class="text-xs">Absent</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Report Generation section --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6">
      <h2 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Report Generation</h2>
      <div class="flex flex-col items-center lg:mt-16">
        <p class="text-gray-600 dark:text-gray-400 mb-4 text-sm md:text-base text-center">Generate comprehensive reports for your institution</p>
        
        <button id="generate-report" class="bg-primary-accent text-white px-4 py-2 md:px-6 md:py-3 rounded-lg font-medium shadow-md hover:bg-opacity-90 transition-all duration-300 flex items-center mb-4 md:mb-6 text-sm md:text-base">
          <i class="fas fa-file-alt mr-2"></i>
          Generate Report
        </button>
        
        <div class="grid grid-cols-3 gap-2 md:gap-4 w-full max-w-lg">
          <button class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-2 py-1 md:px-4 md:py-2 rounded-lg font-medium shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-300 flex items-center justify-center text-xs md:text-sm">
            <i class="fas fa-file-pdf text-red-500 mr-1 md:mr-2"></i>
            PDF
          </button>
          <button class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-2 py-1 md:px-4 md:py-2 rounded-lg font-medium shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-300 flex items-center justify-center text-xs md:text-sm">
            <i class="fas fa-file-csv text-green-500 mr-1 md:mr-2"></i>
            CSV
          </button>
          <button class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-2 py-1 md:px-4 md:py-2 rounded-lg font-medium shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-300 flex items-center justify-center text-xs md:text-sm">
            <i class="fas fa-file-excel text-green-600 mr-1 md:mr-2"></i>
            Excel
          </button>
        </div>
      </div>
    </div>
    </div>

{{-- Performance section --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 mb-4 md:mb-6">
  <h2 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Student Performance Analysis</h2>

  {{-- Desktop Table View --}}
  <div class="hidden xl:block overflow-x-auto">
    <table class="min-w-full border-collapse">
      <thead>
        <tr class="text-xs md:text-sm border-b dark:border-gray-600">
          <th class="px-2 md:px-4 py-2 text-left border-r dark:border-gray-600">Subject</th>
          @for ($i = 1; $i <= 5; $i++)
            <th class="px-2 md:px-4 py-2 text-center border-r dark:border-gray-600">Grade {{ $i }}</th>
          @endfor
        </tr>
      </thead>
      <tbody class="text-xs md:text-sm">
        @foreach ($performanceData as $subject)
          <tr class="border-b dark:border-gray-700">
            <td class="px-2 md:px-4 py-2 md:py-3 font-medium border-r dark:border-gray-700">{{ $subject['name'] }}</td>
            @for ($i = 1; $i <= 5; $i++)
              <td class="px-2 md:px-4 py-2 md:py-3 text-left border-r dark:border-gray-700">
                @foreach ([$i . 'A', $i . 'B'] as $classroomName)
                  @php
                    $fullClassName = 'Class ' . $classroomName;
                    $score = $subject['grades'][$i][$fullClassName] ?? null;
                  @endphp
                  <div class="mb-2 flex items-center gap-2">
                    <span class="w-8">{{ $classroomName }}</span>
                    @if ($score !== null)
                      <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 md:h-2.5">
                        <div class="{{ $score >= 80 ? 'bg-primary-performance-high' : ($score >= 70 ? 'bg-primary-performance-medium' : 'bg-primary-performance-low') }} h-1.5 md:h-2.5 rounded-full" style="width: {{ $score }}%"></div>
                      </div>
                      <span class="w-8 text-right">{{ $score }}</span>
                    @else
                      <span class="text-gray-500">-</span>
                    @endif
                  </div>
                @endforeach
              </td>
            @endfor
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- Mobile / Tablet Card View --}}
  <div class="xl:hidden space-y-4">
    @foreach ($performanceData as $subject)
      <div class="border dark:border-gray-700 rounded-lg p-3">
        <h3 class="font-semibold text-sm mb-2">{{ $subject['name'] }}</h3>
        @for ($i = 1; $i <= 5; $i++)
          <div class="mb-2 pb-2 border-b dark:border-gray-600 last:border-0 last:pb-0">
            <p class="font-medium text-xs mb-1">Grade {{ $i }}</p>
            @foreach ([$i . 'A', $i . 'B'] as $classroomName)
              @php
                $fullClassName = 'Class ' . $classroomName;
                $score = $subject['grades'][$i][$fullClassName] ?? null;
              @endphp
              <div class="mb-2 flex items-center gap-2">
                <span class="w-8 text-xs">{{ $classroomName }}</span>
                @if ($score !== null)
                  <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                    <div class="{{ $score >= 80 ? 'bg-primary-performance-high' : ($score >= 70 ? 'bg-primary-performance-medium' : 'bg-primary-performance-low') }} h-1.5 rounded-full" style="width: {{ $score }}%"></div>
                  </div>
                  <span class="w-8 text-right text-xs">{{ $score }}</span>
                @else
                  <span class="text-gray-500 text-xs">-</span>
                @endif
              </div>
            @endforeach
          </div>
        @endfor
      </div>
    @endforeach
  </div>

  {{-- Legend --}}
  <div class="flex flex-wrap justify-center mt-4 md:mt-6 gap-2 md:gap-6">
    <div class="flex items-center">
      <div class="w-3 h-3 md:w-4 md:h-4 rounded-sm bg-primary-performance-high mr-1 md:mr-2"></div>
      <span class="text-xs md:text-sm">High (80-100)</span>
    </div>
    <div class="flex items-center">
      <div class="w-3 h-3 md:w-4 md:h-4 rounded-sm bg-primary-performance-medium mr-1 md:mr-2"></div>
      <span class="text-xs md:text-sm">Medium (70-79)</span>
    </div>
    <div class="flex items-center">
      <div class="w-3 h-3 md:w-4 md:h-4 rounded-sm bg-primary-performance-low mr-1 md:mr-2"></div>
      <span class="text-xs md:text-sm">Low (Below 70)</span>
    </div>
  </div>
</div>

    <div id="success-notification" class="hidden mt-4 md:mt-6 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 px-3 py-2 md:px-4 md:py-3 rounded-lg w-full max-w-lg flex items-center text-xs md:text-sm">
      <i class="fas fa-check-circle text-green-500 mr-2"></i>
      <span>Your report has been generated successfully!</span>
    </div>

  {{-- Attendance Data for JS --}}
<input type="hidden" id="attendance-present-data" value="{{json_encode($attendanceData['present'] ?? [85, 90, 80, 75, 70])}}">
<input type="hidden" id="attendance-absent-data" value="{{json_encode($attendanceData['absent'] ?? [15, 10, 20, 25, 30])}}">
@endsection