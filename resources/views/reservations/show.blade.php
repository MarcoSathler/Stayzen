@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Hero Image Gallery -->
    <div class="relative mb-8">
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-2 rounded-3xl overflow-hidden shadow-2xl">
            <div class="lg:col-span-3">
                <img src="{{ $accommodation->image_url }}" alt="{{ $accommodation->name }}" 
                     class="w-full h-96 object-cover">
            </div>
            <div class="lg:col-span-2 grid grid-cols-2 gap-2">
                @for($i = 1; $i <= 4; $i++)
                    <img src="{{ $accommodation->image_url }}" alt="Photo {{ $i }}" 
                         class="w-full h-48 object-cover rounded-lg hover:scale-105 transition-transform cursor-pointer">
                @endfor
            </div>
        </div>
        
        <!-- Share & Save -->
        <div class="flex items-center justify-between mt-4 p-4 bg-white rounded-2xl shadow-sm">
            <div class="flex items-center space-x-4 text-sm text-gray-500">
                <span>{{ $accommodation->reviews_count ?? 127 }} reviews</span>
                <span class="w-px h-4 bg-gray-300"></span>
                <span>{{ $accommodation->location ?? 'São Paulo, Brazil' }}</span>
            </div>
            <div class="flex items-center space-x-3">
                <button class="p-3 hover:bg-gray-100 rounded-full transition">
                    <i class="fas fa-share text-gray-500 hover:text-gray-900"></i>
                </button>
                <button class="p-3 hover:bg-gray-100 rounded-full transition">
                    <i class="far fa-heart text-gray-500 hover:text-red-500 text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Host Info -->
            <div class="flex items-center space-x-4 p-4 bg-white rounded-2xl shadow-sm">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr($accommodation->user->name ?? 'Host', 0, 1)) }}
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Hosted by {{ $accommodation->user->name ?? 'Superhost' }}</h3>
                    <p class="text-sm text-gray-500">Superhost · Joined in 2024</p>
                </div>
            </div>

            <!-- Title & Rating -->
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <div class="flex items-center mb-2">
                    <div class="flex items-center mr-4">
                        <i class="fas fa-star text-orange-500 mr-1"></i>
                        <span class="font-bold text-xl text-gray-900">4.92</span>
                    </div>
                    <span class="text-sm text-gray-500">127 reviews</span>
                </div>
                <h1 class="text-3xl font-black text-gray-900 mb-4">{{ $accommodation->name }}</h1>
                <p class="text-lg text-gray-600 leading-relaxed">{{ $accommodation->description }}</p>
            </div>

            <!-- Amenities -->
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Perfect for any stay</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition">
                        <i class="fas fa-users text-orange-500 text-xl"></i>
                        <span>{{ $accommodation->guests_max ?? 4 }} guests</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition">
                        <i class="fas fa-bed text-orange-500 text-xl"></i>
                        <span>{{ $accommodation->beds ?? 2 }} beds</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition">
                        <i class="fas fa-bath text-orange-500 text-xl"></i>
                        <span>{{ $accommodation->bathrooms ?? 1 }} bath</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Booking -->
        <div class="lg:sticky lg:top-8 lg:h-screen lg:overflow-y-auto">
            <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
                <!-- Price -->
                <div class="mb-6">
                    <div class="flex items-baseline justify-between">
                        <span class="text-4xl font-black text-gray-900">${{ number_format($accommodation->price, 0, '.', ',') }}</span>
                        <span class="text-lg text-gray-500">night</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mt-1">
                        <i class="fas fa-star text-orange-500 mr-1"></i>
                        4.92 · {{ $accommodation->reviews_count ?? 127 }} reviews
                    </div>
                </div>

                <!-- Dates & Guests -->
                <form action="{{ route('reservations.store', $accommodation) }}" method="POST" class="space-y-4 mb-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Check-in</label>
                            <input type="date" name="check_in" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent" 
                                   min="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Check-out</label>
                            <input type="date" name="check_out" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Total Price (JS calculado) -->
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <div class="flex justify-between text-lg font-semibold mb-2">
                            <span>Total</span>
                            <span id="total-price" class="text-2xl font-black text-gray-900">$<span>{{ $accommodation->price }}</span></span>
                        </div>
                        <div class="text-xs text-gray-500 text-right">
                            Includes taxes and fees
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-4 px-6 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Reserve
                    </button>
                </form>

                <!-- Payment Methods -->
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 text-sm text-gray-600">
                        <i class="fas fa-lock text-green-500"></i>
                        <span>Secure payment</span>
                    </div>
                    <div class="flex items-center space-x-3 text-sm text-gray-600">
                        <i class="fas fa-shield-alt text-blue-500"></i>
                        <span>Cancellation policy</span>
                    </div>
                    <div class="flex items-center space-x-3 text-sm text-gray-600">
                        <i class="fas fa-user-check text-green-500"></i>
                        <span>Superhost</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkin = document.querySelector('input[name="check_in"]');
    const checkout = document.querySelector('input[name="check_out"]');
    const totalPrice = document.getElementById('total-price');
    const pricePerNight = {{ $accommodation->price }};
    
    function calculateTotal() {
        const nights = checkout.value ? 
            Math.ceil((new Date(checkout.value) - new Date(checkin.value)) / (1000 * 60 * 60 * 24)) : 1;
        totalPrice.innerHTML = `$${pricePerNight * nights}`;
    }
    
    checkin.addEventListener('change', calculateTotal);
    checkout.addEventListener('change', calculateTotal);
});
</script>
@endsection
