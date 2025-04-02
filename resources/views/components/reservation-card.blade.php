@props([
    'id' => '',
    'image' => '',
    'title' => '',
    'description' => '',
    'price' => '',
    'availability' => false,
])

<div class="max-w-sm rounded overflow-hidden shadow-lg flex flex-col justify-between menu-item"
    data-id="{{ $id }}" data-name="{{ $title }}" data-price="{{ $price }}"
    data-availability="{{ $availability ? 'true' : 'false' }}">
    <div>
        <div class="relative">
            <img class="w-full h-48 object-cover" src="{{ $image }}" alt="Gambar">
            @if (!$availability)
                <div
                    class="absolute inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center text-white font-bold text-xl">
                    Tidak Tersedia
                </div>
            @endif
        </div>
        <div class="px-4 py-3 flex-1 flex flex-col">
            <div class="card-title font-bold mb-2 truncate" style="max-width: 100%;">{{ $title }}</div>
            <p class="text-gray-700 text-base line-clamp-3 flex-1">{{ $description }}</p>
            <p class="text-gray-700 text-base">RP. {{ number_format($price, 0, ',', '.') }}</p>
        </div>
    </div>
    <div class="px-4 py-3 flex justify-end">
        <button class="add-to-order bg-green-500 text-white px-3 py-1 rounded-lg shadow-md"
            {{ $availability ? '' : 'disabled' }}>+</button>
    </div>
</div>
