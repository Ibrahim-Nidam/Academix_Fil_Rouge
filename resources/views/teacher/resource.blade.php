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

  {{-- Upload Modal  --}}
  <div id="uploadModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black bg-opacity-50" id="modalOverlay"></div>
    <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full mx-4 p-6 animate-fade-in">
      <button id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      
      <h2 class="text-2xl font-bold mb-4">Upload New Resource</h2>
      
      <div id="uploadArea" class="upload-area mb-4">
        <div id="uploadIdle" class="flex flex-col items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
          </svg>
          <p class="text-lg font-medium mb-2">Drag and drop files here</p>
          <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">or click to browse</p>
          <input type="file" id="fileInput" class="hidden" multiple accept=".pdf,.docx,.pptx,.xlsx,.mp4,.mp3">
          <button id="browseBtn" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Browse Files</button>
        </div>
        
        <div id="uploadProgress" class="hidden w-full">
          <div class="flex items-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <div class="flex-1">
              <div class="flex justify-between mb-1">
                <span id="fileName" class="text-sm font-medium">document.pdf</span>
                <span id="fileSize" class="text-sm text-gray-500 dark:text-gray-400">2.5 MB</span>
              </div>
              <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                <div id="progressBar" class="bg-gold h-2.5 rounded-full animate-progress" style="width: 0%"></div>
              </div>
            </div>
          </div>
          <p id="uploadStatus" class="text-sm text-gray-500 dark:text-gray-400 text-center mt-4">Uploading... 0%</p>
        </div>
        
        <div id="uploadSuccess" class="hidden flex flex-col items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <p class="text-lg font-medium mb-2">Upload Complete!</p>
          <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Your file has been uploaded successfully.</p>
          <button id="uploadAnotherBtn" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Upload Another File</button>
        </div>
      </div>
      
      <div class="mt-6 flex justify-end gap-3">
        <button id="cancelUploadBtn" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Cancel</button>
        <button id="confirmUploadBtn" class="px-4 py-2 bg-gold text-white rounded-lg hover:bg-gold/90 transition-colors">Upload</button>
      </div>
    </div>
  </div>

  
@endsection