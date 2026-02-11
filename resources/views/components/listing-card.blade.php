<div class="group bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 cursor-pointer border border-gray-100 hover:border-orange-200">
    <!-- Image -->
    <div class="relative h-72 overflow-hidden">
        <img src="{{ $listing->image_url }}" alt="{{ $listing->name }}" 
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
        
        <!-- Superhost badge -->
        <div class="absolute top-4 left-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-xs font-semibold">
            <i class="fas fa-crown text-yellow-400 mr-1"></i>Superhost
        </div>
        
        <!-- Heart -->
        <button class="absolute top-4 right-4 bg-white/90 hover:bg-white p-2 rounded-full shadow-lg hover:scale-110 transition-all">
            <i class="far fa-heart text-gray-600 text-lg hover:text-red-500 transition-colors"></i>
        </button>
    </div>
    
    <!-- Content -->
    <div class="p-6 pb-4">
        <!-- Title & Rating -->
        <div class="flex items-start justify-between mb-3">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-orange-600 transition-colors line-clamp-1 mb-1">
                    {{ $listing->name }}
                </h3>
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-star text-orange-500 mr-1"></i>
                    <span>4.9</span>
                    <span class="mx-1">·</span>
                    <span>{{ $listing->location ?? 'São Paulo, SP' }}</span>
                </div>
            </div>
        </div>
        
        <!-- Description -->
        <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">
            {{ $listing->description }}
        </p>
        
        <!-- Price & CTA -->
        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
            <div class="text-2xl font-bold text-gray-900">
                ${{ number_format($listing->price, 0, '.', ',') }}
                <span class="text-lg font-normal text-gray-500">/night</span>
            </div>
            <a href="{{ route('reservations.show', $listing) }}" 
               class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-200 text-sm">
                Reserve
            </a>
        </div>
    </div>
</div>
