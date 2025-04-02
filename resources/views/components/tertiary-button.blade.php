{{-- @props([
    'tag' => '',
    'href' => '#',
])

@if ($tag == 'a')
    <a {{ $attributes->merge([
        'class' =>
            'inline-flex items-center px-4 py-2 bg-[#F0FF42] border border-gray-300 rounded-md font-semibold text-xs text-black uppercase tracking-widest shadow-sm hover:bg-[#F0FF42] focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'button',
            'class' =>
                'inline-flex items-center px-4 py-2 bg-[#F0FF42] border border-gray-300 rounded-md font-semibold text-xs text-black uppercase tracking-widest shadow-sm hover:bg-[#F0FF42] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
        ]) }}>
        {{ $slot }}
    </button>
@endif --}}

{{-- @props([
    'tag' => '',
    'href' => '#',
])

@if ($tag == 'a')
    <a {{ $attributes->merge([
        'class' => 'inline-flex items-
            center px-4 py-2 bg-yellow-400 dark:bg-yellow-200 border border-
            transparent rounded-md font-semibold text-xs text-white
            dark:text-yellow-400 uppercase tracking-widest hover:bg-yellow-700 dark:hover:bg-white focus:bg-yellow-700
            dark:focus:bg-white
            active:bg-yellow-900 dark:active:bg-yellow-300 focus:outline-none
            focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2
            dark:focus:ring-offset-yellow-400 transition ease-in-out
            duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center px-4 py-2 bg-yellow-400
                    dark:bg-yellow-200 border border-transparent rounded-md font-
                    semibold text-xs text-white dark:text-yellow-400 uppercase
                    tracking-widest hover:bg-yellow-700 dark:hover:bg-white
                    focus:bg-yellow-300 dark:focus:bg-white active:bg-yellow-400
                    dark:active:bg-yellow-300 focus:outline-none focus:ring-2
                    focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-
                    offset-yellow-400 transition ease-in-out duration-150',
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
            'inline-flex items-center px-3 py-2 bg-yellow-400 hover:bg-yellow-600 text-white font-bold border border-yellow-600 rounded transition ease-in-out duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'submit',
            'class' =>
                'inline-flex items-center px-3 py-2 bg-yellow-400 hover:bg-yellow-600 text-white font-bold border border-yellow-600 rounded transition ease-in-out duration-150',
        ]) }}>
        {{ $slot }}
    </button>
@endif
