<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

        <!-- Sweet alert2 -->
        <script src="{{asset('js/sweetalert2@11.js')}}"></script>
        <script src="{{asset('js/jquery-3.6.3.js')}}"></script>


        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

            <!-- Sweet Alert -->
    <script>
        //ปุ่ม ยืนยันลบข้อมูล
        $('.btn-checking').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')
            Swal.fire({
                title: 'ยืนยันอีกครั้ง ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#ff0000',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.value) {
                    // แอนิเมชั่นลบข้อมูล
                    Swal.fire({
                        icon: 'success',
                        title: 'ลบข้อมูลเรียบร้อยแล้ว!',
                        showConfirmButton: false,
                        timer: 1200
                    })
                    // Delay เวลา
                    setTimeout(() => {
                        document.location.href = href;
                    }, 1000);
                }
            })
        });
    </script>

        @stack('modals')

        @livewireScripts
    </body>
</html>
