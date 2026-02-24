<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $notifications = auth()->user()
                                ->notifications()
                                ->orWhereNull('read_at')
                                ->latest()
                                ->paginate(20);
                
            return view('notifications.index', compact('notifications'));
        } catch (\Exception $ex) {
            Log::error('Erro ao buscar serviços: ' . $ex->getMessage());

            return view('errors.custom', [
                'title' => 'Service Unavailable',
                'message' => 'We couldn\'t load notifications list. Our team has been notified.',
                'debug' => $ex->getMessage()
            ]);
        }
        
    }

    public function read(Request $request, $id)
    {
        try {
            $notification = auth()->user()->notifications()->findOrFail($id);
            $notification->markAsRead();

            return redirect()
            ->back()
            ->with('success', 'Readed all notifications');
        } catch (\Exception $ex) {
            Log::error('Erro ao buscar serviços: ' . $ex->getMessage());

            return view('errors.custom', [
                'title' => 'Service Unavailable',
                'message' => 'We couldn\'t read notifications. Our team has been notified.',
                'debug' => $ex->getMessage()
            ]);
        }
        
    }
}
