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

    {{-- Student stats section --}}
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate-fade-in mb-8" style="animation-delay: 100ms;">
        {{-- Total Students Distribution --}}
        <div class="data-card">
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998a12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
            </svg>
            Students Across All Classes
            </h2>
            <div class="relative h-64 w-full flex items-center justify-center">
                <canvas id="studentChart" class="z-50"></canvas>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 bg-white dark:bg-gray-800 rounded-full w-16 h-16 md:w-20 md:h-20 flex items-center justify-center">
                    <i class="fas fa-user-graduate text-3xl md:text-4xl text-primary-accent"></i>
                </div>
            </div>
            <div class="flex justify-center gap-6 mt-4">
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-maleBlue"></div>
                    <span class="text-sm">Male (65)</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-femaleGold"></div>
                    <span class="text-sm">Female (55)</span>
                </div>
            </div>
            <div class="mt-4 text-center">
                <p class="text-2xl font-bold">120</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Students</p>
            </div>
        </div>

    {{-- Top & Lowest Performers --}}
    <div class="data-card">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Student Performance
            </h2>
            <div class="flex gap-2">
                <select id="classSelector" class="text-xs py-1 px-3 bg-gray-200 dark:bg-gray-700 rounded-md">
                <option value="math">Class A</option>
                </select>
            </div>
        </div>
        
        <div class="flex justify-center gap-2 mb-4">
            <button id="topPerformersBtn" class="toggle-btn toggle-btn-active">Top Performers</button>
            <button id="lowestPerformersBtn" class="toggle-btn toggle-btn-inactive">Lowest Performers</button>
        </div>
        
        {{-- Top Performers List --}}
        <div id="topPerformers" class="animate-slide-up">
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 mb-3 flex items-center">
                <div class="text-2xl mr-3">🥇</div>
                <div class="flex-1">
                <h3 class="font-medium">Alicia Carter</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Advanced Mathematics</p>
                </div>
                <div class="text-lg font-bold text-green-600 dark:text-green-400">95%</div>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 mb-3 flex items-center">
                <div class="text-2xl mr-3">🥈</div>
                <div class="flex-1">
                <h3 class="font-medium">Mark Evans</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Advanced Mathematics</p>
                </div>
                <div class="text-lg font-bold text-green-600 dark:text-green-400">92%</div>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 flex items-center">
                <div class="text-2xl mr-3">🥉</div>
                <div class="flex-1">
                <h3 class="font-medium">Sophia Green</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Advanced Mathematics</p>
                </div>
                <div class="text-lg font-bold text-green-600 dark:text-green-400">89%</div>
            </div>
        </div>
        
        {{-- Lowest Performers List --}}
        <div id="lowestPerformers" class="hidden animate-slide-down">
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 mb-3 flex items-center">
                <div class="text-2xl mr-3">📉</div>
                <div class="flex-1">
                <h3 class="font-medium">Jake Thompson</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Advanced Mathematics</p>
                </div>
                <div class="text-lg font-bold text-red-600 dark:text-red-400">45%</div>
            </div>
            
        </div>
    </div>
    </section>

    {{-- Today's Classes Section --}}
    <section class="animate-fade-in mb-8" style="animation-delay: 200ms;">
    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Today's Assigned Classes
    </h2>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        
        <div class="class-card" data-class="physics">
        <div class="flex justify-between items-start mb-2">
            <h3 class="text-lg font-semibold">Physics 101</h3>
            <span class="text-sm font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-2 py-1 rounded-md">09:00 - 10:30 AM</span>
        </div>
        
        <div class="flex items-center gap-4 mb-3">
            <div class="flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-maleBlue" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm">15</span>
            </div>
            
            <div class="flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-femaleGold" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm">12</span>
            </div>
            
            <div class="flex items-center gap-1 ml-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gold" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <span class="text-sm font-medium">78%</span>
            </div>
        </div>
        
        <div class="w-full bg-gray-200 dark:bg-gray-700 h-2 rounded-full overflow-hidden">
            <div class="bg-blue-500 h-full rounded-full" style="width: 78%"></div>
        </div>
        </div>
    </div>
    </section>
</main>
@endsection
