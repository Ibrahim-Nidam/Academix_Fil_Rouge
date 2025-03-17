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
            
            <div class="max-w-5xl">
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="flex-shrink-0 justify-center flex">
                        {{-- profile image --}}
                        <div class="relative">
                            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Academix___Fil_Rouge-wT5sWRiiMbZHFNYxsVmTAUV57JzjoY.png" alt="Profile" class="w-32 h-32 rounded-full object-cover">
                            <button class="absolute bottom-1 right-1 lg:bottom-64 bg-primary-blue text-white rounded-full p-2 shadow-md">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.5 2.50001C18.8978 2.10219 19.4374 1.87868 20 1.87868C20.5626 1.87868 21.1022 2.10219 21.5 2.50001C21.8978 2.89784 22.1213 3.4374 22.1213 4.00001C22.1213 4.56262 21.8978 5.10219 21.5 5.50001L12 15L8 16L9 12L18.5 2.50001Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    {{-- form --}}
                    <div class="flex-grow">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">First Name</label>
                                <input type="text" value="Charlene" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-text-light dark:text-primary-text-dark">
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">Last Name</label>
                                <input type="text" value="Reed" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-text-light dark:text-primary-text-dark">
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">Date of Birth</label>
                                <div class="relative">
                                    <select class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md appearance-none bg-white dark:bg-[#1a2234] text-primary-text-light dark:text-primary-text-dark">
                                        <option>25 January 1990</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">User Name</label>
                                <input type="text" value="Charlene Reed" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-text-light dark:text-primary-text-dark">
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">Additional Email (Optional)</label>
                                <input type="email" value="charlenereed@gmail.com" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-text-light dark:text-primary-text-dark">
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-medium text-primary-text-light dark:text-primary-text-dark">Confirm Additional Email</label>
                                <input type="email" value="charlenereed@gmail.com" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-[#1a2234] text-primary-text-light dark:text-primary-text-dark">
                            </div>
                        </div>
                        
                        <div class="flex justify-end mt-12">
                            <button class="bg-primary-accent hover:bg-opacity-90 text-white font-medium py-3 px-12 rounded-md transition duration-200">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection