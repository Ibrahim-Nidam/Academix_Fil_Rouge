<!DOCTYPE html>
<html lang="en" class="{{ request()->cookie('dark_mode') ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Administrator Dashboard for managing the platform efficiently.">
    <meta name="keywords" content="admin, dashboard, management, school">
    <meta name="author" content="Ibrahim Nidam">

    <title>@yield('title', 'Administrator Dashboard')</title>

    <link rel="icon" href="{{ asset('images/Favicon/favicon-32x32.png') }}" type="image/x-icon">
    @include('partials.admin.styles')

</head>
<body class="bg-primary-light dark:bg-primary-dark text-primary-text-light dark:text-primary-text-dark flex">
    @include('global.sidebar.sidebar')

    <div class="flex flex-col flex-1 md:ml-20 p-4 md:p-6 w-full">
        @yield('content')
    </div>

    @if(Route::currentRouteName() == 'admin.dashboard')
        @include('partials.admin.js.dashScript')
    @elseif(in_array(Route::currentRouteName(), ['admin.importData', 'admin.import.preview']))
        @include('partials.admin.js.importScript')
    @elseif(Route::currentRouteName() == 'admin.usersPage')
        @include('partials.admin.js.userScript')
    @elseif(Route::currentRouteName() == 'admin.planningPage')
        @include('partials.admin.js.planningScript')
    @endif

    @include('global.sidebar.js.side&ThemeMode')
    @include('global.profile_settings.js.settings')
</body>
</html>