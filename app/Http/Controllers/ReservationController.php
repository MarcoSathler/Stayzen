<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Service;

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
} 
