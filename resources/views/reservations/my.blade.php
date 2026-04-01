@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900">
                {{ auth()->user()->role === 'seller' ? 'Reservation requests' : 'My reservations' }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                {{ auth()->user()->role === 'seller'
                    ? 'Approve or reject pending reservation requests for your services.'
                    : 'Track the status of your reservation requests.' }}
            </p>
        </div>
    </div>

    @if(auth()->user()->role === 'seller')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Pending --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-yellow-600">Pending</h2>
                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                        {{ $pending->count() }}
                    </span>
                </div>

                @forelse ($pending as $reservation)
                    <div class="mb-4 rounded-2xl border border-yellow-200 bg-yellow-50 p-4">
                        <div class="flex justify-between items-start gap-3">
                            <div>
                                <p class="font-semibold text-gray-900">
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

                        <div class="mt-4 flex gap-2">
                            <form method="POST" action="{{ route('reservations.approve', $reservation->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition">
                                    Approve
                                </button>
                            </form>

                            <form method="POST" action="{{ route('reservations.reject', $reservation->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 rounded-xl bg-red-600 text-white text-sm font-semibold hover:bg-red-700 transition">
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No pending reservation requests.</p>
                @endforelse
            </div>

            {{-- Confirmed --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-emerald-600">Confirmed</h2>
                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">
                        {{ $confirmed->count() }}
                    </span>
                </div>

                @forelse ($confirmed as $reservation)
                    <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                        <div class="flex justify-between items-start gap-3">
                            <div>
                                <p class="font-semibold text-gray-900">
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
                    <p class="text-sm text-gray-500">No confirmed reservations.</p>
                @endforelse
            </div>

            {{-- Cancelled --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-red-600">Cancelled</h2>
                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-red-100 text-red-700">
                        {{ $cancelled->count() }}
                    </span>
                </div>

                @forelse ($cancelled as $reservation)
                    <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 p-4">
                        <div class="flex justify-between items-start gap-3">
                            <div>
                                <p class="font-semibold text-gray-900">
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
                    <p class="text-sm text-gray-500">No cancelled reservations.</p>
                @endforelse
            </div>
        </div>
    @else
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
    @endif
</div>
@endsection
