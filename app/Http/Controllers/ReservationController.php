<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function show($id)
    {
        try {
            $accommodation = Service::with(['userService', 'serviceImage', 'reservations'])->findOrFail($id);

            if (empty($accommodation)) {
                throw new \Exception('Error on getting Accomodations');
            }

            return view('reservations.show', compact('accommodation'));
        } catch (\Exception $ex) {
            Log::error('Erro ao buscar serviços: ' . $ex->getMessage());

            return view('errors.custom', [
                'title' => 'Service Unavailable',
                'message' => 'We couldn\'t load the accommodation list. Our team has been notified.',
                'debug' => $ex->getMessage()
            ]);
        }
    }

    public function store(ReservationRequest $request, $service_id)
    {
        try {
            $validated = $request->validated();
            $checkIn = Carbon::parse($validated['check_in'])->timestamp;
            $checkOut = Carbon::parse($validated['check_out'])->timestamp;
            
            Reservation::create([
                'service_id' => $service_id,
                'user_id' => auth()->id(),
                'check_in' => $checkIn,
                'check_out' => $checkOut,
            ]);
            
            return redirect()->route('reservations.show', $service_id)
                ->with('success', 'Reserva criada!');

        } catch (\Exception $ex) {
            Log::error('Erro ao buscar serviços: ' . $ex->getMessage());

            return view('errors.custom', [
                'title' => 'Service Unavailable',
                'message' => 'We couldn\'t load the accommodation list. Our team has been notified.',
                'debug' => $ex->getMessage()
            ]);
        }
    }

    public function myReservations()
    {
        $user = Auth::user();

        $reservations = Reservation::with('service')
                                    ->where('user_id', $user->id)
                                    ->orderByDesc('created_at')
                                    ->get();

        $pending   = $reservations->where('status', 'pending');
        $confirmed = $reservations->where('status', 'confirmed');
        $cancelled = $reservations->where('status', 'cancelled');

        return view('reservations.my', compact('pending', 'confirmed', 'cancelled'));
    }
} 
