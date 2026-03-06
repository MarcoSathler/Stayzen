@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold mb-6">My reservations</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Pending --}}
        <div>
            <h2 class="text-lg font-medium mb-3 text-yellow-600">Pending</h2>
            @forelse ($pending as $reservation)
                <div class="mb-3 rounded-lg border border-yellow-200 bg-yellow-50 p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold">
                                {{ $reservation->service->name ?? 'Service removed' }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $reservation->check_in }} → {{ $reservation->check_out }}
                            </p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-700">
                            pending
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">You have no pending reservations.</p>
            @endforelse
        </div>

        {{-- Confirmed --}}
        <div>
            <h2 class="text-lg font-medium mb-3 text-emerald-600">Confirmed</h2>
            @forelse ($confirmed as $reservation)
                <div class="mb-3 rounded-lg border border-emerald-200 bg-emerald-50 p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold">
                                {{ $reservation->service->name ?? 'Service removed' }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $reservation->check_in }} → {{ $reservation->check_out }}
                            </p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full bg-emerald-100 text-emerald-700">
                            confirmed
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">You have no confirmed reservations.</p>
            @endforelse
        </div>

        {{-- Cancelled --}}
        <div>
            <h2 class="text-lg font-medium mb-3 text-red-600">Cancelled</h2>
            @forelse ($cancelled as $reservation)
                <div class="mb-3 rounded-lg border border-red-200 bg-red-50 p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold">
                                {{ $reservation->service->name ?? 'Service removed' }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $reservation->check_in }} → {{ $reservation->check_out }}
                            </p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-700">
                            cancelled
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">You have no cancelled reservations.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
