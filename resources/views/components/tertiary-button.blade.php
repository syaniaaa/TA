
@props([
    'tag' => '',
    'href' => '#',
])

@if ($tag == 'a')
    <a {{ $attributes->merge([
        'class' =>
            'font-poppins inline-flex items-center px-3 py-2 bg-yellow-400 hover:bg-yellow-600 text-white font-bold border border-yellow-600 rounded transition ease-in-out duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'submit',
            'class' =>
                'font-poppins inline-flex items-center px-3 py-2 bg-yellow-400 hover:bg-yellow-600 text-white font-bold border border-yellow-600 rounded transition ease-in-out duration-150',
        ]) }}>
        {{ $slot }}
    </button>
@endif
