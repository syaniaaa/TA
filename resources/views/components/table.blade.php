@props([
    'header' => '',
    'pagination' => false,
    'searchable' => false,
])

<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div
                class="border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden bg-white dark:border-neutral-700 dark:bg-neutral-900">

                {{-- Table --}}
                <div class="overflow-hidden">
                    <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                        <thead
                            class="text-xs bg-white dark:bg-neutral-800 uppercase text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-neutral-700 font-poppins">
                            <tr class="text-left">
                                {{ $header }}
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            {{ $slot }}
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('th').forEach(el => el.classList.add(
        "px-6", "py-3", "font-semibold", "tracking-wider"
    ));
    document.querySelectorAll('td').forEach(el => el.classList.add(
        "px-6", "py-4", "align-middle", "whitespace-normal"
    ));
    document.querySelectorAll('tbody tr').forEach(el => el.classList.add(
        "hover:bg-gray-100", "dark:hover:bg-neutral-800"
    ));
</script>
