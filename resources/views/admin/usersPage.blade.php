@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
  <div class="flex flex-col flex-1 w-full">

{{-- pagea header --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 mb-4 md:mb-6">
      <div class="flex flex-wrap justify-between items-center">
        <div>
          <h1 class="text-2xl md:text-3xl font-bold">Users Management</h1>
          <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm md:text-base">
            View and manage user accounts
          </p>
        </div>
        <button id="add-user-btn" class="btn btn-primary mt-2 md:mt-0 flex items-center">
          <i class="fas fa-plus mr-2"></i>
          Add User
        </button>
      </div>
    </div>

@endsection