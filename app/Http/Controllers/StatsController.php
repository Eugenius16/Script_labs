<?php

namespace App\Http\Controllers;

use App\Models\Tracker;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    // Case 1: Зведена статистика (групування за page або ip)
    public function pages(Request $request)
    {
        $type = $request->query('type', 'page');

        if (!in_array($type, ['page', 'ip', 'method'], true)) {
            abort(400, 'Невідомий тип групування.');
        }

        $rows = Tracker::query()
            ->selectRaw("{$type}, count(*) as hits, max(visited_at) as last_visit")
            ->groupBy($type)
            ->orderByDesc('hits')
            ->get();

        return view('stats.pages', compact('rows', 'type'));
    }

    // Case 2: Детальна статистика з пагінацією та фільтрацією
    public function detail(Request $request)
    {
        $type = $request->query('type', 'page');
        $item = $request->query('item');

        if (!in_array($type, ['page', 'ip'], true)) {
            abort(400, 'Невідомий тип фільтрації.');
        }

        $rows = Tracker::query()
            ->when(
                $item,
                fn ($query, $value) => $query->where($type, $value)
            )
            ->orderByDesc('visited_at')
            ->paginate(15)
            ->withQueryString();

        return view('stats.detail', compact('rows', 'type', 'item'));
    }
    // Індивідуальне завдання: статистика пошукових запитів міст нерухомості
    public function searchStats()
    {
        $rows = Tracker::query()
            ->whereNotNull('context->search_city')
            ->selectRaw("JSON_UNQUOTE(json_extract(context, '$.search_city')) as city, count(*) as searches, max(visited_at) as last_search")
            ->groupBy('city')
            ->orderByDesc('searches')
            ->get();

        return view('stats.search', compact('rows'));
    }
}