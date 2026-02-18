<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Service;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Service::query()
                    ->with(['userService', 'serviceImage'])
                    ->latest('created_at');
        
            $accommodations = $query->paginate(12);

            if (empty($accommodations))
                throw new \Exception('Error on getting Accomodations');

            return view('reservations.index', compact('accommodations'));
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
