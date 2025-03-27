@extends('layouts.admin')

@section('title', 'Profile Settings')

@include('global.profile_settings.styles')

@section('content')
{{-- header page --}}
    <div class="flex-1 p-5 px-16">
        <div class="mb-10 flex items-center gap-6 flex-wrap">
            <h1 class="text-4xl font-bold text-primary-blue dark:text-primary-text-dark">Good {{now()->hour < 12 ? 'Morning' : 'Evening'}}</h1>
            <h2 class="text-2xl text-gray-500 dark:text-gray-400 mt-1">{{Auth::user()->gender == 'Male' ? 'Mr. ' : 'Ms. '}} {{ucfirst(Auth::user()->first_name) . ' ' . ucfirst(Auth::user()->last_name)}} </h2>
        </div>
        
        <div class="md:ml-20">
            {{-- security & info buttons --}}
            <div class="border-b border-gray-200 dark:border-gray-700 mb-10">
                <div class="flex space-x-10">
                    <a href="{{route('global.profile_settings.profileSettings')}}" class="tab-inactive py-4 px-1 font-medium dark:text-primary-text-dark">Edit Profile</a>
                    <a href="{{route('global.profile_settings.security')}}" class="tab-active py-4 px-1 font-medium dark:text-primary-text-dark">Security</a>
                </div>
            </div>
            
            <div class="max-w-5xl">
                {{-- Two-factor Authentication --}}
                <div class="mb-12">
                    <h3 class="text-xl font-medium text-primary-blue dark:text-primary-text-dark mb-6">
                        Two-factor Authentication
                    </h3>
                    <div class="flex items-center">
                        <div class="relative inline-block w-14 h-6 mr-4 align-middle select-none">
                            <input type="checkbox" id="toggle" class="peer sr-only" checked>
                            <label for="toggle" class="block h-6 rounded-full bg-gray-300 peer-checked:bg-[#4260a6] cursor-pointer"></label>
                            <div class="absolute top-0 left-0 w-6 h-6 bg-white border-4 border-gray-300 rounded-full transition-transform duration-300 transform peer-checked:translate-x-8 peer-checked:border-[#4260a6]"></div>
                        </div>
                        <span class="text-primary-text-light dark:text-primary-text-dark">
                            Enable or disable two factor authentication 
                            <span class="text-primary-present">(COMING SOON)</span>
                        </span>
                    </div>
                </div>
                
                {{-- Change Password form --}}
                <section>
                    <h3 class="text-xl font-medium text-primary-blue dark:text-primary-text-dark mb-6">Change Password</h3>
                    <form action="{{route('profile.pass')}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="currentPassword" class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">Current Password</label>
                            <input type="password" id="currentPassword" placeholder="**********" 
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-setting dark:text-primary-text-dark">
                        </div>
                        
                        <div class="mb-6">
                            <label for="newPassword" class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">New Password</label>
                            <input type="password" id="newPassword" placeholder="**********" 
                            class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-setting dark:text-primary-text-dark">
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-primary-accent hover:bg-opacity-90 text-white font-medium py-3 px-12 rounded-md transition duration-200">
                                Save
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection