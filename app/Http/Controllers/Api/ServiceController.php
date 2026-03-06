<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $query = Service::query()
            ->with(['userService', 'serviceImage'])
            ->latest('created_at');

            $services = $query->paginate(12);

            return response()->json([
                'status' => 'successful',
                'data' => $services
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex
            ], 401);
        }
    }
}