@props([
    'tag' => '',
    'href' => '#',
])

@if ($tag == 'a')
    <a {{ $attributes->merge([
        'class' => 'inline-flex items-
        center px-4 py-2 bg-green-400 dark:bg-green-200 border border-
        transparent rounded-md font-semibold text-xs text-white
        dark:text-green-400 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-white focus:bg-green-700
        dark:focus:bg-white
        active:bg-green-900 dark:active:bg-green-300 focus:outline-none
        focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2
        dark:focus:ring-offset-green-400 transition ease-in-out
        duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center px-4 py-2 bg-green-400
            dark:bg-green-200 border border-transparent rounded-md font-
            semibold text-xs text-white dark:text-green-400 uppercase
            tracking-widest hover:bg-green-700 dark:hover:bg-white
            focus:bg-green-300 dark:focus:bg-white active:bg-green-400
            dark:active:bg-green-300 focus:outline-none focus:ring-2
            focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-
            offset-green-400 transition ease-in-out duration-150',
        ]) }}>
        {{ $slot }}
    </button>
@endif
