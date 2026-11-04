<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['category', 'author'])
            ->orderByDesc('dt_created')
            ->paginate(6);

        return view('blog.index', compact('blogs'));
    }

    //Рі-31 Пащенко Євгеній
    public function admin()
    {
        $blogs = Blog::with('category')
            ->orderByDesc('dt_created')
            ->paginate(10);

        return view('blog.admin', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::orderBy('category_name')
            ->pluck('category_name', 'category_id');

        return view('blog.create', compact('categories'));
    }

    public function store(BlogRequest $request)
    {
        $blog = Blog::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('blog.show', $blog);
    }

    public function show(Blog $blog)
    {
        $blog->load(['category', 'author']);

        return view('blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $categories = Category::orderBy('category_name')
            ->pluck('category_name', 'category_id');

        return view('blog.edit', compact('blog', 'categories'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update($request->validated());

        return redirect()->route('blog.show', $blog);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.admin');
    }
}