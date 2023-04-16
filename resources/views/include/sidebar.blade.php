<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">

        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle">
                        <i class="ri-arrow-left-s-line"></i>
                    </div>
                    <div class="hover-circle">
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul class="iq-menu">
                @can('read user')
                <li class="@yield('users-active')">
                    <a href="{{ route('users.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/users.png') }}" alt="users" class="images-sidebar" />
                        <span> {{ __('Users') }} </span>
                    </a>
                </li>
                @endcan

                @can('read task')
                <li class="@yield('tasks-active')">
                    <a href="{{ route('tasks.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/tasks.png') }}" alt="tasks" class="images-sidebar" />
                        <span> {{ __('Tasks') }} </span>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
