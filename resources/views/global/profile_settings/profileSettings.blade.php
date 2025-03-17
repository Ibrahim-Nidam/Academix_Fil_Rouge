@extends('layouts.admin')

@section('title', 'Profile Settings')

@include('global.profile_settings.styles')

@section('content')
{{-- header page --}}
    <div class="flex-1 p-5 px-16">
        <div class="mb-10 flex items-center gap-6 flex-wrap">
            <h1 class="text-4xl font-bold text-primary-blue dark:text-primary-text-dark">Good Morning</h1>
            <h2 class="text-2xl text-gray-500 dark:text-gray-400 mt-1">Mr. Johnson Maduka</h2>
        </div>
        {{-- security & info buttons --}}
        <div class="md:ml-20">
            <div class="border-b border-gray-200 dark:border-gray-700 mb-10">
                <div class="flex space-x-10">
                    <a href="{{route('global.profile_settings.profileSettings')}}" class="tab-active py-4 px-1 font-medium dark:text-primary-text-dark">Edit Profile</a>
                    <a href="{{route('global.profile_settings.security')}}" class="tab-inactive py-4 px-1 font-medium dark:text-primary-text-dark">Security</a>
                </div>
            </div>
            
            
        </div>
    </div>
@endsection