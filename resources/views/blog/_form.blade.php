@csrf

<div style="margin-bottom: 12px;">
    <label for="title"><strong>Заголовок</strong></label><br>
    <input type="text" id="title" name="title" value="{{ old('title', $blog->title ?? '') }}" style="width: 100%; max-width: 450px;">
    @error('title') <p style="color: red; margin: 4px 0;">{{ $message }}</p> @enderror
</div>

<div style="margin-bottom: 12px;">
    <label for="category_id"><strong>Категорія</strong></label><br>
    <select id="category_id" name="category_id" style="width: 100%; max-width: 450px;">
        <option value="">— Без категорії —</option>
        @foreach ($categories as $id => $name)
            <option value="{{ $id }}" @selected(old('category_id', $blog->category_id ?? '') == $id)>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('category_id') <p style="color: red; margin: 4px 0;">{{ $message }}</p> @enderror
</div>

<div style="margin-bottom: 12px;">
    <label for="description"><strong>Короткий опис</strong></label><br>
    <textarea id="description" name="description" rows="3" style="width: 100%; max-width: 450px;">{{ old('description', $blog->description ?? '') }}</textarea>
    @error('description') <p style="color: red; margin: 4px 0;">{{ $message }}</p> @enderror
</div>

<div style="margin-bottom: 12px;">
    <label for="text"><strong>Повний текст</strong></label><br>
    <textarea id="text" name="text" rows="6" style="width: 100%; max-width: 450px;">{{ old('text', $blog->text ?? '') }}</textarea>
    @error('text') <p style="color: red; margin: 4px 0;">{{ $message }}</p> @enderror
</div>