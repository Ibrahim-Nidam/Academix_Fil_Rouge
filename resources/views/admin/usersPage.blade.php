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
          <form method="GET" action="{{ route('admin.usersPage') }}" class="flex flex-wrap gap-2 mt-2 md:mt-0">
            <div class="relative">
              <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}" class="pl-8 pr-4 py-1 rounded-md bg-gray-100 dark:bg-gray-700 border-none text-sm">
              <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <select name="role" class="bg-gray-100 dark:bg-gray-700 border-none rounded px-2 py-1 text-sm" onchange="this.form.submit()">
              <option value="all" {{ request('role') == 'all' ? 'selected' : '' }}>All Roles</option>
              <option value="Teacher" {{ request('role') == 'Teacher' ? 'selected' : '' }}>Teachers</option>
              <option value="Student" {{ request('role') == 'Student' ? 'selected' : '' }}>Students</option>
              <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admins</option>
            </select>
          </form>
        </div>
        
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
              <tr class="text-xs md:text-sm">
                <th class="px-3 py-2 text-left font-medium">Name</th>
                <th class="px-3 py-2 text-left font-medium">Email</th>
                <th class="px-3 py-2 text-left font-medium">Role</th>
                <th class="px-3 py-2 text-left font-medium">Gender</th>
                <th class="px-3 py-2 text-left font-medium">Status</th>
                <th class="px-3 py-2 text-left font-medium">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-xs md:text-sm">
              @foreach($users as $user)
              <tr class="table-row-hover" data-user-id="{{ $user->id }}" data-gender="{{ $user->gender }}">
                <td class="px-3 py-3">
                  <div class="flex items-center">
                    <div class="h-8 w-8 rounded-full bg-primary-accent text-white flex items-center justify-center mr-3">
                      <span>{{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}</span>
                    </div>
                    <span data-first-name="{{ $user->first_name }}" data-last-name="{{ $user->last_name }}">
                      {{ $user->first_name }} {{ $user->last_name }}
                    </span>
                  </div>
                </td>
                <td class="px-3 py-3">{{ $user->email }}</td>
                <td class="px-3 py-3">
                  <span class="badge {{ $user->role === 'Teacher' ? 'badge-blue' : ($user->role === 'Student' ? 'badge-green' : 'badge-gray') }}">
                    {{ $user->role }}
                  </span>
                </td>
                <td class="px-3 py-3">
                  <span class="badge badge-gray">
                    {{ $user->gender }}
                  </span>
                </td>
                <td class="px-3 py-3">
                  <span class="badge text-nowrap {{ $user->status === 'Active' ? 'badge-green' : 'badge-red' }}">
                    {{ ucfirst($user->status) }}
                  </span>
                </td>
                <td class="px-3 py-3 text-right flex-nowrap flex">
                  <button type="button" class="edit-user-btn btn btn-sm btn-secondary mr-1" data-user-id="{{ $user->id }}">
                    <i class="fas fa-edit"></i>
                  </button>
                  <form class="delete-user-form inline" method="POST" action="{{ route('user.destroy', $user->id) }}">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="delete-user-btn btn btn-sm btn-danger" data-user-id="{{ $user->id }}">
                          <i class="fas fa-trash"></i>
                      </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{-- Pagination --}}
        <div class="flex flex-wrap justify-between items-center mt-4">
          <div class="text-sm text-gray-600 dark:text-gray-400 mb-2 md:mb-0">
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
          </div>
          <div class="flex space-x-1">
            {{ $users->appends(request()->input())->links('vendor.pagination.custom') }}
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
        
        <form id="user-form" method="POST" action="">
          @csrf
          <input type="hidden" id="user-id" name="user_id" value="">
          
          <div class="mb-4">
            <label for="first-name" class="form-label">First Name</label>
            <input type="text" id="first-name" name="first_name" class="form-input" placeholder="First Name" required>
          </div>
          
          <div class="mb-4">
            <label for="last-name" class="form-label">Last Name</label>
            <input type="text" id="last-name" name="last_name" class="form-input" placeholder="Last Name" required>
          </div>
          
          <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="Email Address" required>
          </div>
          
          <div class="mb-4">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select" required>
              <option value="">Select Role</option>
              <option value="Teacher">Teacher</option>
              <option value="Student">Student</option>
              <option value="Admin">Admin</option>
            </select>
          </div>

          <div class="mb-4">
            <label for="Gender" class="form-label">Gender</label>
            <select id="Gender" name="gender" class="form-select" required>
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          
          <div class="mb-4">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
              <option value="">Select Status</option>
              <option value="Active">Active</option>
              <option value="Not Active">Not Active</option>
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
        <button type="button" class="btn btn-secondary delete-modal-close">Cancel</button>
        <button type="button" id="confirm-delete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
@endsection