<div x-data="{ sidebarOpen: true, mobileMenuOpen: false }" class="relative">
    <!-- Mobile Toggle Button -->
    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden fixed top-4 left-4 z-50 bg-white border rounded-md p-2 shadow">
        <svg class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    <!-- Sidebar -->
    <aside 
        :class="{
            'translate-x-0': sidebarOpen || mobileMenuOpen,
            '-translate-x-full': !(sidebarOpen || mobileMenuOpen)
        }"
        class="fixed top-0 left-0 z-40 h-screen w-64 transition-transform duration-300 bg-white border-r border-gray-200 overflow-y-auto px-3 py-8"
    >
        <div class="flex items-center justify-between px-2">
            <a href="{{ route('dashboard') }}" class="flex items-center text-2xl font-bold text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ml-2">HR Portal</span>
            </a>
            <button @click="sidebarOpen = !sidebarOpen" class="hidden lg:block text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg x-show="sidebarOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
                <svg x-show="!sidebarOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </button>
            <button @click="mobileMenuOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- ...existing navigation code... -->
        <div class="mt-6 flex flex-1 flex-col justify-between">
            <nav class="space-y-6">
                <!-- ...existing menu items... -->
            </nav>
        </div>
    </aside>

    <!-- Overlay for mobile -->
    <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false" class="fixed inset-0 bg-black bg-opacity-30 z-30 lg:hidden"></div>
</div>