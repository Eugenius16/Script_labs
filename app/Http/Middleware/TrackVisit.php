<?php

namespace App\Http\Middleware;

use App\Models\Tracker;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $context = [];
        if ($request->filled('city')) {
            $context['search_city'] = $request->query('city');
        }
        $context['user_agent'] = substr($request->userAgent() ?? '', 0, 150);

        Tracker::create([
            'page'       => $request->path(),
            'ip'         => $request->ip(),
            'method'     => $request->method(),
            'status'     => $response->getStatusCode(),
            'context'    => $context,
            'visited_at' => now(),
        ]);

        return $response;
    }
}