@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-full bg-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition duration-200'
            : 'inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold text-gray-600 transition duration-200 hover:bg-violet-50 hover:text-violet-700 hover:scale-105';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
