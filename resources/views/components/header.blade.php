<header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900 hover:text-orange-600 transition">
                <i class="fas fa-home text-orange-500 mr-2"></i>
                Stayzen
            </a>

            <!-- Right Menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Notifications -->
                    <div class="relative inline-block">
                        <a href="{{ route('notifications.index') }}" 
                            class="p-2 text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-2xl transition-all duration-200 flex items-center">
                            <i class="fas fa-bell text-xl relative z-10"></i>
                        </a>
                        
                        @if(auth()->user()->unread_notifications_count)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center shadow-lg z-20 border-2 border-white animate-pulse">
                                {{ auth()->user()->unread_notifications_count > 99 ? '99+' : auth()->user()->unread_notifications_count }}
                            </span>
                        @endif
                    </div>

                    
                    <!-- Trips -->
                    <a href="{{ route('reservations.index') }}" class="p-2 text-gray-500 hover:text-gray-900">
                        <i class="fas fa-briefcase text-xl"></i>
                    </a>
                    
                    <!-- Profile -->
                    <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center text-white font-semibold cursor-pointer hover:shadow-lg transition-all">
                        <a href="{{ route('profile.edit') }}">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </a>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 font-medium hidden sm:inline">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-full font-medium shadow-lg hover:shadow-xl transition-all duration-200">
                        Sign up
                    </a>
                @endauth
                
                <!-- Mobile menu button -->
                <button class="lg:hidden p-2 text-gray-500">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>
</header>
