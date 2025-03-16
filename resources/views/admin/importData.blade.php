@extends('layouts.admin')

@section('title', 'Import Data')

@section('content')
  <div class="flex flex-col flex-1 w-full">

{{-- Page header --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 mb-4 md:mb-6">
      <h1 class="text-2xl md:text-3xl font-bold">Data Importation</h1>
      <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm md:text-base">
        Upload Excel files containing teacher or student information
      </p>
    </div>

{{-- upload file section --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 mb-4 md:mb-6">
      <h2 class="text-lg md:text-xl font-semibold mb-3 md:mb-4">Upload File</h2>
      <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Select Data Type</label>
        <div class="flex flex-wrap gap-3">
          <label class="relative flex items-center">
            <input type="radio" name="data-type" class="peer sr-only" checked>
            <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded-full peer-checked:border-primary-accent peer-checked:bg-primary-accent"></div>
            <span class="ml-2">Teacher Data</span>
          </label>
          <label class="relative flex items-center">
            <input type="radio" name="data-type" class="peer sr-only">
            <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded-full peer-checked:border-primary-accent peer-checked:bg-primary-accent"></div>
            <span class="ml-2">Student Data</span>
          </label>
        </div>
      </div>
      
      <div id="drop-area" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-primary-accent dark:hover:border-primary-accent transition-colors duration-300 mb-4">
        <div class="flex flex-col items-center justify-center space-y-3">
          <i class="fas fa-file-excel text-5xl text-gray-400 dark:text-gray-500"></i>
          <p class="text-sm md:text-base">Drag and drop your Excel file here, or <span class="text-primary-blue dark:text-primary-yellow font-medium">browse</span></p>
          <p class="text-xs text-gray-500 dark:text-gray-400">Supports .xlsx, .xls and csv files (Max 10MB)</p>
          <input type="file" id="fileInput" class="hidden" accept=".xlsx,.xls,.csv">
          <button id="browse-btn" class="px-4 py-2 bg-primary-blue dark:bg-primary-blue text-white rounded-md hover:bg-opacity-90 transition-colors duration-300 text-sm">
            Select File
          </button>
        </div>
      </div>
    </div>

{{-- selected file info  --}}
    <div id="file-info" class="hidden bg-gray-100 dark:bg-gray-700 rounded-lg p-3 mb-4">
      <div class="flex items-center">
        <i class="fas fa-file-excel text-primary-blue dark:text-primary-yellow mr-3"></i>
        <div class="flex-1">
          <p id="file-name" class="font-medium text-sm md:text-base truncate">example-file.xlsx</p>
          <p id="file-size" class="text-xs text-gray-500 dark:text-gray-400">Size: 2.4 MB</p>
        </div>
        <button id="remove-file" class="text-red-500 hover:text-red-700 dark:hover:text-red-400">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>

    {{-- Import Button --}}
    <div class="flex flex-col md:flex-row gap-3 justify-end">
      <button id="cancel-import" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-300 text-sm md:text-base">
        Cancel
      </button>
      <button id="validate-import" class="px-4 py-2 bg-primary-accent text-white rounded-md hover:bg-opacity-90 transition-colors duration-300 text-sm md:text-base flex items-center justify-center">
        <i class="fas fa-check mr-2"></i>
        Validate & Import
      </button>
    </div>

    <div id="success-notification" class="hidden mt-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 px-3 py-2 rounded-lg flex items-center">
      <i class="fas fa-check-circle text-green-500 mr-2"></i>
      <span>Data imported successfully!</span>
    </div>

  </div>
@endsection
