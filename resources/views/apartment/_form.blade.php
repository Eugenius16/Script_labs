<div style="margin-bottom: 10px;">
    <label for="title">Заголовок оголошення:</label><br>
    <input type="text" id="title" name="title" value="{{ old('title', $apartment->title ?? '') }}" style="width: 320px;">
    @error('title') <p style="color: red; margin: 2px 0;">{{ $message }}</p> @enderror
</div>

<div style="margin-bottom: 10px;">
    <label for="city">Місто:</label><br>
    <input type="text" id="city" name="city" value="{{ old('city', $apartment->city ?? '') }}" style="width: 320px;">
    @error('city') <p style="color: red; margin: 2px 0;">{{ $message }}</p> @enderror
</div>

<div style="margin-bottom: 10px;">
    <label for="rooms">Кількість кімнат:</label><br>
    <input type="number" id="rooms" name="rooms" min="1" max="10" value="{{ old('rooms', $apartment->rooms ?? 1) }}" style="width: 320px;">
    @error('rooms') <p style="color: red; margin: 2px 0;">{{ $message }}</p> @enderror
</div>

<div style="margin-bottom: 10px;">
    <label for="price">Ціна ($):</label><br>
    <input type="number" id="price" name="price" value="{{ old('price', $apartment->price ?? '') }}" style="width: 320px;">
    @error('price') <p style="color: red; margin: 2px 0;">{{ $message }}</p> @enderror
</div>

<div style="margin-bottom: 10px;">
    <label for="description">Опис:</label><br>
    <textarea id="description" name="description" rows="3" style="width: 320px;">{{ old('description', $apartment->description ?? '') }}</textarea>
</div>