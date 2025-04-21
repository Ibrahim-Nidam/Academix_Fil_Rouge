@extends('layouts.teacher')

@section('title', 'Resources Page')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg md:p-6 lg:p-8">
  {{-- Header Section --}}
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

  {{-- Filter & Search Section --}}
  <section class="animate-fade-in mb-6" style="animation-delay: 100ms;">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 flex flex-col md:flex-row md:items-center gap-4">
      <div class="relative flex-1">
        <input type="text" id="searchInput" placeholder="Search resources..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </div>
      
      <div class="flex gap-2">
        <select id="typeFilter" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold">
          <option value="">All Types</option>
          <option value="pdf">PDF</option>
          <option value="docx">Word</option>
          <option value="pptx">PowerPoint</option>
          <option value="xlsx">Excel</option>
          <option value="video">Video</option>
        </select>
        
        <select id="sortBy" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gold">
          <option value="newest">Newest First</option>
          <option value="oldest">Oldest First</option>
          <option value="name">Name (A-Z)</option>
        </select>
      </div>
    </div>
  </section>

  {{-- Resources Grid --}}
  <section class="animate-fade-in mb-8" style="animation-delay: 200ms;">
    <div id="resourcesContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      @foreach($resources as $resource)
      <div class="resource-card group relative bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 hover:shadow-lg transition-shadow duration-300 cursor-pointer" data-resource-id="{{ $resource->id }}">
        <div class="flex items-start gap-3">
          <div class="file-type-icon bg-{{ $resource->file_type === 'pdf' ? 'red' : 'blue' }}-500 p-2 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="font-medium text-lg truncate">{{ $resource->title }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Added {{ $resource->created_at->format('M d, Y') }}</p>
            <div class="mt-2 flex flex-wrap gap-2">
              @foreach($resource->tags as $tag)
              <span class="text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-md">{{ $tag->tag_name }}</span>
              @endforeach
            </div>
          </div>
        </div>
        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <button class="p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 resource-menu-btn">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
            </svg>
          </button>
        </div>
      </div>
      @endforeach
    </div>
  </section>
</main>

{{-- Upload Modal --}}
<div id="uploadModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
  <div class="absolute inset-0 bg-black bg-opacity-50 modal-overlay"></div>
  <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full mx-4 p-6 animate-fade-in">
    <button id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
    
    <h2 class="text-2xl font-bold mb-4">Upload New Resource</h2>
    
    <form id="uploadForm" enctype="multipart/form-data">
      <input type="hidden" id="resourceId" name="id" value="">
      <div class="upload-area mb-4">
        <div id="uploadIdle" class="flex flex-col items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
          </svg>
          <p class="text-lg font-medium mb-2">Drag and drop files here</p>
          <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">or click to browse</p>
          <input type="file" id="fileInput" class="hidden" name="file">
          <button type="button" id="browseBtn" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Browse Files</button>
        </div>
        
        <div id="uploadProgress" class="hidden w-full">
          <div class="flex items-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <div class="flex-1">
              <div class="flex justify-between mb-1">
                <span id="fileName" class="text-sm font-medium"></span>
                <span id="fileSize" class="text-sm text-gray-500 dark:text-gray-400"></span>
              </div>
              <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                <div id="progressBar" class="bg-gold h-2.5 rounded-full" style="width: 0%"></div>
              </div>
            </div>
          </div>
          <p id="uploadStatus" class="text-sm text-gray-500 dark:text-gray-400 text-center mt-4"></p>
        </div>
      </div>
      
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium mb-1">Title</label>
          <input type="text" id="inputResourceTitle" name="title" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700" required>
        </div>
        
        <div>
          <label class="block text-sm font-medium mb-1">Description</label>
          <textarea id="resourceDescription" name="description" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700" rows="3"></textarea>
        </div>
        
        <div>
          <label class="block text-sm font-medium mb-1">Tags (comma-separated)</label>
          <input type="text" id="resourceTags" name="tags" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700">
        </div>
      </div>

      <div class="mt-6 flex justify-end gap-3">
        <button type="button" id="cancelUploadBtn" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-gold text-white rounded-lg hover:bg-gold/90 transition-colors">Upload</button>
      </div>
    </form>
  </div>
</div>

{{-- Resource Details Modal --}}
<div id="resourceModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
  <div class="absolute inset-0 bg-black bg-opacity-50 modal-overlay"></div>
  <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full mx-4 p-6 animate-fade-in">
    <button id="closeResourceModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
    
    <div class="flex items-start gap-4 mb-6">
      <div id="resourceIcon" class="file-type-icon bg-red-500 p-2 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
        </svg>
      </div>
      <div>
        <h2 id="modalResourceTitle" class="text-2xl font-bold"></h2>
        <p id="resourceDate" class="text-sm text-gray-500 dark:text-gray-400"></p>
      </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
      <div class="bg-gray-100 dark:bg-gray-700 rounded-xl p-4">
        <h3 class="font-medium mb-2">File Details</h3>
        <div class="grid grid-cols-2 gap-2 text-sm">
          <span class="text-gray-500 dark:text-gray-400">Type:</span>
          <span id="resourceType"></span>
          <span class="text-gray-500 dark:text-gray-400">Size:</span>
          <span id="resourceSize"></span>
          <span class="text-gray-500 dark:text-gray-400">Uploaded:</span>
          <span id="resourceUploadDate"></span>
        </div>
      </div>
      
      <div class="bg-gray-100 dark:bg-gray-700 rounded-xl p-4">
        <h3 class="font-medium mb-2">Usage</h3>
        <div class="grid grid-cols-2 gap-2 text-sm">
          <span class="text-gray-500 dark:text-gray-400">Downloads:</span>
          <span id="resourceDownloads"></span>
        </div>
      </div>
    </div>
    
    <div class="mb-6">
      <h3 class="font-medium mb-2">Description</h3>
      <p id="resourceDescription" class="text-sm text-gray-600 dark:text-gray-300"></p>
    </div>
    
    <div class="mb-6">
      <h3 class="font-medium mb-2">Tags</h3>
      <div id="resourceTags" class="flex flex-wrap gap-2"></div>
    </div>
    
    <div class="flex justify-between">
      <div>
        <button type="button" class="btn btn-outline flex items-center gap-2" id="editResourceBtn">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
          </svg>
          Edit
        </button>
      </div>
      <div class="flex gap-3">
        <button type="button" class="btn btn-outline flex items-center gap-2 text-red-500 dark:text-red-400 border-red-500 dark:border-red-400 hover:bg-red-50 dark:hover:bg-red-900/20" id="deleteResourceBtn">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          Delete
        </button>
        <button type="button" class="btn btn-primary flex items-center gap-2" id="downloadResourceBtn">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
          </svg>
          Download
        </button>
      </div>
    </div>
  </div>
</div>
@endsection