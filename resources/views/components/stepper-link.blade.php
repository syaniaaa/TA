@props(['active', 'completed'])

@php
    // Untuk status aktif
    $classes = $active
        ? 'w-6 h-6 bg-white border-2 border-green-600 text-green-600 rounded-full flex justify-center items-center mr-3 text-sm lg:w-10 lg:h-10'
        : ($completed
            ? 'w-6 h-6 bg-green-600 border-2 border-green-600 text-white rounded-full flex justify-center items-center mr-3 text-sm lg:w-10 lg:h-10'  // Full hijau untuk langkah selesai
            : 'w-6 h-6 bg-gray-100 border border-gray-200 text-gray-600 rounded-full flex justify-center items-center mr-3 text-sm lg:w-10 lg:h-10');
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
