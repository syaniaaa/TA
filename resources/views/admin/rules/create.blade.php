<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Aturan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('rule.store') }}" class="space-y-6">
                        @csrf

                        <div class="max-w-xl">
                            <x-input-label for="nama" value="Nama" />
                            <x-text-input id="nama" type="text" name="nama" class="mt-1 block w-full"
                                value="{{ old('nama') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        <div class="flex justify-between mb-4">
                            <x-secondary-button tag="a" href="{{ route('rule') }}">Kembali</x-secondary-button>
                            <div class="space-x-2">
                                <x-primary-button name="save_and_create" value="true">Simpan & Buat</x-primary-button>
                                <x-primary-button name="save" value="true">Simpan</x-primary-button>
                            </div>
                        </div>

                        <!-- Pilih Penyakit -->
                        <div>
                            <label for="disease_id"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-300">Pilih
                                Penyakit</label>
                            <select name="disease_id" id="disease_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">-- Pilih Penyakit --</option>
                                @foreach ($diseases as $disease)
                                    <option value="{{ $disease->id }}">{{ $disease->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilih Gejala & Kategori -->
                        <div>
                            <p class="font-semibold text-sm mb-2">Pilih Gejala & Kategori</p>
                            @foreach ($symptoms as $symptom)
                                <div class="mb-4">
                                    <label class="inline-flex items-center space-x-2">
                                        <input type="checkbox" name="symptom_ids[]" value="{{ $symptom->id }}"
                                            class="symptom-checkbox rounded text-blue-600">
                                        <span>{{ $symptom->nama }}</span>
                                    </label>

                                    <select name="symptom_fuzzy[{{ $symptom->id }}]"
                                        class="symptom-select mt-2 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white hidden">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($symptom->fuzzySets as $fuzzy)
                                            <option value="{{ $fuzzy->id }}">{{ $fuzzy->kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                        <!-- Tingkat Output Penyakit -->
                        <div>
                            <label for="fuzzy_output_id"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tingkat Keparahan
                                Penyakit</label>
                            <select name="fuzzy_output_id" id="fuzzy_output_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">-- Pilih Tingkatan Output --</option>
                                @foreach ($fuzzyOutput as $output)
                                    <option value="{{ $output->id }}">{{ $output->kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Preview Rule -->
                        <div class="p-4 bg-green-100 dark:bg-green-900 rounded-lg">
                            <p class="font-semibold text-gray-800 dark:text-white">Rule Preview:</p>
                            <p id="rule-preview" class="mt-2 text-gray-600 dark:text-gray-300 italic">-</p>
                        </div>

                        <!-- Hidden Input Keputusan -->
                        <input type="hidden" name="keputusan" id="keputusan">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll(".symptom-checkbox");
            const preview = document.getElementById("rule-preview");
            const keputusanInput = document.getElementById("keputusan");
            const diseaseSelect = document.getElementById('disease_id');
            const fuzzyOutputSelect = document.getElementById('fuzzy_output_id');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    const select = this.closest("div").querySelector("select");
                    if (this.checked) {
                        select.classList.remove("hidden");
                    } else {
                        select.classList.add("hidden");
                        select.value = "";
                    }
                    updatePreview();
                });
            });

            document.querySelectorAll(".symptom-select").forEach(select => {
                select.addEventListener("change", updatePreview);
            });

            diseaseSelect.addEventListener("change", updatePreview);
            fuzzyOutputSelect.addEventListener("change", updatePreview);

            function updatePreview() {
                const conditions = [];

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const label = checkbox.nextElementSibling.innerText.trim();
                        const select = checkbox.closest("div").querySelector("select");
                        const text = select.options[select.selectedIndex]?.text.trim();
                        if (text && text !== "-- Pilih Kategori --") {
                            conditions.push(`${label} ${text}`);
                        }
                    }
                });

                const selectedDisease = diseaseSelect.options[diseaseSelect.selectedIndex]?.text.trim();
                const selectedOutput = fuzzyOutputSelect.options[fuzzyOutputSelect.selectedIndex]?.text.trim();

                let ruleText = "-";
                if (conditions.length > 0 && selectedDisease && selectedDisease !== "-- Pilih Penyakit --" &&
                    selectedOutput && selectedOutput !== "-- Pilih Tingkatan Output --") {
                    ruleText = `IF ${conditions.join(" AND ")} THEN ${selectedDisease} ${selectedOutput}`;
                }

                preview.innerText = ruleText;
                keputusanInput.value = ruleText;
            }
        });
    </script>
</x-app-layout>
