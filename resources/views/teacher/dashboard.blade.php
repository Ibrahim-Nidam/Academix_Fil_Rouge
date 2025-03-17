@extends('layouts.teacher')

@section('title', 'Teacher Dashboard')

@section('content')

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-lightBg p-4 transition-colors duration-300 dark:bg-darkBg md:p-6 lg:p-8">
    {{-- page header --}}
    <section class="animate-fade-in mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Good morning, <span class="text-gold">Mr. Johnson</span>!</h1>
            <p class="text-gray-600 dark:text-gray-300" id="currentDate">Here's your daily overview</p>
        </div>
    </section>

</main>
@endsection
