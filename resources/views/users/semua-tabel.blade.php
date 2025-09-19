{{-- FILE: resources/views/users/semua-tabel.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua Data Permohonan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Tabel PD Teknis --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tampilan Tabel PD Teknis</h3>
                    {{-- Kita panggil lagi tabel yang sudah ada --}}
                    @include('partials.table-pd-teknis', ['permohonans' => $permohonans])
                </div>
            </div>

            {{-- Tabel DPM --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tampilan Tabel DPM</h3>
                    {{-- Kita panggil lagi tabel yang sudah ada --}}
                    @include('partials.table-dpm', ['permohonans' => $permohonans])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
