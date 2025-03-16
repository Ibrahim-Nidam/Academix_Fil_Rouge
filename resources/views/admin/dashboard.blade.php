@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
  <div class="flex flex-col flex-1 p-4 md:p-6 w-full">

{{-- WELCOME SECTION --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 md:p-6 mb-4 md:mb-6">
      <h1 class="text-2xl md:text-3xl font-bold">Welcome back, <span class="text-primary-accent">Dr. Smith</span></h1>
      <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm md:text-base">
        <span id="current-date">Monday, March 6, 2025</span> • 
        <span class="italic">Here's an overview of today's progress</span>
      </p>
    </div>

    


  </div>
@endsection