<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=" font-sans text-gray-800">
    <x-navbar />

    <main class="pt-32 pb-12">
        <div class="max-w-6xl mx-auto px-6 space-y-10">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-green-700">Profil Saya</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-white rounded-2xl shadow-lg border border-indigo-100">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="p-6 bg-white rounded-2xl shadow-lg border border-indigo-100">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="p-6 bg-white rounded-2xl shadow-lg border border-red-100 col-span-1 md:col-span-2">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </main>
</body>


</html>
