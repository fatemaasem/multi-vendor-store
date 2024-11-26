

@props([
    'name', 'array', 'selected' => ''
])

<select name="{{ $name }}" class="form-control" id="{{ $name }}">
    <option value="">None</option>
    @foreach($array as $value => $name2)
    <option value="{{ $value }}" 
            {{  (old($name, $selected) == $value) ? 'selected' : '' }}>
            {{ $name2 }}
        </option>
    @endforeach
</select>

@error($name)
<div class="alert alert-danger mt-2" role="alert">
    {{ $message }}
</div>
@enderror
