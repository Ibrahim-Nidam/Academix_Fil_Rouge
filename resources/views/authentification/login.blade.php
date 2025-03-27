<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="login page for the academix application.">
    <meta name="keywords" content="login, user, management, school">
    <meta name="author" content="Ibrahim Nidam">

    <title>Academix || Login</title>
    <link rel="icon" href="{{ asset('images/Favicon/favicon-32x32.png') }}" type="image/x-icon">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="h-screen text-base-content overflow-hidden">
<div id="auth-wrapper" class="flex h-full w-full bg-gray-50">
    <div class="hidden lg:flex lg:w-1/2 bg-black p-12 items-center justify-center">
        <div class="max-w-xl text-center">
        <img class="mx-auto mb-8 w-72 h-72" src="{{ asset('images/Logo/no_bg_logo.png') }}" >
        <p class="text-indigo-100 text-lg">"Unlock Your Future: Learn, Connect, Succeed."</p>
        </div>
    </div>
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6">
        <div class="w-full max-w-md space-y-8">
            <div class="flex space-x-4 border-b border-gray-200">
                <button onclick="toggleForm('signin')" id="signin-tab" class="cursor-pointer px-4 py-2 text-sm font-medium text-black border-b-2 border-black">Sign In</button>
            </div>

            <form id="signin-form" action='{{route('login')}}' method='post' class="space-y-6">
                @csrf
                <div>
                    <label for="login" class="block text-sm font-medium text-gray-700 mb-1">Email address or Username </label>
                    <input type="text" name="login" value="{{old('login')}}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600" placeholder="name@company.com Or JohnDoe">
                    @error('login')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600" placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>
                    <span class="text-sm text-green-600 hover:text-green-500 cursor-pointer">Forgot password?</span>
                </div>
                <button class="w-full cursor-pointer bg-black text-white py-2 px-4 rounded-lg hover:bg-gray-800 focus:ring-4 focus:ring-indigo-200">
                    Sign in
                </button>
            </form>

        </div>
    </div>
</div>
</body>
</html>