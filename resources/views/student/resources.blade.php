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

</main>
@endsection