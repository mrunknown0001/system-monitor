<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginMonitorController extends Controller
{
    /**
     * Lightweight probe so callers can verify reachability without sending an event.
     */
    public function show(Request $request): JsonResponse
    {
        Log::debug('login-monitor-ping', [
            'query' => $request->query(),
            'origin' => $request->headers->get('origin'),
            'received_at' => now()->toIso8601String(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login monitor endpoint is reachable.',
        ]);
    }

    /**
     * Persist the login telemetry payload and return a JSON acknowledgement.
     */
    public function store(Request $request): JsonResponse
    {
        if (! $request->isJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Requests must include a JSON payload and the Content-Type: application/json header.',
            ], 415);
        }

        $request->validate([
            'event' => ['required', 'string'],
        ]);

        $payload = $request->json()->all();

        Log::debug('login-monitor-event', [
            'payload' => $payload,
            'meta' => [
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'origin' => $request->headers->get('origin'),
                'referer' => $request->headers->get('referer'),
                'received_at' => now()->toIso8601String(),
            ],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login event accepted.',
        ], 202);
    }
}