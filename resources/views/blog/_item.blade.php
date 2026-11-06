<article class="blog-card" style="border: 1px solid #ddd; border-radius: 8px; padding: 16px; margin-bottom: 16px; background: #fafafa;">
    <h2>
        <a href="{{ route('blog.show', $blog) }}" style="text-decoration: none; color: #1e3a8a;">
            {{ $blog->title }}
        </a>
    </h2>
    <p style="font-size: 13px; color: #666; margin: 6px 0;">
        <span style="color: #2563eb; font-weight: bold;">{{ $blog->category?->category_name ?? 'Без категорії' }}</span>
        &middot; {{ $blog->dt_created->format('d.m.Y') }}
        &middot; Автор: {{ $blog->author?->name ?? 'Редакція' }}
    </p>
    <p style="color: #444;">{{ \Illuminate\Support\Str::limit($blog->description, 140) }}</p>
    <a href="{{ route('blog.show', $blog) }}" style="color: #2563eb; font-weight: bold;">Читати далі &rarr;</a>
</article>