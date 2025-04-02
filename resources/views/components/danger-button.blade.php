{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}

@props([
    'tag' => '',
    'href' => '#',
])

@if ($tag == 'a')
    <a {{ $attributes->merge([
        'class' =>
            'inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-700 text-white font-bold border border-red-700 rounded transition ease-in-out duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'submit',
            'class' =>
                'inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-700 text-white font-bold border border-red-700 rounded transition ease-in-out duration-150',
        ]) }}>
        {{ $slot }}
    </button>
@endif
