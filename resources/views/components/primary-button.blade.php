{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}

{{-- @props([
    'tag' => '',
    'href' => '#',
])

@if ($tag == 'a')
    <a {{ $attributes->merge([
        'class' => 'inline-flex items-
        center px-4 py-2 bg-green-600 dark:bg-green-200 border border-
        transparent rounded-md font-semibold text-xs text-white
        dark:text-green-600 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-white focus:bg-green-700
        dark:focus:bg-white
        active:bg-green-900 dark:active:bg-green-300 focus:outline-none
        focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2
        dark:focus:ring-offset-green-600 transition ease-in-out
        duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center px-4 py-2 bg-green-600
            dark:bg-green-200 border border-transparent rounded-md font-
            semibold text-xs text-white dark:text-green-600 uppercase
            tracking-widest hover:bg-green-700 dark:hover:bg-white
            focus:bg-green-300 dark:focus:bg-white active:bg-green-600
            dark:active:bg-green-300 focus:outline-none focus:ring-2
            focus:ring-indigo-600 focus:ring-offset-2 dark:focus:ring-
            offset-green-600 transition ease-in-out duration-150',
        ]) }}>
        {{ $slot }}
    </button>
@endif --}}
@props([
    'tag' => '',
    'href' => '#',
])

@if ($tag == 'a')
    <a {{ $attributes->merge([
        'class' =>
            'inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-700 text-white font-bold border border-green-700 rounded transition ease-in-out duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'submit',
            'class' =>
                'inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-700 text-white font-bold border border-green-700 rounded transition ease-in-out duration-150',
        ]) }}>
        {{ $slot }}
    </button>
@endif
