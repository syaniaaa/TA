<ol class="flex items-center w-full text-sm text-gray-500 font-medium sm:text-base">
    <!-- Step 1 -->
    <li class="flex w-full items-center after:w-full after:h-0.5 after:bg-gray-200 after:inline-block after:mx-4">
        <div class="flex items-center whitespace-nowrap">
            <x-stepper-link href="/patientData" :active="request()->is('patientData')" :completed="request()->is('patientData') ||
                request()->is('symptomTest') ||
                request()->is('riskTest') ||
                request()->is('result')">
                1
            </x-stepper-link>
            Data Diri
        </div>
    </li>

    <!-- Step 2 -->
    <li class="flex w-full items-center after:w-full after:h-0.5 after:bg-gray-200 after:inline-block after:mx-4">
        <div class="flex items-center whitespace-nowrap">
            <x-stepper-link href="/symptomTest" :active="request()->is('symptomTest')" :completed="request()->is('symptomTest') || request()->is('riskTest') || request()->is('result')">
                2
            </x-stepper-link>
            Tes Gejala
        </div>
    </li>

    <!-- Step 3 -->
    <li class="flex w-full items-center after:w-full after:h-0.5 after:bg-gray-200 after:inline-block after:mx-4">
        <div class="flex items-center whitespace-nowrap">
            <x-stepper-link href="/riskTest" :active="request()->is('riskTest')" :completed="request()->is('riskTest') ||
                request()->is('riskTest') ||
                request()->is('result')">
                3
            </x-stepper-link>
            Tes Risiko
        </div>
    </li>

    <!-- Step 4 -->
    <li class="flex items-center">
        <div class="flex items-center whitespace-nowrap">
            <x-stepper-link
                href="/result"
                :active="request()->is('result')"
                :completed="request()->is('result')">
                4
            </x-stepper-link>
            Hasil Tes
        </div>
    </li>
</ol>
