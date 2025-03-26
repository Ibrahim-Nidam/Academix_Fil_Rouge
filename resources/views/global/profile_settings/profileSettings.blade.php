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
        {{-- security & info buttons --}}
        <div class="md:ml-20">
            <div class="border-b border-gray-200 dark:border-gray-700 mb-10">
                <div class="flex space-x-10">
                    <a href="{{route('global.profile_settings.profileSettings')}}" class="tab-active py-4 px-1 font-medium dark:text-primary-text-dark">Edit Profile</a>
                    <a href="{{route('global.profile_settings.security')}}" class="tab-inactive py-4 px-1 font-medium dark:text-primary-text-dark">Security</a>
                </div>
            </div>
            
            <div class="max-w-5xl">
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="flex-shrink-0 justify-center flex">
                        {{-- profile image --}}
                        <div class="relative">
                            <img src="{{ asset('images/Profile/' . (Auth::user()->gender == "Male" ? 'male.svg' : 'female.svg')) }}" alt="Profile" class="w-32 h-32 rounded-full object-cover">
                            <input type="file" name="profile_image" id="profile_image" accept="image/*" class="hidden" />
                            <label for="profile_image" class="absolute bottom-1 right-1 lg:bottom-64 bg-primary-blue text-white rounded-full p-2 shadow-md cursor-pointer">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.5 2.50001C18.8978 2.10219 19.4374 1.87868 20 1.87868C20.5626 1.87868 21.1022 2.10219 21.5 2.50001C21.8978 2.89784 22.1213 3.4374 22.1213 4.00001C22.1213 4.56262 21.8978 5.10219 21.5 5.50001L12 15L8 16L9 12L18.5 2.50001Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </label>
                        </div>
                    </div>
                    {{-- form --}}
                    <div class="flex-grow">
                        <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">First Name</label>
                                    <input type="text" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-setting dark:text-primary-text-dark">
                                </div>
                                
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">Last Name</label>
                                    <input type="text" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-setting dark:text-primary-text-dark">
                                </div>
                                
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">Date of Birth</label>
                                    <div class="relative">
                                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-setting dark:text-primary-text-dark">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">User Name</label>
                                    <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-setting dark:text-primary-text-dark">
                                </div>
                                
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">Additional Email (Optional)</label>
                                    <input type="email" name="additional_email" value="{{ old('additional_email', Auth::user()->additional_email) }}" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-setting dark:text-primary-text-dark">
                                </div>
                                
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">Confirm Additional Email</label>
                                    <input type="email" name="confirm_additional_email" value="{{ old('confirm_additional_email') }}" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-setting dark:text-primary-text-dark">
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-12">
                                <button type="submit" class="bg-primary-accent hover:bg-opacity-90 text-white font-medium py-3 px-12 rounded-md transition duration-200">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection