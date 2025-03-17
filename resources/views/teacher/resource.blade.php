@extends('layouts.teacher')

@section('title', 'Resources Page')

@section('content')
{{-- page header --}}
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg md:p-6 lg:p-8">
      <section class="animate-fade-in mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
          <div>
            <h1 class="text-3xl md:text-4xl font-bold mb-2">My Resources</h1>
            <p class="text-gray-600 dark:text-gray-300">Manage and organize your teaching materials</p>
          </div>
          <div class="mt-4 md:mt-0">
            <button id="uploadBtn" class="btn btn-primary flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
              </svg>
              Upload New Resource
            </button>
          </div>
        </div>
      </section>

      {{-- Filter & Search Section  --}}
      <section class="animate-fade-in mb-6" style="animation-delay: 100ms;">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 flex flex-col md:flex-row md:items-center gap-4">
          <div class="relative flex-1">
            <input type="text" placeholder="Search resources..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
          
          <div class="flex gap-2">
            <select class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold">
              <option value="">All Types</option>
              <option value="document">Documents</option>
              <option value="video">Videos</option>
              <option value="presentation">Presentations</option>
              <option value="other">Other</option>
            </select>
            
            <select class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold">
              <option value="newest">Newest First</option>
              <option value="oldest">Oldest First</option>
              <option value="name">Name (A-Z)</option>
            </select>
          </div>
        </div>
      </section>

      {{-- placeholder Resources Grid  --}}
      <section class="animate-fade-in mb-8" style="animation-delay: 200ms;">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
          <div class="resource-card group" data-resource-id="1">
            <div class="flex items-start gap-3">
              <div class="file-type-icon bg-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
              </div>
              <div class="flex-1 min-w-0">
                <h3 class="font-medium text-lg truncate">Algebra_Basics.pdf</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Added on September 15, 2023</p>
                <div class="mt-2 flex flex-wrap gap-2">
                  <span class="text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-md">Mathematics</span>
                  <span class="text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-md">PDF</span>
                </div>
              </div>
            </div>
            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <button class="p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                </svg>
              </button>
            </div>
          </div>
          
        </div>
      </section>
    </main>
  </div>

  
@endsection