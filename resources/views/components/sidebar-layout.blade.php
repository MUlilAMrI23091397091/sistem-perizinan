<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans antialiased">
    <x-sidebar>
        <x-slot name="header">{{ $header ?? 'Dashboard' }}</x-slot>
        {{ $slot }}
    </x-sidebar>

    <!-- Hidden logout form for auto-logout -->
    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
        @csrf
    </form>

    {{-- Script untuk Notifikasi & Timeout --}}
    <x-notification-popup />
    <script>
        let inactivityTimer;
        let timeout = 300000; // 5 menit (300 detik)

        function resetTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(logoutUser, timeout);
            console.log('Timer reset - user activity detected');
        }

        function logoutUser() {
            console.log('Auto logout triggered after 5 minutes of inactivity');
            Swal.fire({
                title: 'Sesi Berakhir',
                text: 'Anda tidak aktif selama 5 menit dan akan dikeluarkan dari sistem demi keamanan.',
                icon: 'warning',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const logoutForm = document.getElementById('logout-form');
                    if (logoutForm) {
                        console.log('Submitting logout form');
                        logoutForm.submit();
                    } else {
                        console.error('Logout form not found');
                        // Fallback: redirect to logout route
                        window.location.href = '{{ route("logout") }}';
                    }
                }
            });
        }

        // Initialize timer when page loads
        document.addEventListener('DOMContentLoaded', function() {
            resetTimer();
            console.log('Auto logout timer initialized');
        });

        // Reset timer on user activity
        document.addEventListener('mousemove', resetTimer);
        document.addEventListener('keypress', resetTimer);
        document.addEventListener('click', resetTimer);
        document.addEventListener('scroll', resetTimer);
        document.addEventListener('keydown', resetTimer);
        document.addEventListener('touchstart', resetTimer);
    </script>
</body>
</html>
