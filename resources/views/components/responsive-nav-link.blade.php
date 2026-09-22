@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-full bg-violet-600 px-5 py-3 text-sm font-semibold text-white transition duration-200'
            : 'block w-full rounded-full px-5 py-3 text-sm font-semibold text-gray-600 transition duration-200 hover:bg-violet-50 hover:text-violet-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
