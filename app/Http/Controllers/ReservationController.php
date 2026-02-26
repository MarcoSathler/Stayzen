<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Log;
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
            $accommodation = Service::with(['userService', 'serviceImage'])->findOrFail($id);

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
            
            Reservation::create([
                'service_id' => $service_id,
                'user_id' => auth()->id(),
                'check_in' => Carbon::parse($validated['check_in'])->timestamp,
                'check_out' => Carbon::parse($validated['check_out'])->timestamp,
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
} 
