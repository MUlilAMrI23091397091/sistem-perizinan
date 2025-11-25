{{-- FILE: resources/views/components/notification-popup.blade.php --}}
{{-- FUNGSI: Komponen ini akan memeriksa session dan menampilkan notifikasi SweetAlert2 --}}

@if (session('success') || session('error') || session('warning'))
<script>
    (function() {
        // Fungsi untuk menampilkan notifikasi
        function showNotification() {
            // Pastikan SweetAlert2 sudah loaded
            if (typeof Swal === 'undefined') {
                // Jika belum loaded, tunggu sebentar dan coba lagi
                setTimeout(showNotification, 100);
                return;
            }
            
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: @json(session('success')),
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            @endif
            
            @if (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: @json(session('error')),
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            @endif
            
            @if (session('warning'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: @json(session('warning')),
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            @endif
        }
        
        // Tunggu DOM ready dan SweetAlert2 loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                // Tambahkan delay kecil untuk memastikan SweetAlert2 sudah loaded
                setTimeout(showNotification, 200);
            });
        } else {
            // DOM sudah ready, langsung tampilkan dengan delay kecil
            setTimeout(showNotification, 200);
        }
    })();
</script>
@endif
