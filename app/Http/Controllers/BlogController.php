<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Filter;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $filterId = $request->query('filter');

        $blogs = Blog::query()
            ->with(['category', 'author', 'filters'])
            ->when($filterId, function ($query, $id) {
                $query->whereHas('filters', fn ($q) => $q->whereKey($id));
            })
            ->orderByDesc('dt_created')
            ->paginate(6)
            ->withQueryString();

        $filters = Filter::pluck('filter_name', 'filter_id');

        return view('blog.index', compact('blogs', 'filters', 'filterId'));
    }

    public function admin()
    {
        $blogs = Blog::with(['category', 'filters'])
            ->orderByDesc('dt_created')
            ->paginate(10);

        return view('blog.admin', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::orderBy('category_name')->pluck('category_name', 'category_id');
        $filters = Filter::pluck('filter_name', 'filter_id');

        return view('blog.create', compact('categories', 'filters'));
    }

    public function store(BlogRequest $request)
    {
        $data = $request->validated();
        
        $blog = Blog::create([
            ...Arr::except($data, ['filters']),
            'user_id' => auth()->id(),
        ]);

        $blog->filters()->sync($data['filters'] ?? []);

        return redirect()->route('blog.show', $blog);
    }

    public function show(Blog $blog)
    {
        $blog->load(['category', 'author', 'filters']);

        return view('blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $blog->load('filters');
        $categories = Category::orderBy('category_name')->pluck('category_name', 'category_id');
        $filters = Filter::pluck('filter_name', 'filter_id');
        $selected = $blog->filters->pluck('filter_id')->all();

        return view('blog.edit', compact('blog', 'categories', 'filters', 'selected'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $data = $request->validated();

        $blog->update(Arr::except($data, ['filters']));
        $blog->filters()->sync($data['filters'] ?? []);

        return redirect()->route('blog.show', $blog);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.admin');
    }

    // Методи для DualListBox (Case 2)
    public function tags(Blog $blog)
    {
        $blog->load('filters');
        $filters = Filter::pluck('filter_name', 'filter_id');
        $selected = $blog->filters->pluck('filter_id')->all();

        return view('blog.tags', compact('blog', 'filters', 'selected'));
    }

    public function tagsStore(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'filters'   => ['sometimes', 'array'],
            'filters.*' => ['integer', 'distinct', 'exists:filter,filter_id'],
        ]);

        $blog->filters()->sync($data['filters'] ?? []);

        return redirect()->route('blog.show', $blog);
    }
}