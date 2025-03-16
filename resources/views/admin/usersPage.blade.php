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

{{-- Edit User Form  --}}
      <div id="edit-form-container" class="hidden bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 lg:w-1/3 transition-all duration-300 ease-in-out">
        <div class="flex justify-between items-center mb-4">
          <h2 id="form-title" class="text-lg md:text-xl font-semibold">Edit User</h2>
          <button id="close-form-btn" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <i class="fas fa-times"></i>
          </button>
        </div>
        
        <form id="user-form">
          <input type="hidden" id="user-id" value="">
          
          <div class="mb-4">
            <label for="first-name" class="form-label">First Name</label>
            <input type="text" id="first-name" class="form-input" placeholder="First Name">
          </div>
          
          <div class="mb-4">
            <label for="last-name" class="form-label">Last Name</label>
            <input type="text" id="last-name" class="form-input" placeholder="Last Name">
          </div>
          
          <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-input" placeholder="Email Address">
          </div>
          
          <div class="mb-4">
            <label for="role" class="form-label">Role</label>
            <select id="role" class="form-select">
              <option value="teacher">Teacher</option>
              <option value="student">Student</option>
            </select>
          </div>
          
          <div class="mb-4">
            <label for="status" class="form-label">Status</label>
            <select id="status" class="form-select">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
          
          <div id="teacher-fields" class="mb-4">
            <label for="department" class="form-label">Department</label>
            <select id="department" class="form-select">
              <option value="mathematics">Mathematics</option>
              <option value="science">Science</option>
              <option value="english">English</option>
              <option value="history">History</option>
              <option value="art">Art</option>
            </select>
          </div>
          
          <div id="student-fields" class="mb-4 hidden">
            <label for="grade" class="form-label">Grade</label>
            <select id="grade" class="form-select">
              <option value="9">Grade 9</option>
              <option value="10">Grade 10</option>
              <option value="11">Grade 11</option>
              <option value="12">Grade 12</option>
            </select>
          </div>
          
          <div class="flex justify-end space-x-2 mt-6">
            <button type="button" id="cancel-btn" class="btn btn-secondary">Cancel</button>
            <button type="submit" id="save-btn" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

{{-- Mobile Edit Form Modal --}}
  <div id="mobile-edit-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 w-full max-w-md max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center mb-4">
        <h2 id="mobile-form-title" class="text-lg font-semibold">Edit User</h2>
        <button id="close-mobile-modal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <form id="mobile-user-form">
        <input type="hidden" id="mobile-user-id" value="">
        
        <div class="mb-4">
          <label for="mobile-first-name" class="form-label">First Name</label>
          <input type="text" id="mobile-first-name" class="form-input" placeholder="First Name">
        </div>
        
        <div class="mb-4">
          <label for="mobile-last-name" class="form-label">Last Name</label>
          <input type="text" id="mobile-last-name" class="form-input" placeholder="Last Name">
        </div>
        
        <div class="mb-4">
          <label for="mobile-email" class="form-label">Email</label>
          <input type="email" id="mobile-email" class="form-input" placeholder="Email Address">
        </div>
        
        <div class="mb-4">
          <label for="mobile-role" class="form-label">Role</label>
          <select id="mobile-role" class="form-select">
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
          </select>
        </div>
        
        <div class="mb-4">
          <label for="mobile-status" class="form-label">Status</label>
          <select id="mobile-status" class="form-select">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
        
        <div id="mobile-teacher-fields" class="mb-4">
          <label for="mobile-department" class="form-label">Department</label>
          <select id="mobile-department" class="form-select">
            <option value="mathematics">Mathematics</option>
            <option value="science">Science</option>
            <option value="english">English</option>
            <option value="history">History</option>
            <option value="art">Art</option>
          </select>
        </div>
        
        <div id="mobile-student-fields" class="mb-4 hidden">
          <label for="mobile-grade" class="form-label">Grade</label>
          <select id="mobile-grade" class="form-select">
            <option value="9">Grade 9</option>
            <option value="10">Grade 10</option>
            <option value="11">Grade 11</option>
            <option value="12">Grade 12</option>
          </select>
        </div>
        
        <div class="flex justify-end space-x-2 mt-6">
          <button type="button" id="mobile-cancel-btn" class="btn btn-secondary">Cancel</button>
          <button type="submit" id="mobile-save-btn" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Delete Confirmation Modal --}}
  <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 w-full max-w-md">
      <div class="text-center mb-4">
        <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-red-100 dark:bg-red-900 text-red-500 mb-4">
          <i class="fas fa-exclamation-triangle text-2xl"></i>
        </div>
        <h3 class="text-lg md:text-xl font-medium mb-2">Delete User Account</h3>
        <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base">
          Are you sure you want to delete this user account? This action cannot be undone.
        </p>
      </div>
      <div class="flex justify-center space-x-3">
        <button id="cancel-delete" class="btn btn-secondary">Cancel</button>
        <button id="confirm-delete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>

{{-- Success Notification --}}
  <div id="success-toast" class="fixed bottom-4 right-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 px-4 py-3 rounded-lg shadow-lg flex items-center z-50 transform translate-y-20 opacity-0 transition-all duration-300">
    <i class="fas fa-check-circle text-green-500 mr-2 text-xl"></i>
    <span id="toast-message">User updated successfully!</span>
  </div>
@endsection