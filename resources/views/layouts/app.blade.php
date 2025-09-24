<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="//unpkg.com/alpinejs" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div x-data="{ mobileSidebarOpen: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900 overflow-hidden">

        <div x-show="mobileSidebarOpen" class="fixed inset-0 z-40 flex lg:hidden" x-cloak>
            <div @click="mobileSidebarOpen = false" class="fixed inset-0 bg-black/30" aria-hidden="true"></div>
            
                <aside x-show="mobileSidebarOpen" 
                       x-transition:enter="transition ease-in-out duration-300 transform"
                       x-transition:enter-start="-translate-x-full"
                       x-transition:enter-end="translate-x-0"
                       x-transition:leave="transition ease-in-out duration-300 transform"
                       x-transition:leave-start="translate-x-0"
                       x-transition:leave-end="-translate-x-full"
                       class="relative flex w-64 max-w-xs flex-1 flex-col bg-white border-r border-gray-200">
                
                {{-- ISI SIDEBAR LANGSUNG DI SINI --}}
                <div class="flex h-full flex-col">
                    <div class="flex h-16 flex-shrink-0 items-center justify-center px-4">
                        <a href="{{ route('dashboard') }}">
                            <img class="h-10 w-auto" src="{{ asset('images/logo/company-logo.png') }}" alt="Company Logo">
                        </a>
                    </div>

                    <nav class="flex-1 space-y-1 overflow-y-auto p-4">
                        <a href="#" class="flex items-center rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <span class="ml-3 text-sm font-medium"> Home </span>
                        </a>
                        
                        <span class="block px-4 pt-4 pb-1 text-xs font-semibold text-gray-500 uppercase">Human Resource</span>

                        <a href="#" class="flex items-center rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            <span class="ml-3 text-sm font-medium"> Personal Information </span>
                        </a>

                        <div x-data="{ open: {{ request()->routeIs('dashboard') || request()->routeIs('attendances.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="flex w-full items-center justify-between rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="ml-3 text-sm font-medium"> Attendance </span>
                                </div>
                                <svg :class="{'rotate-180': open}" class="h-4 w-4 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" x-transition class="mt-1 space-y-1 pl-8">
                                <a href="{{ route('dashboard') }}" class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}">
                                    Dashboard
                                </a>
                                <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                    Leave Request
                                </a>
                            </div>
                        </div>

                         <a href="#" class="flex items-center rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962A3 3 0 0110.5 9.75v-.75a3 3 0 00-3-3h-1.5a3 3 0 00-3 3v.75a3 3 0 013 3v.75a3 3 0 003 3h.75a3 3 0 003-3v-.75a3 3 0 013-3h.75a3 3 0 013 3v.75a3 3 0 003 3h.75a3 3 0 003-3v-.75a3 3 0 00-3-3h-1.5a3 3 0 00-3 3v.75a3 3 0 01-3 3m-3.75 2.25A3.75 3.75 0 019 18.75v-.75a3.75 3.75 0 00-3.75-3.75h-1.5a3.75 3.75 0 00-3.75 3.75v.75A3.75 3.75 0 013 18.75v-.75a3.75 3.75 0 00-3.75-3.75h-1.5A3.75 3.75 0 00.75 15v.75A3.75 3.75 0 013 18.75v.75A3.75 3.75 0 004.5 21h.75A3.75 3.75 0 009 18.75v-.75a3.75 3.75 0 013.75-3.75h.75a3.75 3.75 0 013.75 3.75v.75a3.75 3.75 0 003.75 3.75h.75a3.75 3.75 0 003.75-3.75v-.75a3.75 3.75 0 00-3.75-3.75h-1.5a3.75 3.75 0 00-3.75 3.75v.75a3.75 3.75 0 01-3.75 3.75M6.75 12a.75.75 0 100-1.5.75.75 0 000 1.5z" /></svg>
                            <span class="ml-3 text-sm font-medium"> FamilIA Care </span>
                        </a>
                         <a href="#" class="flex items-center rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.07a2.25 2.25 0 01-2.25 2.25H5.75A2.25 2.25 0 013.5 18.22V14.15M16.5 14.15v-2.47a2.25 2.25 0 00-4.5 0v2.47m5.25-6.82A2.25 2.25 0 0012 5.33a2.25 2.25 0 00-5.25 2.47m10.5 0V7.33a2.25 2.25 0 00-2.25-2.25a2.25 2.25 0 00-2.25 2.25v.328M5.75 7.33v.328a2.25 2.25 0 01-2.25 2.47M5.75 7.33a2.25 2.25 0 00-2.25-2.25A2.25 2.25 0 001.25 7.33v3.82a2.25 2.25 0 002.25 2.25h1.5M16.5 7.33v3.82a2.25 2.25 0 002.25 2.25h1.5a2.25 2.25 0 002.25-2.25V7.33a2.25 2.25 0 00-2.25-2.25A2.25 2.25 0 0016.5 7.33z" /></svg>
                            <span class="ml-3 text-sm font-medium"> FamilIA Services </span>
                        </a>
                         <a href="#" class="flex items-center rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M-4.5 12h18" /></svg>
                            <span class="ml-3 text-sm font-medium"> Event </span>
                        </a>
                    </nav>
                </div>

            </aside>
        </div>

<aside class="hidden lg:flex lg:flex-shrink-0">
    <div class="flex w-64 flex-col bg-white border-r border-gray-200">
                {{-- ISI SIDEBAR LANGSUNG DI SINI JUGA --}}
                <div class="flex h-full flex-col">
                    <div class="flex h-16 flex-shrink-0 items-center justify-center px-4">
                        <a href="{{ route('dashboard') }}">
                            <img class="h-10 w-auto" src="{{ asset('images/logo/company-logo.png') }}" alt="Company Logo">
                        </a>
                    </div>

                    <nav class="flex-1 space-y-1 overflow-y-auto p-4">
                        <a href="#" class="flex items-center rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <span class="ml-3 text-sm font-medium"> Home </span>
                        </a>
                        
                        <span class="block px-4 pt-4 pb-1 text-xs font-semibold text-gray-500 uppercase">Human Resource</span>

                        <a href="#" class="flex items-center rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            <span class="ml-3 text-sm font-medium"> Personal Information </span>
                        </a>

                        <div x-data="{ open: {{ request()->routeIs('dashboard') || request()->routeIs('attendances.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="flex w-full items-center justify-between rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="ml-3 text-sm font-medium"> Attendance </span>
                                </div>
                                <svg :class="{'rotate-180': open}" class="h-4 w-4 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" x-transition class="mt-1 space-y-1 pl-8">
                                <a href="{{ route('dashboard') }}" class="block rounded-lg px-4 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}">
                                    Dashboard
                                </a>
                                <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                    Leave Request
                                </a>
                            </div>
                        </div>

                         <a href="#" class="flex items-center rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962A3 3 0 0110.5 9.75v-.75a3 3 0 00-3-3h-1.5a3 3 0 00-3 3v.75a3 3 0 013 3v.75a3 3 0 003 3h.75a3 3 0 003-3v-.75a3 3 0 013-3h.75a3 3 0 013 3v.75a3 3 0 003 3h.75a3 3 0 003-3v-.75a3 3 0 00-3-3h-1.5a3 3 0 00-3 3v.75a3 3 0 01-3 3m-3.75 2.25A3.75 3.75 0 019 18.75v-.75a3.75 3.75 0 00-3.75-3.75h-1.5a3.75 3.75 0 00-3.75 3.75v.75A3.75 3.75 0 013 18.75v-.75a3.75 3.75 0 00-3.75-3.75h-1.5A3.75 3.75 0 00.75 15v.75A3.75 3.75 0 013 18.75v.75A3.75 3.75 0 004.5 21h.75A3.75 3.75 0 009 18.75v-.75a3.75 3.75 0 013.75-3.75h.75a3.75 3.75 0 013.75 3.75v.75a3.75 3.75 0 003.75 3.75h.75a3.75 3.75 0 003.75-3.75v-.75a3.75 3.75 0 00-3.75-3.75h-1.5a3.75 3.75 0 00-3.75 3.75v.75a3.75 3.75 0 01-3.75 3.75M6.75 12a.75.75 0 100-1.5.75.75 0 000 1.5z" /></svg>
                            <span class="ml-3 text-sm font-medium"> FamilIA Care </span>
                        </a>
                         <a href="#" class="flex items-center rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.07a2.25 2.25 0 01-2.25 2.25H5.75A2.25 2.25 0 013.5 18.22V14.15M16.5 14.15v-2.47a2.25 2.25 0 00-4.5 0v2.47m5.25-6.82A2.25 2.25 0 0012 5.33a2.25 2.25 0 00-5.25 2.47m10.5 0V7.33a2.25 2.25 0 00-2.25-2.25a2.25 2.25 0 00-2.25 2.25v.328M5.75 7.33v.328a2.25 2.25 0 01-2.25 2.47M5.75 7.33a2.25 2.25 0 00-2.25-2.25A2.25 2.25 0 001.25 7.33v3.82a2.25 2.25 0 002.25 2.25h1.5M16.5 7.33v3.82a2.25 2.25 0 002.25 2.25h1.5a2.25 2.25 0 002.25-2.25V7.33a2.25 2.25 0 00-2.25-2.25A2.25 2.25 0 0016.5 7.33z" /></svg>
                            <span class="ml-3 text-sm font-medium"> FamilIA Services </span>
                        </a>
                         <a href="#" class="flex items-center rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M-4.5 12h18" /></svg>
                            <span class="ml-3 text-sm font-medium"> Event </span>
                        </a>
                    </nav>
                </div>
            </div>
        </aside>
        <div class="flex flex-1 flex-col overflow-hidden">
            <header class="flex h-16 w-full flex-shrink-0 items-center justify-between border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 sm:px-6">
                <button @click="mobileSidebarOpen = true" type="button" class="text-gray-500 dark:text-gray-400 lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                </button>
                
                <div class="flex-1">
                    @if (isset($header))
                        {{ $header }}
                    @endif
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                   @include('layouts.navigation')
                </div>
            </header>
            <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                {{ $slot }}
            </main>
            </div>
        </div>
</body>
</html>