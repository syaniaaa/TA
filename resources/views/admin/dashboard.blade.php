<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-center items-center">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full">

                            {{-- Header --}}
                            <div
                                class="col-span-full bg-green-500 text-white text-center py-6 rounded-lg text-2xl font-semibold">
                                Selamat Datang
                            </div>

                            @php
                                $cards = [
                                    [
                                        'label' => 'Penyakit',
                                        'count' => $disease_count,
                                        'color' => 'green',
                                        'icon' => '<polyline points="20 12 16 12 14 20 10 4 8 12 4 12"/>',
                                    ],
                                    [
                                        'label' => 'Gejala',
                                        'count' => $symptom_count,
                                        'color' => 'blue',
                                        'icon' =>
                                            '<polygon points="12 2 13 8 18 6 14 10 18 14 13 12 12 22 11 12 6 14 10 10 6 6 11 8 12 2" />',
                                    ],
                                    [
                                        'label' => 'Aturan',
                                        'count' => $rule_count,
                                        'color' => 'yellow',
                                        'icon' =>
                                            '<path d="M9 12h6M9 16h6M12 8v.01" /><path d="M21 12c0-4.97-4.03-9-9-9S3 7.03 3 12s4.03 9 9 9 9-4.03 9-9z" />',
                                    ],
                                    [
                                        'label' => 'Risiko',
                                        'count' => $risk_count,
                                        'color' => 'red',
                                        'icon' =>
                                            '<path d="M12 9v2m0 4h.01" /><path d="M5.07 19a10 10 0 1113.86 0H5.07z" />',
                                    ],
                                    [
                                        'label' => 'Diagnosis',
                                        'count' => $diagnosis_count,
                                        'color' => 'purple',
                                        'icon' => '<path d="M4 4h16v16H4z" /><path d="M9 9h6v6H9z" />',
                                    ],
                                    [
                                        'label' => 'Pengguna',
                                        'count' => $user_count,
                                        'color' => 'indigo',
                                        'icon' =>
                                            '<path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M22 21v-2a4 4 0 00-3-3.87" /><path d="M16 3.13a4 4 0 010 7.75" />',
                                    ],
                                ];
                            @endphp

                            {{-- Loop with Component --}}
                            @foreach ($cards as $card)
                                <x-card :label="$card['label']" :count="$card['count']" :color="$card['color']" :icon="$card['icon']" />
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
