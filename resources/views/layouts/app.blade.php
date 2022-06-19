<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <script src="https://kit.fontawesome.com/535ccb550f.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

       

        @yield('css')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-emerald-500">
            <div class="w-full h-screen ">
                <div class="flex">
                    <div class="w-80 bg-stone-100 h-screen">
                        <div class="flex justify-center">
                            <img src="{{asset('images/logo.png')}}">
                        </div>

                        <div class="">
                            <ul>
                                <a href="{{route('dashboard')}}">
                                    <li class="{{Request::routeIs('dashboard') ? 'bg-indigo-500 text-white' : 'text-indigo-700 '}} hover:text-white hover:bg-indigo-600 px-4  py-2 text-xl font-bold">
                                        <i class="fa-solid fa-gauge-high pr-2"></i> Dashboard
                                    </li>
                                </a>


                                @if(Auth::user()->role != 'admin')
                                    <a href="{{route('empatt')}}">
                                        <li class="{{Request::routeIs('empatt') ? 'bg-indigo-500 text-white' : 'text-indigo-700 '}} hover:text-white my-2 hover:bg-indigo-600 px-4 py-2  text-xl font-bold">
                                            <i class="fa-solid fa-clipboard-user pr-2"></i> Attendance
                                        </li>
                                    </a>

                                    <a href="{{route('applications.index')}}">
                                        <li class="{{Request::routeIs('applications.*') ? 'bg-indigo-500 text-white' : 'text-indigo-700 '}} hover:text-white my-2 hover:bg-indigo-600 px-4 py-2  text-xl font-bold">
                                            <i class="fa-solid fa-person-walking pr-2"></i> Leave Application
                                        </li>
                                    </a>
                                @endif

                                @if(Auth::user()->role == 'admin')
                                    <a href="{{route('users.create')}}">
                                        <li class="{{Request::routeIs('users.*') ? 'bg-indigo-500 text-white' : 'text-indigo-700 '}} hover:text-white  my-2 hover:bg-indigo-600 px-4 py-2 text-xl font-bold">
                                            <i class="fa-solid fa-user-secret"></i> Create Employee
                                        </li>
                                    </a>

                                    <a href="{{route('employee')}}">
                                        <li class="{{Request::routeIs('employee') ? 'bg-indigo-500 text-white' : 'text-indigo-700 '}} hover:text-white  my-2 hover:bg-indigo-600 px-4 py-2  text-xl font-bold">
                                            <i class="fa-solid fa-users"></i> Employees
                                        </li>
                                    </a>

                                    <a href="{{route('attendance')}}">
                                        <li class="{{Request::routeIs('attendance') ? 'bg-indigo-500 text-white' : 'text-indigo-700 '}} hover:text-white  my-2 hover:bg-indigo-600 px-4 py-2 text-xl font-bold">
                                            <i class="fa-solid fa-clipboard-user"></i> Attendance
                                        </li>
                                    </a>
                                    
            
                                    <a href="{{route('application')}}">
                                        <li class="{{Request::routeIs('application') ? 'bg-indigo-500 text-white' : 'text-indigo-700 '}} hover:text-white my-2 hover:bg-indigo-600 px-4 py-2  text-xl font-bold">
                                            <i class="fa-solid fa-person-walking pr-2"></i>  Leave Application
                                        </li>
                                    </a>
                                @endif
        
                                <li >
                                    <form method="post" action="{{route('logout')}}">
                                        @csrf
                                        <button type="submit" class="text-red-700 my-2 hover:bg-red-600 px-4 py-2 hover:text-white text-xl font-bold w-full text-left"><i class="fa-solid fa-person-walking-arrow-right pr-2"></i> Logout</button>
                                    </form>
                                </li>
        
                            </ul>
                        </div>
                    </div>
                    <div class="bg-stone-50 w-full px-6 py-4">
                        @yield('content')
                       
                    </div>
                </div>
                @yield('model')
            </div>
            

        </div>
        
        @yield('js')
        
    </body>
</html>
