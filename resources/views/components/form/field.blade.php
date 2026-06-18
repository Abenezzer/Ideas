@props(['label', 'name', 'type' => 'text', 'placeholder'])

<label class="label">{{ $label }}</label>
<input name="{{ $name }}" type="{{ $type }}" class="input" placeholder="{{ $placeholder }}"  value="{{ old($name) }}"/>
@error($name)
<p class="font-bold text-sm text-red-500">{{ $message }}</p>  
@enderror