<aside class="fixed top-0 left-0 h-screen w-16 m-0 flex flex-col bg-primary-light dark:bg-primary-dark shadow-lg z-30 transition-transform duration-300 ease-in-out md:translate-x-0 -translate-x-full">
    <div class="flex flex-col items-center w-full h-full py-4">
        <div>
            <img src="{{ asset('images/Logo/no_bg_logo.png') }}" alt="">
        </div>
        
        <hr class="sidebar-hr w-3/4"/>
        
        <div class="flex flex-col items-center w-full mt-3">

            @if (Auth::user()->role == 'Admin')
                <a href="{{route("admin.dashboard")}}" class="sidebar-icon group">
                    <i class="fas fa-home "></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Home</span>
                </a>
                <a href="{{route('admin.usersPage')}}" class="sidebar-icon group">
                    <i class="fa-solid fa-users "></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Users</span>
                </a>
                <a href="{{route('admin.importData')}}" class="sidebar-icon group">
                    <i class="fas fa-chart-line "></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Analytics</span>
                </a>
                <a href="{{route('admin.planningPage')}}" class="sidebar-icon group">
                    <i class="fas fa-calendar-alt "></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Calendar</span>
                </a>

            @elseif(Auth::user()->role == 'Teacher')
                <a href="{{route("teacher.dashboard")}}" class="sidebar-icon group">
                    <i class="fas fa-home"></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Home</span>
                </a>
                <a href="{{route('teacher.attendance')}}" class="sidebar-icon group">
                    <i class="fas fa-user-check"></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Attendance</span>
                </a>
                <a href="{{route('teacher.grades')}}" class="sidebar-icon group">
                    <i class="fas fa-chart-bar"></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Grades</span>
                </a>
                <a href="{{route('teacher.resource')}}" class="sidebar-icon group">
                    <i class="fas fa-book"></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Resources</span>
                </a>

            @else

                <a href="{{route("student.dashboard")}}" class="sidebar-icon group">
                    <i class="fas fa-home"></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Home</span>
                </a>
                <a href="{{route('student.attendance')}}" class="sidebar-icon group">
                    <i class="fas fa-user-check"></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Attendance</span>
                </a>
                <a href="{{route('student.grades')}}" class="sidebar-icon group">
                    <i class="fas fa-chart-bar"></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Grades</span>
                </a>
                <a href="{{route('student.resources')}}" class="sidebar-icon group">
                    <i class="fas fa-book"></i>
                    <span class="sidebar-tooltip group-hover:scale-100">Resources</span>
                </a>

            @endif

        </div>
        
        <div class="mt-auto">
            <div id="theme-toggle" class="sidebar-icon group">
                <i class="fas fa-moon dark:hidden"></i>
                <i class="fas fa-sun hidden dark:block"></i>
                <span class="sidebar-tooltip group-hover:scale-100">Toggle Theme</span>
            </div>
            
            <hr class="sidebar-hr w-3/4 mx-auto" />
            
            <a href="{{route('global.profile_settings.profileSettings')}}" class="sidebar-icon group">
                <i class="fas fa-cog "></i>
                <span class="sidebar-tooltip group-hover:scale-100">Settings</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center">
                    <div class="sidebar-icon group">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="sidebar-tooltip group-hover:scale-100">Logout</span>
                    </div>            
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- Mobile Sidebar Toggle  --}}
<button id="mobile-sidebar-toggle" class="fixed bottom-4 right-4 z-50 p-3 rounded-full bg-primary-accent text-white shadow-lg md:hidden flex items-center justify-center">
    <i class="fas fa-bars"></i>
</button>