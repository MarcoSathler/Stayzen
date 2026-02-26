@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900">Notifications</h1>
            <p class="text-gray-500 mt-1">
                {{ $notifications->where('read_at', null)->count() }} unread
                @if($notifications->count() > $notifications->where('read_at', null)->count())
                    • {{ $notifications->count() }} total
                @endif
            </p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                Mark all as read
            </button>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="space-y-4">
        @forelse($notifications as $notification)
            <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-orange-200 transition-all duration-200 p-6 {{ $notification->read_at ? 'opacity-50 hover:opacity-100' : '' }}">
                <!-- Icon & Time -->
                <div class="flex items-start space-x-4 mb-3">
                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r {{ $notification->type == 'App\\Notifications\\NewReservation' ? 'from-orange-500 to-orange-600' : 'from-blue-500 to-blue-600' }} rounded-2xl flex items-center justify-center">
                        @if($notification->type == 'App\\Notifications\\NewReservation')
                            <i class="fas fa-calendar-check text-white text-xl"></i>
                        @else
                            <i class="fas fa-bell text-white text-xl"></i>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-500 truncate">
                            {{ $notification->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <!-- Content -->
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-900 text-lg mb-1">
                        {{ $notification->data['title'] ?? 'New notification' }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $notification->data['message'] ?? 'You have a new notification.' }}
                    </p>
                    @if(isset($notification->data['action_url']))
                        <a href="{{ $notification->data['action_url'] }}" 
                           class="inline-flex items-center px-4 py-2 mt-3 text-sm font-medium text-orange-600 bg-orange-50 border border-orange-200 rounded-xl hover:bg-orange-100 transition">
                            <i class="fas fa-arrow-right mr-2"></i>
                            View details
                        </a>
                    @endif
                </div>

                <!-- Mark as read button -->
                @if(!$notification->read_at)
                    <button onclick="markAsRead({{ $notification->id }})" 
                            class="text-xs text-orange-500 font-medium hover:text-orange-700 transition">
                        Mark as read
                    </button>
                @endif
            </div>
        @empty
            <div class="text-center py-12">
                <div class="w-24 h-24 mx-auto bg-gray-100 rounded-3xl flex items-center justify-center mb-4">
                    <i class="fas fa-bell-slash text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No notifications</h3>
                <p class="text-gray-500">You'll see notifications here when something happens.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($notifications->hasPages())
        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
    @endif
</div>

<script>
function markAsRead(notificationId) {
    fetch(`/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              document.querySelector(`[onclick="markAsRead(${notificationId})"]`).closest('.group').classList.add('opacity-50');
              document.querySelector(`[onclick="markAsRead(${notificationId})"]`).remove();
          }
      });
}
</script>
@endsection
