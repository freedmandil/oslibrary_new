@props(['value'])

<label {{ $attributes->merge(['class' => 'd-block fs-6']) }}>
    {{ $value ?? $slot }}
</label>
