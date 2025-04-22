@extends('layouts.student')

@section('title', 'Resources Page')

@section('content')
{{-- page header --}}
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg">
  <section class="animate-fade-in mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Educational Resources</h1>
        <p class="text-gray-600 dark:text-gray-300">Access learning materials from your teachers</p>
      </div>
    </div>
  </section>

  {{-- Teacher Cards Section --}}
  <section class="animate-fade-in mb-8" style="animation-delay: 100ms;">
    <h2 class="text-xl font-semibold mb-4">Your Teachers</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      @forelse($teachers as $index => $teacher)
        <div class="teacher-card {{ $index === 0 ? 'teacher-card-active' : '' }}" data-teacher="{{ $teacher->id }}">
          <div class="p-4">
            <div class="flex items-center mb-3">
              <div class="bg-blue/10 dark:bg-blue/20 p-3 rounded-full mr-3">
                @if($teacher->subjects->isNotEmpty())
                  @php
                    $subjectIcons = [
                      'Mathematics' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />',
                      'Physics' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />',
                      'Chemistry' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />',
                      'Biology' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />',
                      'History' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                      'Literature' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
                    ];
                    $subjectName = $teacher->subjects->first()->name ?? '';
                    $iconPath = $subjectIcons[$subjectName] ?? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />';
                  @endphp
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    {!! $iconPath !!}
                  </svg>
                @else
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                @endif
              </div>
              <div>
                <h3 class="font-medium text-lg">{{ $teacher->first_name }} {{ $teacher->last_name }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                  {{ $teacher->subjects->pluck('name')->implode(', ') ?: 'Teacher' }}
                </p>
              </div>
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-300">
              {{ $teacher->resources->count() }} {{ Str::plural('resource', $teacher->resources->count()) }} available
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center p-8">
          <p class="text-gray-500 dark:text-gray-400">No teachers with resources found.</p>
        </div>
      @endforelse
    </div>
  </section>

  {{-- Resources Section --}}
  <section class="animate-fade-in" style="animation-delay: 150ms;">
    @forelse($teachers as $index => $teacher)
      <div class="teacher-resources {{ $index === 0 ? '' : 'hidden' }}" id="{{ $teacher->id }}-resources">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 md:p-6 mb-6">
          <div class="flex items-center mb-6">
            <div class="bg-blue/10 dark:bg-blue/20 p-3 rounded-full mr-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <div>
              <h2 class="text-xl font-semibold">{{ $teacher->first_name }} {{ $teacher->last_name }}'s Resources</h2>
              <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $teacher->subjects->pluck('name')->implode(', ') ?: 'Teacher' }} - 
                Access all learning materials
              </p>
            </div>
          </div>
          
          @forelse($teacher->groupedResources as $grade => $resources)
            <div class="resource-group">
              <h3 class="grade-header">{{ $grade }}</h3>
              <div class="space-y-4">
                @foreach($resources as $resource)
                  <div class="resource-card">
                    <div class="p-4 flex items-center justify-between w-full ">
                      <div class="resource-icon 
                        @if(Str::contains($resource->file_type, 'pdf'))
                          bg-red-500/10 dark:bg-red-500/20
                        @elseif(Str::contains($resource->file_type, 'video') || Str::contains($resource->file_type, 'mp4'))
                          bg-purple-500/10 dark:bg-purple-500/20
                        @elseif(Str::contains($resource->file_type, 'audio') || Str::contains($resource->file_type, 'mp3'))
                          bg-green-500/10 dark:bg-green-500/20
                        @elseif(Str::contains($resource->file_type, 'image'))
                          bg-yellow-500/10 dark:bg-yellow-500/20
                        @elseif(Str::contains($resource->file_type, 'word') || Str::contains($resource->file_type, 'document'))
                          bg-blue-500/10 dark:bg-blue-500/20
                        @elseif(Str::contains($resource->file_type, 'excel') || Str::contains($resource->file_type, 'spreadsheet'))
                          bg-green-500/10 dark:bg-green-500/20
                        @elseif(Str::contains($resource->file_type, 'presentation') || Str::contains($resource->file_type, 'powerpoint'))
                          bg-orange-500/10 dark:bg-orange-500/20
                        @else
                          bg-gray-500/10 dark:bg-gray-500/20
                        @endif
                      ">
                        @if(Str::contains($resource->file_type, 'pdf'))
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                          </svg>
                        @elseif(Str::contains($resource->file_type, 'video') || Str::contains($resource->file_type, 'mp4'))
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                          </svg>
                        @elseif(Str::contains($resource->file_type, 'audio') || Str::contains($resource->file_type, 'mp3'))
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                          </svg>
                        @elseif(Str::contains($resource->file_type, 'image'))
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                          </svg>
                        @else
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                          </svg>
                        @endif
                      </div>
                      <div class="flex-1">
                        <h4 class="font-medium">{{ $resource->title }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $resource->description }}</p>
                        <div class="flex flex-wrap gap-1 mt-2">
                          @foreach($resource->tags as $tag)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                              {{ $tag->tag_name }}
                            </span>
                          @endforeach
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                          Uploaded: {{ $resource->created_at->format('F j, Y') }} • Size: {{ $resource->file_size }} • Downloads: {{ $resource->downloads }}
                        </p>
                      </div>
                      <div class="ml-4 flex items-center">
                        <a href="{{ route('student.resource.download', $resource->id) }}" class="download-btn">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                          </svg>
                          Download
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @empty
            <div class="text-center p-8">
              <p class="text-gray-500 dark:text-gray-400">No resources available from this teacher.</p>
            </div>
          @endforelse
        </div>
      </div>
    @empty
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center">
        <p class="text-gray-500 dark:text-gray-400">No resources available at this time.</p>
      </div>
    @endforelse
  </section>
</main>
@endsection