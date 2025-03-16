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

{{-- users section --}}
    <div class="flex flex-col lg:flex-row gap-4 md:gap-6">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 flex-1">
        <div class="flex flex-wrap justify-between items-center mb-4">
          <h2 class="text-lg md:text-xl font-semibold">User Accounts</h2>
          
          <div class="flex flex-wrap gap-2 mt-2 md:mt-0">
            <div class="relative">
              <input type="text" placeholder="Search users..." class="pl-8 pr-4 py-1 rounded-md bg-gray-100 dark:bg-gray-700 border-none text-sm">
              <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            
            <select class="bg-gray-100 dark:bg-gray-700 border-none rounded px-2 py-1 text-sm">
              <option value="all">All Roles</option>
              <option value="teacher">Teachers</option>
              <option value="student">Students</option>
            </select>
          </div>
        </div>
        
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
              <tr class="text-xs md:text-sm">
                <th class="px-3 py-2 text-left font-medium">Name</th>
                <th class="px-3 py-2 text-left font-medium">Email</th>
                <th class="px-3 py-2 text-left font-medium">Role</th>
                <th class="px-3 py-2 text-left font-medium">Status</th>
                <th class="px-3 py-2 text-right font-medium">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-xs md:text-sm">
            
              <tr class="table-row-hover" data-user-id="1">
                <td class="px-3 py-3">
                  <div class="flex items-center">
                    <div class="h-8 w-8 rounded-full bg-primary-accent text-white flex items-center justify-center mr-3">
                      <span>JS</span>
                    </div>
                    <span>John Smith</span>
                  </div>
                </td>
                <td class="px-3 py-3">john.smith@example.com</td>
                <td class="px-3 py-3"><span class="badge badge-blue">Teacher</span></td>
                <td class="px-3 py-3"><span class="badge badge-green">Active</span></td>
                <td class="px-3 py-3 text-right">
                  <button class="edit-user-btn btn btn-sm btn-secondary mr-1" data-user-id="1">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="delete-user-btn btn btn-sm btn-danger" data-user-id="1">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
              
            </tbody>
          </table>
        </div>
        
{{-- Pagination --}}
        <div class="flex flex-wrap justify-between items-center mt-4">
          <div class="text-sm text-gray-600 dark:text-gray-400 mb-2 md:mb-0">
            Showing 1 to 6 of 24 entries
          </div>
          <div class="flex space-x-1">
            <button class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">Previous</button>
            <button class="px-3 py-1 rounded bg-primary-accent text-white text-sm">1</button>
            <button class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">2</button>
            <button class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">3</button>
            <button class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">4</button>
            <button class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-sm">Next</button>
          </div>
        </div>
      </div>

@endsection