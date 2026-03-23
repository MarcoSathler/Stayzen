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
            $request->query->remove('page');

            $query = Service::query()
                    ->with(['userService', 'serviceImage'])
                    ->latest('created_at');

            if ($request->filled('type')) {
                $query->where('type', $request->string('type'));
            }

            if ($request->filled('date_check_in') && $request->filled('date_check_out')) {
                $checkIn  = $request->date('date_check_in');
                $checkOut = $request->date('date_check_out');

                $query->whereDoesntHave('reservations', function ($q) use ($checkIn, $checkOut) {
                    $q->whereIn('status', ['pending', 'confirmed'])
                    ->where('check_in', '<', $checkOut)
                    ->where('check_out', '>', $checkIn);
                });
            }
                
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
