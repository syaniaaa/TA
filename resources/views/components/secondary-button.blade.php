{{-- <button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}

{{-- @props([
    'tag' => '',
    'href' => '#',
])
@if ($tag == 'a')
    <a {{ $attributes->merge([
        'class' => 'inline-flex items-
        center px-4 py-2 bg-white dark:bg-gray-800 border border-
        gray-300 dark:border-gray-500 rounded-md font-semibold text-
        xs text-gray-700 dark:text-gray-300 uppercase tracking-widest
        shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700
        focus:outline-none focus:ring-2 focus:ring-indigo-500
        focus:ring-offset-2 dark:focus:ring-offset-gray-800
        disabled:opacity-25 transition ease-in-out duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'button',
            'class' => 'inline-flex items-center px-4 py-2 bg-white
            dark:bg-gray-800 border border-gray-300 dark:border-gray-500
            rounded-md font-semibold text-xs text-gray-700 dark:text-
            gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50
            dark:hover:bg-gray-700 focus:outline-none focus:ring-2
            focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out
            duration-150',
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
            'inline-flex items-center px-3 py-2 bg-white hover:bg-gray-200 text-black font-bold border border-black rounded transition ease-in-out duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'submit',
            'class' =>
                'inline-flex items-center px-3 py-2 bg-white hover:bg-gray-200 text-black font-bold border border-black rounded transition ease-in-out duration-150',
        ]) }}>
        {{ $slot }}
    </button>
@endif
