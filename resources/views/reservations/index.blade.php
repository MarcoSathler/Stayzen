@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="text-center mb-20">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-5xl lg:text-7xl font-black bg-gradient-to-r from-gray-900 via-gray-800 to-black bg-clip-text text-transparent mb-6 leading-tight">
            Find your perfect stay
        </h1>
        <p class="text-xl lg:text-2xl text-gray-600 mb-12 max-w-2xl mx-auto leading-relaxed">
            Book unique homes and experiences all over the world.
        </p>
        
        <!-- Search Hero -->
        <div class="bg-white rounded-3xl shadow-2xl p-1 max-w-5xl mx-auto">
            <div class="flex flex-col lg:flex-row items-stretch lg:items-center p-1 lg:p-4 space-y-2 lg:space-y-0">
                <div class="flex-1 flex lg:w-48">
                    <input type="date" class="w-full px-6 py-4 text-lg border-none focus:ring-2 focus:ring-orange-500 rounded-l-lg" placeholder="Check-in">
                </div>
                <div class="flex-1 flex lg:w-48">
                    <input type="date" class="w-full px-6 py-4 text-lg border-none focus:ring-2 focus:ring-orange-500" placeholder="Check-out">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filters -->
<section class="mb-16">
    <div class="flex flex-wrap gap-4 justify-center lg:justify-start mb-8">
        <button class="px-6 py-3 bg-white border border-gray-200 rounded-2xl hover:shadow-md transition-all font-medium">
            All properties
        </button>
        <button class="px-6 py-3 bg-orange-500 text-white rounded-2xl hover:bg-orange-600 shadow-lg font-medium">
            Apartments
        </button>
        <button class="px-6 py-3 bg-white border border-gray-200 rounded-2xl hover:shadow-md transition-all font-medium">
            Hotels
        </button>
        <button class="px-6 py-3 bg-white border border-gray-200 rounded-2xl hover:shadow-md transition-all font-medium">
            Hostels
        </button>
    </div>
</section>

<!-- Listings Grid -->
<section>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
        @forelse($accommodations as $listing)
            @include('components.listing-card', ['listing' => $listing])
        @empty
            <div class="col-span-full text-center py-32">
                <i class="fas fa-search text-8xl text-gray-300 mb-8"></i>
                <h3 class="text-3xl font-bold text-gray-500 mb-4">No places found</h3>
                <p class="text-xl text-gray-400 mb-8">Try adjusting your search filters</p>
                <a href="{{ route('home') }}" class="bg-orange-500 text-white px-8 py-4 rounded-2xl font-semibold hover:bg-orange-600 transition">
                    Browse all places
                </a>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($accommodations->hasPages())
        <div class="mt-20 flex justify-center">
            {{ $accommodations->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    @endif
</section>
@endsection
