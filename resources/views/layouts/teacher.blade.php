<!DOCTYPE html>
<html lang="en" class="{{ request()->cookie('dark_mode') ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Teacher Dashboard for managing the platform efficiently.">
    <meta name="keywords" content="teacher, dashboard, management, class">
    <meta name="author" content="Ibrahim Nidam">

    <title>@yield('title', 'Teacher Dashboard')</title>

    <link rel="icon" href="{{ asset('images/Favicon/favicon-32x32.png') }}" type="image/x-icon">
    @include('partials.teacher.styles')

</head>
<body class="bg-primary-light dark:bg-primary-dark text-primary-text-light dark:text-primary-text-dark flex">
    @include('global.sidebar.sidebar')
    
    <div class="flex flex-col flex-1 md:ml-20 p-4 md:p-6 w-full">
        @yield('content')
    </div>
    
    @if(Route::currentRouteName() == 'teacher.dashboard')
        @include('partials.teacher.js.dashScript')
    @elseif(Route::currentRouteName() == 'teacher.attendance')
        @include('partials.teacher.js.attendanceScript')
    @elseif(Route::currentRouteName() == 'teacher.grades')
        @include('partials.teacher.js.gradesScript')
    @elseif(Route::currentRouteName() == 'teacher.resource')
        @include('partials.teacher.js.resourceScript')
    @endif
    
    @include('global.sidebar.js.side&ThemeMode')
</body>
</html>