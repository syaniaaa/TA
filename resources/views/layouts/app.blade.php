<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ms-4 me-0 lg:ms-64">
        <!-- Button to toggle sidebar on small screens -->

        @include('layouts.navigation')

        <div id="docs-sidebar"
            class="hs-overlay [--auto-close:sm] hs-overlay-open:translate-x-0 transition-all duration-300 transform fixed top-0 start-0 bottom-0 z-[60] w-64 bg-white border-e border-gray-200 pt-7 pb-10 overflow-y-auto lg:translate-x-0 lg:block -translate-x-full">
            @include('layouts.sidebar')
        </div>


        <!-- Page Heading -->
        @if (isset($header))
            <header class="pt-4 mb-0">
                <div class="pl-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

    </div>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
        })
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type') }}";
            switch (type) {
                case 'info':
                    Toast.fire({
                        icon: 'info',
                        title: "{{ Session::get('message') }}"
                    })
                    break;
                case 'success':
                    Toast.fire({
                        icon: 'success',
                        title: "{{ Session::get('message') }}"
                    })
                    break;
                case 'warning':
                    Toast.fire({
                        icon: 'warning',
                        title: "{{ Session::get('message') }}"
                    })
                    break;
                case 'error':
                    Toast.fire({
                        icon: 'error',
                        title: "{{ Session::get('message') }}"
                    })
                    break;
                case 'dialog_error':
                    Swal.fire({
                        icon: 'error',
                        title: "Ooops",
                        text: "{{ Session::get('message') }}",
                        timer: 3000
                    })
                    break;
            }
        @endif
        @if ($errors->any())
            @php $list = null; @endphp
            @foreach ($errors->all() as $error)
                @php $list .= '<li>'.$error.'</li>'; @endphp
            @endforeach
            Swal.fire({
                type: 'error',
                title: "Ooops",
                html: "<ul>{!! $list !!}</ul>"
            })
        @endif
    </script>
</body>

</html>
