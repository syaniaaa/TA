@props([
    'image' => '',
    'title' => '',
    'description' => '',
    'price' => '',
])

<div class="max-w-sm rounded overflow-hidden shadow-lg">
    <img class="w-full h-auto object-cover" src="{{ $image }}" alt="Image">
    <div class="px-1 py-1">
        <div class="card-title font-bold text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl">{{ $title }}
        </div>
        <p class="card-description text-gray-700 text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl">
            {{ $description }}
        </p>
        <p class="card-price text-gray-700 text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl">RP
            {{ number_format($price, 0, ',', '.') }}
        </p>
    </div>
</div>

<script>
    document.querySelectorAll('.card-title').forEach(el => el.classList.add("font-bold", "text-xl", "mb-2"));
    document.querySelectorAll('.card-description').forEach(el => el.classList.add("text-gray-700", "text-base"));
    document.querySelectorAll('.card-price').forEach(el => el.classList.add("text-gray-700", "text-base"));
</script>
