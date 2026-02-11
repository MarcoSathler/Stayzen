<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Services::query()
            ->latest('created_at');
            
        // Filtros de busca
        if ($location = $request->get('location')) {
            $query->where(function($q) use ($location) {
                $q->where('name', 'LIKE', "%{$location}%")
                  ->orWhere('description', 'LIKE', "%{$location}%");
            });
        }
        
        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }
        
        $accommodations = $query->paginate(12);
        
        return view('reservations.index', compact('accommodations'));
    }
}
