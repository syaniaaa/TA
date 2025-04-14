@props(['active'])

@php
    $classes = $active
        ? 'font-poppins relative text-lg font-semibold text-green-700 after:content-[""] after:absolute after:left-0 after:bottom-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-400 after:to-yellow-400'
        : 'font-poppins relative text-lg font-medium text-white hover:text-yellow-100 transition-all duration-300 after:content-[""] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-green-400 after:to-yellow-400 hover:after:w-full after:transition-all after:duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
