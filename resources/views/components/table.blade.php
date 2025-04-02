{{-- @props([
    'header' => '',
])

<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead>
                        <tr>
                            {{ $header }}
                        </tr>
                    </thead>
                    <tbody>
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('th').forEach(el => el.classList.add("px-6", "py-3", "text-left", "text-xs",
        "font-medium", "text-black-500", "uppercase"));
    document.querySelectorAll('td').forEach(el => el.classList.add("px-6", "py-4", "whitespace-nowrap", "text-sm",
        "font-medium", "text-black-800", "dark:text-black-200"));
</script> --}}
@props([
    'header' => '', // Slot untuk header tabel
])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                {{ $header }} <!-- Slot untuk header -->
            </tr>
        </thead>
        <tbody>
            {{ $slot }} <!-- Slot untuk body tabel -->
        </tbody>
    </table>
</div>

<!-- Script untuk menambahkan class Tailwind secara otomatis -->
<script>
    document.querySelectorAll('th').forEach(el => el.classList.add(
        "px-8", "py-4", "text-left", "text-xs", "font-bold",
        "text-gray-900", "uppercase",  "dark:bg-gray-700", "dark:text-gray-400",
        "border-b-4", "border-green-600" // Tambahkan border-bottom dengan warna
    ));

    document.querySelectorAll('td').forEach(el => el.classList.add(
        "px-6", "py-4", "whitespace-normal", "text-sm",
        "text-gray-700", "dark:text-gray-400"
    ));
    document.querySelectorAll('tbody tr').forEach(el => el.classList.add(
        "border-b", "border-gray-300", "dark:border-gray-600"
    ));
</script>

{{-- document.querySelectorAll('th').forEach(el => el.classList.add(
        "px-8", "py-4", "text-left", "text-xs", "font-bold",
        "text-gray-900", "uppercase", "bg-green-400", "dark:bg-gray-700", "dark:text-gray-400"
    )); --}}
