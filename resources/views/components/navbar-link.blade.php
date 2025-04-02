{{-- @props(['active'])

@php
$classes = ($active ?? false)
            ? 'font-medium text-xl text-gray-100 '
            : 'text-red-500 hover:bg-yellow-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a> --}}

@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'font-medium text-xl text-red-500 bg-[#F0FF42] px-2 py-1 rounded-lg' // Mengatur padding dan border-radius untuk halaman aktif
            : 'font-medium text-xl text-gray-100 hover:text-red-400 hover:bg-[#F0FF42] hover:rounded-lg px-2 py-1'; // Gaya hover yang serupa
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
