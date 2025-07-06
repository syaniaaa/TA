<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Hasil Diagnosis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Informasi Umum</h3>
            <p><strong>Tanggal:</strong> {{ $diagnosis->tanggal }}</p>
            <p><strong>Nama User:</strong> {{ $diagnosis->user->name ?? '-' }}</p>
            <p><strong>Hasil:</strong> {{ $diagnosis->hasil }}</p>
            <p><strong>Hasil Fuzzy:</strong> {{ $diagnosis->hasil_fuzzy }}</p>
            <p><strong>Output Fuzzy:</strong> {{ $diagnosis->fuzzyOutput->nama_output ?? '-' }}</p>

            <h3 class="text-lg font-bold mt-6 mb-2">Gejala yang Dipilih:</h3>
            <ul class="list-disc list-inside">
                @forelse ($diagnosis->symptoms as $symptom)
                    <li>{{ $symptom->nama }}</li>
                @empty
                    <li>Tidak ada gejala</li>
                @endforelse
            </ul>

            <h3 class="text-lg font-bold mt-6 mb-2">Risiko yang Dipilih:</h3>
            <ul class="list-disc list-inside">
                @forelse ($diagnosis->risks as $risk)
                    <li>{{ $risk->nama }}</li>
                @empty
                    <li>Tidak ada risiko</li>
                @endforelse
            </ul>
            <p><strong>Hasil Diagnosis (Penyakit):</strong> {{ $diagnosis->fuzzyOutput->nama_output ?? '-' }}</p>

        </div>
    </div>
    <h4>DEBUG:</h4>
    <p>Jumlah Gejala: {{ $diagnosis->symptoms->count() }}</p>
    <p>Jumlah Risiko: {{ $diagnosis->risks->count() }}</p>

</x-app-layout>
