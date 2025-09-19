{{-- FILE: resources/views/components/notification-popup.blade.php --}}
{{-- FUNGSI: Komponen ini akan memeriksa session dan menampilkan notifikasi SweetAlert2 --}}

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: @json(session('success')),
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    });
</script>
@endif
