@props(['label', 'count', 'color' => 'gray', 'icon' => ''])

@php
    switch ($color) {
        case 'green':
            $bg = 'bg-green-100 dark:bg-green-900';
            $text = 'text-green-600 dark:text-green-300';
            break;
        case 'blue':
            $bg = 'bg-blue-100 dark:bg-blue-900';
            $text = 'text-blue-600 dark:text-blue-300';
            break;
        case 'yellow':
            $bg = 'bg-yellow-100 dark:bg-yellow-900';
            $text = 'text-yellow-600 dark:text-yellow-300';
            break;
        case 'red':
            $bg = 'bg-red-100 dark:bg-red-900';
            $text = 'text-red-600 dark:text-red-300';
            break;
        case 'purple':
            $bg = 'bg-purple-100 dark:bg-purple-900';
            $text = 'text-purple-600 dark:text-purple-300';
            break;
        case 'indigo':
            $bg = 'bg-indigo-100 dark:bg-indigo-900';
            $text = 'text-indigo-600 dark:text-indigo-300';
            break;
        default:
            $bg = 'bg-gray-100 dark:bg-gray-900';
            $text = 'text-gray-600 dark:text-gray-300';
    }
@endphp

<div
    class="flex items-center justify-between bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-5 border dark:border-gray-700">
    <div class="p-4 {{ $bg }} {{ $text }} rounded-full">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
            stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
            {!! $icon !!}
        </svg>
    </div>
    <div class="text-right">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-white">{{ $label }}</h3>
        <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $count }}</div>
    </div>
</div>
