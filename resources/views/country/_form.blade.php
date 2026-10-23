<div style="margin-bottom: 10px;">
    <label for="code">Код (2 символи):</label><br>
    <input
        id="code"
        name="code"
        type="text"
        maxlength="2"
        value="{{ old('code', $country->code ?? '') }}"
        style="width: 200px;"
    >
    @error('code')
        <p style="color: red; margin: 2px 0;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 10px;">
    <label for="name">Назва країни:</label><br>
    <input
        id="name"
        name="name"
        type="text"
        value="{{ old('name', $country->name ?? '') }}"
        style="width: 200px;"
    >
    @error('name')
        <p style="color: red; margin: 2px 0;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 10px;">
    <label for="population">Населення:</label><br>
    <input
        id="population"
        name="population"
        type="number"
        min="0"
        value="{{ old('population', $country->population ?? 0) }}"
        style="width: 200px;"
    >
    @error('population')
        <p style="color: red; margin: 2px 0;">{{ $message }}</p>
    @enderror
</div>