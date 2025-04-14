
@props([
    'tag' => '',
    'href' => '#',
])

@if ($tag == 'a')
    <a {{ $attributes->merge([
        'class' =>
            'font-poppins inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-700 text-white font-bold border border-green-700 rounded transition ease-in-out duration-150',
    ]) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'submit',
            'class' =>
                'font-poppins inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-700 text-white font-bold border border-green-700 rounded transition ease-in-out duration-150',
        ]) }}>
        {{ $slot }}
    </button>
@endif
